<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\BankMandate;
use App\Models\BankMandateDetail;
use App\Models\Executive;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Member;
use App\Models\ProductSale;
use App\Models\ProductService;
use App\Models\Revenue;
use App\Models\Sale;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LoanPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loan.index');
    }
    public function pendingLoanIndex()
    {
        return view('loan.pending');
    }
    public function get_table_data(Request $request)
    {
        $users = Loan::with("user")
        ->select('loans.*' )
        ->orderBy('loans.id', "desc");
        // $loans= Loan::join('users', 'user_id', "=", "id")->select("loans.*")
    // $invoices = Invoice::with("client")
    //     ->select('invoices.*')
    //     ->orderBy("invoices.id", "desc");

    return DataTables::eloquent($users)
        ->filter(function ($query) use ($request) {
            if ($request->has('last_name')) {
                $query->where('last_name', 'like', "%{$request->get('last_name')}%");
            }

            // if ($request->has('department')) {
            //     $query->where('department', $request->get('department'));
            // }

            // if ($request->has('status')) {
            //     $query->whereIn('status', json_decode($request->get('status')));
            // }

            // if ($request->has('date_range')) {
            //     $date_range = explode(" - ", $request->get('date_range'));
            //     $query->whereBetween('invoice_date', [$date_range[0], $date_range[1]]);
            // }
        })
        ->editColumn('loan_type', function($user){
            $mes = $user->loan_type == 1 ? "Financial": "Electronics";
            return '<span class="badge badge-info">'. $mes .'</span>';
        })
        ->editColumn('performance', function($user){
            return $user->given_installment. "/". $user->total_installments;
        })
        ->editColumn('loan_amount', function ($user)  {
            return "<span class='float-right'>" . showAmount($user->amount) . "</span>";
        })
        ->editColumn('status', function ($user) {

            return loan_status($user->status);
        })
        ->editColumn('member_names', function ($user) {
            return $user->user->middle_name . ' ' . $user->user->last_name;
        })
        ->addColumn('action', function ($user) {
            return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu">'
                . '<a href="' . route('show.loan', $user->id) . '" class="dropdown-item ajax-modal"><i class="ti-credit-card"></i> ' . __('Show Loan Detail') . '</a>'
                . '<a href="' . route('form.loan', $user->id) . '"  class="dropdown-item ajax-modal"><i class="fa fa-notes"></i> ' . __('Download Loan form') . '</a></div>';
        })
        ->setRowId(function ($user) {
            return "row_" . $user->id;
        })
        ->rawColumns(['loan_amount','performance','member_names', 'loan_type','status', 'action'])
        ->make(true);

    }
    public function selfLoanDetail(Loan $loan)
    {
        if (auth()->user()->id != $loan->user_id) abort(403, "You are not permitted to view this page");
        return view('loan.personal-detail',[
            'loan' => $loan
        ]);
    }
    public function loanFormDownload(Loan $loan){
        $loan = [
            'fullname' =>$loan->user->fullname,
            'loan_amount'=> $loan->amount,
            'deduction' => $loan->amount/$loan->total_installments,
            'purpose' => $loan->purpose,
            'total_installments' => $loan->total_installments,
            'guarantors' =>$loan->guarantors
        ];
        $pdf = Pdf::loadView('layouts.pdf-views.loan', $loan);
        return $pdf->download('Loan_apply.pdf');

          }
    public function applyLoan()
    {
        $members = Member::whereIn('status',[3,6])->get();
        $admincharge = AppSetting::where('setting_name', 'loan-administration')->pluck('setting_value');
        $products = ProductService::all();
        $excos[] =  Executive::all()->pluck('user_id')->toArray();
        $exco_charge = AppSetting::where('setting_name', 'loan-exco-charge')->pluck('setting_value');
        $member_charge = AppSetting::where('setting_name', 'loan-members-charge')->pluck('setting_value');

        return view('loan.request',[
            'members' => $members,
            'products' => $products,
            'admincharge' =>(int) $admincharge[0],
            'excos' => $excos,
            'exco_charge' => $exco_charge[0] ,
            'member_charge' => $member_charge[0]

        ]);
    }

    public function selfapplyLoan()
    {
        if (auth()->user()->member()->exists() && in_array(auth()->user()->member_status, [3,6])) {
             $admincharge = AppSetting::where('setting_name', 'loan-administration')->pluck('setting_value');
            $products = ProductService::all();
              return view('loan.self-request',[
                'products' => $products,
                'admincharge' => (int) $admincharge[0],
              ]);
        }else{

            return redirect()->back()->with('message', 'Kindly complete your membership registration');
        }

    }
    public function get_pending_loan(Request $request)
    {
        $users = Loan::with("user")
        ->where('status', 0)
        ->select('loans.*' )
        ->orderBy('loans.id', "desc");
        // $loans= Loan::join('users', 'user_id', "=", "id")->select("loans.*")
    // $invoices = Invoice::with("client")
    //     ->select('invoices.*')
    //     ->orderBy("invoices.id", "desc");

    return DataTables::eloquent($users)
        ->filter(function ($query) use ($request) {
            if ($request->has('last_name')) {
                $query->where('last_name', 'like', "%{$request->get('last_name')}%");
            }

            // if ($request->has('department')) {
            //     $query->where('department', $request->get('department'));
            // }

            // if ($request->has('status')) {
            //     $query->whereIn('status', json_decode($request->get('status')));
            // }

            // if ($request->has('date_range')) {
            //     $date_range = explode(" - ", $request->get('date_range'));
            //     $query->whereBetween('invoice_date', [$date_range[0], $date_range[1]]);
            // }
        })
        ->editColumn('loan_type', function($user){
            $mes = $user->loan_type == 1 ? "Financial": "Electronics";
            return '<span class="badge badge-info">'. $mes .'</span>';
        })
        ->editColumn('performance', function($user){
            return $user->given_installment. "/". $user->total_installments;
        })
        ->editColumn('loan_amount', function ($user)  {
            return "<span class='float-right'>" . showAmount($user->amount) . "</span>";
        })
        ->editColumn('status', function ($user) {

            return loan_status($user->status);
        })
        ->editColumn('member_names', function ($user) {
            return ucwords($user->fullname_virtual);
        })
        ->addColumn('action', function ($user) {
            return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu">'
                . '<a href="' . route('show.loan', $user->id) . '" class="dropdown-item ajax-modal"><i class="ti-credit-card"></i> ' . __('Show Loan Detail') . '</a>'
                . '<a href="' . route('form.loan', $user->id) . '"  class="dropdown-item ajax-modal"><i class="fa fa-notes"></i> ' . __('Download Loan form') . '</a></div>';
        })
        ->setRowId(function ($user) {
            return "row_" . $user->id;
        })
        ->rawColumns(['loan_amount','performance','member_names', 'loan_type','status', 'action'])
        ->make(true);

    }
    public function approveLoan(Request $request) {
        // dd($request->all());

        $loan = Loan::findOrFail($request->loan_id);
        // dd($loan);
        $excos = Executive::all()->pluck('user_id');
        $admincharge = $admincharge = AppSetting::where('setting_name', 'loan-administration')->pluck('setting_value');
            $interest = 0.1;
         if(in_array($loan->user_id, $excos->toArray()))
            {
                $interest = 0.08;
            }

            DB::transaction(function () use ($loan, $interest, $admincharge) {


            $loan->update([
                        'status' => 1
                    ]);
            $installment_amount = 0;


            //if financial send details to await mandate;
            if($loan->loan_type == 1){
                //deduct 8% charges and send the remaining to bank mandate, 8%deduction to revenue
                $loancharges = ($loan->amount* $interest) + (int)$admincharge[0];

                $installment_amount = round($loan->amount / $loan->total_installments, 2) ;
                $disbursement = $loan->amount - $loancharges;
                //dd($disbursement);
                $awaitingBatch = BankMandate::where('batch_id', 'unbatched Bank Mandate')->first();
                if(is_null($awaitingBatch))
                {
                    $awaitingBatch = BankMandate::create([
                        'bank_account_id' => 1,
                        'batch_id' => 'unbatched Bank Mandate',
                        'mandate_status' => 0,
                        'prepared_by' => auth()->user()->id,
                        'approved_by' => auth()->user()->id

                    ]);

                }
                $bankMandate = $awaitingBatch->bankMandateDetails()->create([
                    'mandateable_type' => 'App\Models\Loan',
                    'mandateable_id' => $loan->id,
                    'amount' => $disbursement,
                    'narration' => 'Loan disbursement from FEMCAS',
                    'account_name' => $loan->loanBank->account_name,
                    'bank_name' => $loan->loanBank->bank_name,
                    'account_number' =>$loan->loanBank->account_number,
                    'status' => 0
                ]);
                Revenue::create([
                    'transaction_id' => $loan->id,
                    'details' => 'App\Models\Loan',
                    'amount' => $loancharges,
                    'uploaded_by' => auth()->user()->id,
                ]);

            }else{
            //else electronics send details to product sales
             $loancharges = ($loan->amount* $interest) + (int)$admincharge[0];
             $loan->update([
                    'amount' => $loan->amount + $loancharges,
                    'is_disbursed' =>true
             ]);
             $installment_amount =  round(($loan->amount + $loancharges)/ $loan->total_installments, 2);

             Revenue::create([
                'transaction_id' => $loan->id,
                'details' => 'App\Models\Loan',
                'amount' => $loancharges,
                'uploaded_by' => auth()->user()->id,
            ]);
            $productSale = Sale::create([
                'user_id' => $loan->user->id,
                'status'  => 1,
                'Total_cost' => $loan->amount,
                'loan_id' => $loan->id,
            ]);
            foreach($loan->loanProduct->loanProductDetails as $loanP)
                {
                    $product_life = ProductService::find($loanP->product_service_id);
                    $productSale->productSales()->create([
                        'product_service_id' => $loanP->product_service_id,
                        'quantity' => $loanP->quantity,
                        'selling_price' => $loanP->selling_price,
                        'initial_qty_sold' => $product_life->total_sales
                    ]);
                }
            }

            for($i= 0; $i < $loan->total_installments; $i++ ){
                Installment::create([
                    'loan_id' => $loan->id,
                    'installment_number' => $i + 1,
                    'amount' => $installment_amount,
                    'status' => 0
                ]);
            }

        });

        return redirect()->route('show.loan', $loan->id)->with([
            'message' => 'you have successfully Approved  Loan for '. $loan->user->fullname. '.'
        ]);

    }
    public function declineLoan(Request $request){
        $loan = Loan::findOrFail($request->loan_id);
        $loan->update([
            'status' => 3
        ]);
        return redirect()->route('show.loan', $loan->id)->with([
            'message' => 'you have successfully Declined  Loan for '. $loan->user->fullname. '.'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        return  view('loan.detail',[
            'loan' => $loan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
