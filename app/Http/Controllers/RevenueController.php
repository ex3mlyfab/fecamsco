<?php

namespace App\Http\Controllers;

use App\Models\BankMandate;
use App\Models\BankMandateDetail;
use App\Models\Loan;
use App\Models\Revenue;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('office.revenue');
    }
    public function bankMandateBatch()
    {
        return view('office.bankMandateBatch');
    }

    public function get_batch_data(Request $request)
    {
        $users = BankMandate::orderBy('created_at', 'desc');

        // $users = User::with("member")
        //     ->select('users.*')
        //     ->orderBy('users.id', "desc");

        // $invoices = Invoice::with("client")
        //     ->select('invoices.*')
        //     ->orderBy("invoices.id", "desc");

        return DataTables::eloquent($users)
            // ->filter(function ($query) use ($request) {
            //     if ($request->has('last_name')) {
            //         $query->where('users.last_name', 'like', "%{$request->get('last_name')}%");
            //     }

            //     // if ($request->has('department')) {
            //     //     $query->where('department', $request->get('department'));
            //     // }

            //     // if ($request->has('status')) {
            //     //     $query->whereIn('status', json_decode($request->get('status')));
            //     // }

            //     // if ($request->has('date_range')) {
            //     //     $date_range = explode(" - ", $request->get('date_range'));
            //     //     $query->whereBetween('invoice_date', [$date_range[0], $date_range[1]]);
            //     // }
            // })
            // ->editColumn('grand_total', function ($invoice) use ($currency) {
            //     return "<span class='float-right'>" . decimalPlace($invoice->grand_total, $currency) . "</span>";
            // })

            // ->editColumn('email', function ($user) {

            //     return $user->user->email;
            // })
            ->editColumn('amount', function ($user)  {
                return "<span class='float-right'>" . showAmount($user->total_amount) . "</span>";
            })
            ->editColumn('mandate_status', function ($user) {

                return mandate_status($user->mandate_status);
            })
            ->addColumn('action', function ($user) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a href="' . route('bankmandatebatch.show', $user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-file-text"></i> ' . __('Show mandate Details') . '</a>'
                    .'</div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['mandate_status', 'amount', 'action'])
            ->make(true);
    }
    public function bankMandateBatchShow(BankMandate $batch)
    {
        return view('office.awaiting-mandate', [
            'batch' => $batch
        ]);
    }
    public function bankMandateBatchProcess(Request $request)
    {
        // dd($request->all());
        $totalPaidOut =0;
        $mandateNo = BankMandate::all()->count();
        $newBatch = BankMandate::create([
                        'bank_account_id' => 1,
                        'batch_id' => 'Bank Mandate #'. $mandateNo + 1,
                        'mandate_status' => 1,
                        'prepared_by' => auth()->user()->id,
                    ]);
        foreach($request->id as $index=>$value){
            $mandateretrieve = BankMandateDetail::find($request->id[$index]);
            $mandateretrieve->update([
                'bank_mandate_id' => $newBatch->id,
                'status' => 1
            ]);
            $totalPaidOut += $mandateretrieve->amount;
            if($mandateretrieve->mandateable_type == 'App\Models\Loan'){
                $loanupdate = Loan::find($mandateretrieve->mandateable_id);
                $loanupdate->update([
                    'is_disbursed' => true
                ]);
            }
            if($mandateretrieve->mandateable_type == 'App\Models\SupplierPayment'){
                $supplierpay = SupplierPayment::find($mandateretrieve->mandateable_id);
                $supplierpay->update([
                    'status' => 1
                ]);
            }

        }
        $newBatch->update([
            'total_amount' => $totalPaidOut,
            'approved_by'  => auth()->user()->id
        ]);
        return redirect()->route('bankmandatebatch.show', $newBatch->id)->with('message', 'processed successfuly');
    }

    public function bankMandate(){
        // $loans = Loan::query()->whereHas('installments', function ($query) {
        //     $query->where('status', 0);
        // })->get();
        // dd($loans);
        return view('office.bank-mandate');
    }
    public function showBankMandate(BankMandateDetail $mandate){
        return view('office.showMandate', [
            'mandate' => $mandate
        ]);
    }

    public function get_mandate_data()
    {
        $users = BankMandateDetail::where('bank_mandate_id', 1)
        ->orderBy('created_at', 'desc');

        // $users = User::with("member")
        //     ->select('users.*')
        //     ->orderBy('users.id', "desc");

        // $invoices = Invoice::with("client")
        //     ->select('invoices.*')
        //     ->orderBy("invoices.id", "desc");

        return DataTables::eloquent($users)
            // ->filter(function ($query) use ($request) {
            //     if ($request->has('last_name')) {
            //         $query->where('users.last_name', 'like', "%{$request->get('last_name')}%");
            //     }

            //     // if ($request->has('department')) {
            //     //     $query->where('department', $request->get('department'));
            //     // }

            //     // if ($request->has('status')) {
            //     //     $query->whereIn('status', json_decode($request->get('status')));
            //     // }

            //     // if ($request->has('date_range')) {
            //     //     $date_range = explode(" - ", $request->get('date_range'));
            //     //     $query->whereBetween('invoice_date', [$date_range[0], $date_range[1]]);
            //     // }
            // })
            // ->editColumn('grand_total', function ($invoice) use ($currency) {
            //     return "<span class='float-right'>" . decimalPlace($invoice->grand_total, $currency) . "</span>";
            // })

            // ->editColumn('email', function ($user) {

            //     return $user->user->email;
            // })
            ->editColumn('amount', function ($user)  {
                return "<span class='float-right'>" . showAmount($user->amount) . "</span>";
            })
            ->editColumn('checkSelection', function ($user) {

                return '<div class="checkbox checkbox-success">'
                .'<input id="'. $user->id.'" type="checkbox" class="selectCheckbox">'.
                '</div>';
            })
            ->editColumn('status', function ($user) {

                return mandate_status($user->status);
            })
            // ->addColumn('action', function ($user) {
            //     return '<div class="dropdown text-center">'
            //         . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
            //         . '&nbsp;</button>'
            //         . '<div class="dropdown-menu">'
            //         . '<a href="' . route('bankmandate.show', $user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-file-text"></i> ' . __('Show mandate Detail') . '</a>'
            //         .'</div>';
            // })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['checkSelection','status', 'amount'])
            ->make(true);


    }
    public function get_revenue_data()
    {
        $users = Revenue::orderBy('created_at', 'desc');

        // $users = User::with("member")
        //     ->select('users.*')
        //     ->orderBy('users.id', "desc");

        // $invoices = Invoice::with("client")
        //     ->select('invoices.*')
        //     ->orderBy("invoices.id", "desc");

        return DataTables::eloquent($users)
            // ->filter(function ($query) use ($request) {
            //     if ($request->has('last_name')) {
            //         $query->where('users.last_name', 'like', "%{$request->get('last_name')}%");
            //     }

            //     // if ($request->has('department')) {
            //     //     $query->where('department', $request->get('department'));
            //     // }

            //     // if ($request->has('status')) {
            //     //     $query->whereIn('status', json_decode($request->get('status')));
            //     // }

            //     // if ($request->has('date_range')) {
            //     //     $date_range = explode(" - ", $request->get('date_range'));
            //     //     $query->whereBetween('invoice_date', [$date_range[0], $date_range[1]]);
            //     // }
            // })
            // ->editColumn('grand_total', function ($invoice) use ($currency) {
            //     return "<span class='float-right'>" . decimalPlace($invoice->grand_total, $currency) . "</span>";
            // })
            ->editColumn('email', function ($user) {

                return $user->user->email;
            })
            ->editColumn('status', function ($user) {

                return member_status($user->status);
            })
            ->editColumn('member_names', function ($user) {
                return $user->user->middle_name . ' ' . $user->user->last_name . " ". $user->user->first_name;
            })
            ->addColumn('action', function ($user) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a href="' . route('user.show', $user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-user"></i> ' . __('Show User') . '</a>'
                    . '<a href="' . route('member-update.create', $user->id) . '" data-fullscreen="true" class="dropdown-item ajax-modal">' . __('Edit User') . '</a></div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['member_names', 'email','status', 'action'])
            ->make(true);

    }
    public function accountNumber()
    {
        return view('office.bank');
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
    public function show(string $id)
    {
        //
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
