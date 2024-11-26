<?php

namespace App\Http\Controllers;

use App\Models\Ctls;
use App\Models\CtlsDetails;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Member;
use App\Models\SavingUpload;
use App\Models\SavingUploadDetail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SavingDepositCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('office.index');
    }
    public function get_contribution_data(Request $request)
    {
        $users = SavingUploadDetail::orderBy('deduction_period', 'desc');

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
            ->editColumn('amount', function ($user) {

                return showAmountPer($user->total_saving);
            })
            ->editColumn('deposit_period', function ($user) {

                return $user->deduction_period->format('Y-M');
            })
            ->editColumn('uploaded_by', function ($user) {
                return ($user->uploadedBy->middle_name ?? " ") . ' ' . ($user->uploadedBy->last_name ?? " ") . " ". ($user->uploadedBy->first_name?? " ");
            })
            ->editColumn('approved_by', function ($user) {
                return ($user->approvedBy->middle_name?? " ") . ' ' . ($user->approvedBy->last_name?? "") . " ". ($user->approvedBy->first_name?? " ");
            })
            ->editColumn('status', function ($user) {
                return $user->upload_status? "Updated": "Not Yet Updated";
            })
            ->addColumn('action', function ($user) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a href="' . route('deposit.show', $user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-note"></i> ' . __('Show Deposit Details') . '</a></div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['deduction_period', 'amount','uploaded_by','approved_by','status', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('office.depositupload');
    }
    public function showCtls(CtlsDetails $ctls)
    {
        $expectedCtls = Member::query()->whereIn('Status', [3,6])->where('created_at', '<=', $ctls->created_at)->count();

        return view('office.ctls-details',[
            'ctls'=>$ctls,
            'expectedCtls' => $expectedCtls

        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function ctls(){
        return view('office.ctlss-upload');
    }
    public function get_ctls_data(Request $request){
        $users = CtlsDetails::orderBy('deduction_period', 'desc');

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
            ->editColumn('amount', function ($user) {

                return showAmountPer($user->total_ctls);
            })
            ->editColumn('deposit_period', function ($user) {

                return $user->deduction_period->format('Y-M');
            })
            ->editColumn('uploaded_by', function ($user) {
                return ($user->uploadedBy->middle_name ?? " ") . ' ' . ($user->uploadedBy->last_name ?? " ") . " ". ($user->uploadedBy->first_name?? " ");
            })
            ->editColumn('approved_by', function ($user) {
                return ($user->approvedBy->middle_name?? " ") . ' ' . ($user->approvedBy->last_name?? "") . " ". ($user->approvedBy->first_name?? " ");
            })
            ->editColumn('status', function ($user) {
                return $user->ctls_updated_status? "Not Yet updated": "Updated";
            })
            ->addColumn('action', function ($user) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a href="' . route('ctls.show', $user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-note"></i> ' . __('Show CTLS Details') . '</a></div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['deduction_period', 'amount','uploaded_by','approved_by','status', 'action'])
            ->make(true);
    }
    public function confirmContribution(SavingUploadDetail $deposit)
    {


        if($deposit->saving_updated_status){
            foreach($deposit->savingUploads as $contribution){
                if(!$contribution->saving_linked){
                    DB::transaction(function () use($deposit, $contribution) {

                       $trying =  explode(" ", strtolower($contribution->employee_name));
                        $secondtry = ($trying[0]) ? $trying[0].$contribution->id : $contribution->id;
                        $userEmail = $trying[1]. '.'. $secondtry . '@femcas.com';
                        $user = Member::where('ippis_no',str_replace(' ', '',$contribution->employee_number))->first();

                        if (!$user) {
                            $user = User::Create([
                                'email' => $userEmail,
                                'password' => Hash::make('superfemcas'),
                                'last_name' => $contribution->employee_name,

                            ]);
                            $user->member()->create([
                                'status' => '6',
                                'ippis_no' => str_replace(' ', '', $contribution->employee_number),
                                'deduction_amount' => $contribution->deduction_amount
                            ]);
                        }else{
                            $user = User::where('id', $user->user_id)->first();
                        }

                        $user->deposits()->create([
                            'description' =>$deposit->deduction_period,
                            'saving_upload_id' => $contribution->id,
                            'amount' => $contribution->deduction_amount,
                            'initial_balance' => $user->total_contribution,
                            'approved_by' => auth()->user()->id,
                            'approval_date' => now()
                        ]);
                        if($user->deductions()->exists()){
                           if($user->deductions()->first()->deduction_amount != $contribution->deduction_amount){
                            $user->deductions()->create([
                                'deduction_amount' =>  $contribution->deduction_amount,
                                'effective_from' => now(),
                                'status' => true
                            ]);
                           }
                        }else{
                            $user->deductions()->create([
                                'deduction_amount' =>  $contribution->deduction_amount,
                                'effective_from' => now(),
                                'status' => true
                            ]);
                        }

                        $transaction = Transaction::create([
                            'approved_by' => auth()->user()->id,
                            'uploaded_by' =>$deposit->uploaded_by,
                            'amount' => $contribution->deduction_amount,
                            'trx_type' => "Member Contribution",
                            'uploaded_date' => $deposit->created_at,
                            'approval_date' =>now(),
                            'transactionable_type' => "App\Models\Deposit",
                            'transactionable_id' => $user->deposits()->first()->id
                        ]);

                       $savingsDetail = SavingUpload::find($contribution->id);

                       $savingsDetail->saving_linked = 1;
                       $savingsDetail->save();
                    });

                }


            }

        }
        $deposit->update([
            'approved_by' => auth()->user()->id,
            'upload_status' => 1
        ]);
        return redirect()->route('deposit.home')->with([
            'message' => 'Contribution Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function confirmCtls(CtlsDetails $ctls)
    {
        if($ctls->ctls_updated_status){
            foreach($ctls->ctls as $contribution){
                if(!$contribution->saving_linked){
                    DB::transaction(function () use($ctls, $contribution) {

                       $trying =  explode(" ", strtolower($contribution->employee_name));
                        $secondtry = ($trying[0]) ? $trying[0].$contribution->id : $contribution->id;
                        $userEmail = $trying[1]. '.'. $secondtry . '@femcas.com';
                        $user = Member::where('ippis_no',str_replace(' ', '',$contribution->employee_number))->first();

                        if (!$user) {
                            $user = User::Create([
                                'email' => $userEmail,
                                'password' => Hash::make('superfemcas'),
                                'last_name' => $contribution->employee_name,

                            ]);
                            $user->member()->create([
                                'status' => '6',
                                'ippis_no' => str_replace(' ', '', $contribution->employee_number),
                                'deduction_amount' => $contribution->deduction_amount
                            ]);
                        }else{
                            $user = User::where('id', $user->user_id)->first();
                        }

                        $transaction = Transaction::create([
                            'approved_by' => auth()->user()->id,
                            'uploaded_by' =>$ctls->uploaded_by,
                            'amount' => $contribution->deduction_amount,
                            'trx_type' => "CTLS",
                            'uploaded_date' => $ctls->created_at,
                            'approval_date' =>now(),
                            'transactionable_type' => "App\Models\Ctls",
                            'transactionable_id' => $ctls->id
                        ]);
                        //get member pending loan
                        if($user->loan_status){
                            //check to see if a repayment matches an amount;
                            if($user->pending_loan_payment){
                                $repayment = $user->pending_loan_payment;
                                $try = $repayment->next_installment;
                                $try->update([
                                    'status' =>1,
                                    'transaction_id' => $contribution->id
                                ]);
                               if(!$repayment->installment_fulfilled){
                                    $repayment->update([
                                        'status' => 2
                                    ]);
                               }
                            }else{
                                //if it doesnot match any amount pick any loan that is still pending and repay.
                                $recover = $user->loans->firstWhere('status', 1);
                                $recover->installments()->create([
                                    'installment_number' => 1,
                                    'amount' => $contribution->deduction_amunt,
                                    'status' => 1,
                                    'transaction_id' => $contribution->id
                                ]);
                            }
                        }
                        else{
                            $new_loan = Loan::create([
                                'user_id' =>$user->id,
                                'amount'  => $contribution->deduction_amount,
                                'loan_type' => 1,
                                'status' => 2,
                                'given_installment' => 1,
                                'is_disbursed' => 1,
                                'total_installments' =>1,
                                'purpose' => 'system generated'
                            ]);

                            $new_loan->installments()->create([
                                'installment_number' => 1,
                                'amount' => $contribution->deduction_amount,
                                'status' => 1,
                                'transaction_id' => $contribution->id,

                            ]);
                        }





                       $savingsDetail = Ctls::find($contribution->id);

                       $savingsDetail->saving_linked = 1;
                       $savingsDetail->save();
                    });

                }


            }

        }
        $ctls->update([
            'approved_by' => auth()->user()->id,
            'upload_status' => 1
        ]);
        return redirect()->route('ctls.home')->with([
            'message' => 'CTLS Details Updated Successfully'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(SavingUploadDetail $deposit)
    {
        //
        $expectedCtss = Member::query()->whereIn('Status', [3,6])->where('created_at', '<=', $deposit->created_at)->count();

        return view('office.depositupload', [
            'deposit_upload' => $deposit,
            'expectedCtss' => $expectedCtss
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
