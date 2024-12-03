<?php

namespace App\Http\Controllers;

use App\Http\Livewire\RecieveOrder;
use App\Models\ProductReceived;
use App\Models\ProductSale;
use App\Models\ProductService;
use App\Models\PurchaseOrder;
use App\Models\ReceiveOrder;
use App\Models\Sale;
use App\Models\SupplierPayment;
use App\Models\Task;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductServiceController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }
    public function category(){
        return view('shop.category');
    }
    public function invent(){
        return view('shop.create-product');
    }
    public function sales(){

    }
    public function createSupplier()
    {
        return view('shop.create-supplier');
    }
    public function allSupplier()
    {
        return view('shop.all-supplier');
    }
    public function show(ProductService $product){
        return view('shop.product-detail',[
            'product' => $product
        ]);
    }
    public function showPurchaseOrder(PurchaseOrder $order){
        return view('shop.show-purchase-order',[
            'order' => $order
        ]);
    }
    public function processPurchaseOrder(Request $request, PurchaseOrder $order)
    {
        $data = $request->validate([
            'process_order' =>'required'
        ]);

      $order->update([
        'status' => $data['process_order']
      ]);
      return redirect()->route('purchase-order.all')->with('message', 'order processed successfuly');
    }
    public function showReceiveOrder(Request $request)
    {
        $orderTo = $request->process_order;
        $order = PurchaseOrder::findOrFail($orderTo);
        // dd($order);
        return view('shop.show-receive-order',[
            'order' => $order
        ]);
    }
    public function receiveOrder(){

        $ReadypurchaseOrder = PurchaseOrder::where('status', 2)->get();
        return view('shop.receive-order', [
            'readyPurchase' => $ReadypurchaseOrder
        ]);
    }
    public function processReceiveOrder(Request $request){

      $data = $request->validate([
        'purchase_order_id' => 'required',
        'product_id.*' => 'required',
        'product_qty.*' => 'required',
        'cost_price.*' => 'required',
        'product_selling_price.*' => 'required',
        'bank_name' => 'nullable',
        'account_name' => 'nullable',
        'account_number' => 'nullable',
      ]);
    //   dd($data);
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

        $supplier_pay = SupplierPayment::create([
            'supplier_id' =>$purchaseOrder->supplier_id,
            'receive_order_id' => $receiveOrder->id,
            'amount' =>$supplied_total,
            'account_name' => $data['account_name'],
            'account_number' => $data['account_number'],
            'bank_name' => $data['bank_name'],
            'status' => 1

        ]);

        foreach($data['product_id'] as $index=>$item){

                if($data['product_qty'][$index] != 0)
                {

                    $product_id =  $data['product_id'][$index];
                    // dd($product_id);
                    $product_name = ProductService::findOrFail($product_id);
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
    public function salesReport()
    {

        $sales_year= Sale::select(DB::raw('YEAR(created_at) as year'))->groupBy('year')->orderBy('year', 'desc')->get();

        return view('shop.sale', compact('sales_year'));
    }

    public function sales_table(Request $request)
    {
        $sales = Sale::join('users', 'sales.user_id', '=', 'users.id')
                ->whereYear('sales.created_at', $request->get('year'))
                ->select('sales.*', 'users.fullname_virtual')
                ->orderBy('sales.created_at', 'desc');

        return DataTables::eloquent($sales)
            ->filter(function ($query) use ($request){

            if ($request->has('last_name')) {
                $query->where('users.fullname_virtual', 'like', "%{$request->get('last_name')}%");
            }

            if ($request->has('daterange')) {
                $date_range = explode(" - ", $request->get('daterange'));
                $query->whereBetween('sales.created_at', [$date_range[0], $date_range[1]]);
            }

            })

            ->editColumn('price', function ($sales)  {
            return "<span class='float-right'>" . showAmount($sales->Total_cost) . "</span>";
            })
            ->editColumn('tx_date', function($sales){
                return $sales->created_at->format('d/M/Y');
            })
             ->editColumn('member_names', function ($sales) {
                return $sales->user->fullname_virtual;
            })
            ->addColumn('action', function ($sales) {
            return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu">'
                . '<a href="' . route('sales.show', $sales->id) . '" class="dropdown-item ajax-modal"><i class="ti-credit-card"></i> ' . __('Show Sale Detail') . '</a>'
                . '</div>';
        })
        ->setRowId(function ($sales) {
            return "row_" . $sales->id;
        })
        ->rawColumns(['price', 'tx_date', 'member_names', 'action'])
        ->make(true);
    }

    public function showSales(Sale $sale)
    {
        return view('shop.sale-detail', compact('sale'));
    }

    public function getSalesTotal(Request $request)
    {
        if(!is_null($request->daterange) ){
            $date_range = explode(" - ", $request->daterange);
            $request->merge([
                'start_date' => $date_range[0],
                'end_date' => $date_range[1]
            ]);
            $sales = Sale::whereBetween('created_at', [$request->start_date, $request->end_date])->sum('Total_cost');
        }else{
            $sales = Sale::whereYear('created_at', $request->year)->sum('Total_cost');
        }

        return response()->json(showAmountPer($sales));
    }
}
