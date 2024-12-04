<?php

namespace App\Http\Controllers;

use App\Models\ProductService;
use App\Models\PurchaseOrder;
use App\Models\ReceiveOrder;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function processReceiveOrder(Request $request)
    {
        // dd($request->all());

      $data = $request->validate([
          'purchase_order_id' => 'required',
          'product_id.*' => 'required',
          'product_qty.*' => 'required',
          'cost_price.*' => 'required',
          'account_name' => 'required',
          'account_number' => 'required',
          'bank_name' => 'required',
          'product_selling_price.*' => 'required'
      ]);

      DB::transaction(function () use($data) {

            $supplied_total = 0;
            foreach($data['product_qty'] as $key=>$lineItem){
                $supplied_total += $lineItem * $data['cost_price'][$key];
            }

            $purchaseOrder = PurchaseOrder::findOrFail($data['purchase_order_id']);

            $purchaseOrder->update([
                'status' => 4
            ]);

            $receiveOrder = ReceiveOrder::create([
                'purchase_order_id' => $purchaseOrder->id,
                'received_by' => auth()->user()->id,
                'cost' => $supplied_total,
                'status' => 1,
            ]);
            //   dd($receiveOrder);
            $supplier_pay = SupplierPayment::create([
                'supplier_id' =>$purchaseOrder->supplier_id,
                'receive_order_id' => $receiveOrder->id,
                'amount' =>$supplied_total,
                'account_name' => $data['account_name'],
                'account_number' => $data['account_number'],
                'bank_name' => $data['bank_name'],
                'status' => 1

            ]);
            // dd($data);
            foreach($data['product_id'] as $index=>$item){

                if($data['product_qty'][$index] != 0)
                {

                    $product_id =  $data['product_id'][$index];

                    $product_name = ProductService::findOrFail((int)$product_id);
                    //  dd($product_name);
                    $receiveOrder->receiveOrderDetails()->create([
                        'product_service_id' => $product_id,
                        'price' => $data['product_selling_price'][$index],
                        'quantity' => $data['product_qty'][$index],
                        'status' =>1
                    ]);

                    $product_name->productReceiveds()->create([
                        'receive_order_id' => $receiveOrder->id,
                        'quantity_received' => $data['product_qty'][$index],
                        'cost_price' => $data['cost_price'][$index],
                        'initial_qty' => $product_name->total_received,
                        'quantity_received' => $data['product_qty'][$index],
                        'cost_price' =>$data['cost_price'][$index],
                        'selling_price' =>$data['product_selling_price'][$index],
                    ]);

                    $product_name->productPrices()->create([
                            'current_price' => $data['product_selling_price'][$index],
                            'added_by' => auth()->user()->id,
                    ]);


                }
            }
      });

      return redirect()->route('receive-order.all')->with('message', 'receive order processed successfully');

    }

    public function get_receive_order(Request $request)
    {
        $sales = ReceiveOrder::with('purchaseOrder.supplier')
                ->whereYear('receive_orders.created_at', $request->get('year'))
                ->select('receive_orders.*')
                ->orderBy('receive_orders.created_at', 'desc');
        return DataTables::eloquent($sales)
             ->filter(function ($query) use ($request){


            if ($request->has('daterange')) {
                $date_range = explode(" - ", $request->get('daterange'));
                $query->whereBetween('receive_orders.created_at', [$date_range[0], $date_range[1]]);
            }

            })
            ->editColumn('cal_cost', function ($sales)  {
            return  showAmountPer($sales->cost) ;
            })
            ->editColumn('created_at', function($sales){
                return $sales->created_at->format('d/M/Y');
            })
            ->editColumn('supplier_name', function ($sales) {
                return $sales->purchaseOrder->supplier->name;
            })
            ->editColumn('status', function ($sales) {
                return $sales->status? "<span class='badge badge-success'>Received</span>" : "<span class='badge badge-danger'>Not Received</span>";
            })
            ->addColumn('received_by', function ($sales) {
                return $sales->receivedBy->fullname;
            })
            ->addColumn('action', function ($sales) {
                return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu">'
                . '<a href="' . route('receive-order.processed', $sales->id) . '" class="dropdown-item ajax-modal"><i class="ti-credit-card"></i> ' . __('Show Sale Detail') . '</a>'
                . '</div>';
            })
              ->setRowId(function ($sales) {
            return "row_" . $sales->id;
            })
            ->rawColumns(['action', 'status', 'cost', 'created_at', 'received_by'])
            ->make(true);

    }
    public function showReceivedOrder(ReceiveOrder $order)
    {
        return view('shop.processed_receive_order', compact('order'));
    }
}
