<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\ProductService;
use App\Models\Sale;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanRequestController extends Controller
{
    //
    public function storeLoanRequest(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'user_id' => 'required',
            'loan_type' => ['required'],
            'amount' =>'required|numeric',
            'total_installments' => 'required|numeric',
            'purpose' => 'required',
            'account_number' => 'required_if:loan_type,Financial',
            'bank_name' => 'required_if:loan_type,Financial',
            'account_name' => 'required_if:loan_type,Financial',
            'product_service_id.*' => 'sometimes',
            'product_price.*' => 'sometimes|numeric',
            'product_quantity.*' => 'sometimes|numeric',
            'select_line_total.*' => 'sometimes|numeric',
           'witness_name' => 'required_if:loan_type,Financial|array',
            'witness_name.*' => 'nullable|string',
            'witness_department' => 'required|array|required_if:loan_type,Financial',
            'witness_department.*' => 'nullable|string',
            'witness_phone' => 'array|required_if:loan_type,Financial',
            'witness_phone.*' => 'nullable|string'
        ]);

        // dd($data);
        DB::transaction(function () use ($data) {
        $loan = Loan::create([
            'user_id' => $data['user_id'],
            'amount'  => $data['amount'],
            'loan_type' => ($data['loan_type']== "Financial") ? 1: 2,
            'status' => 0,
            'given_installment' => 0,
            'total_installments' => $data['total_installments'],
            'purpose' => $data['purpose'],
            'is_disbursed' =>false,

        ]);
        if($data['loan_type']== "Financial"){
        foreach ($data['witness_name'] as $key => $value) {
            $loan->guarantors()->create([
                'name' => $data['witness_name'][$key],
                'department' => $data['witness_department'][$key],
                'phone' => $data['witness_phone'][$key],
                'witness_accepts' => 1
            ]);
        }
    }
       if(isset($data['account_number'])){
        $loan->loanBank()->create([
            'account_number' => $data['account_number'],
            'account_name'   =>$data['account_name'],
            'bank_name' => $data['bank_name']
        ]);

       }
       if($data['loan_type'] == 'Electronics'){
       $loan_sale = LoanProduct::create([
            'user_id' => $data['user_id'],
            'status'  => 1,
            'total_cost' => $data['amount'],
            'loan_id' => $loan->id,
        ]);
        foreach ($data['product_service_id'] as $key => $value) {

            $loan_sale->loanProductDetails()->create([
                'product_service_id' => $data['product_service_id'][$key],
                'quantity' => $data['product_quantity'][$key],
                'selling_price' => $data['product_price'][$key],
            ]);
       }
    }

    });
    return redirect()->route('all.loans')->with([
        'message' => 'you have successfully Applied for Loan'
    ]);

    }
    public function selfstoreLoanRequest(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'loan_type' => ['required'],
            'amount' =>'required|numeric',
            'total_installments' => 'required|numeric',
            'purpose' => 'required',
            'account_number' => 'required_if:loan_type,Financial',
            'bank_name' => 'required_if:loan_type,Financial',
            'account_name' => 'required_if:loan_type,Financial',
            'product_service_id.*' => 'sometimes',
            'product_price.*' => 'sometimes|numeric',
            'product_quantity.*' => 'sometimes|numeric',
            'select_line_total.*' => 'sometimes|numeric',
            'witness_name' => 'required_if:loan_type,Financial|array',
            'witness_name.*' => 'sometimes|string',
            'witness_department' => 'required|array|required_if:loan_type,Financial',
            'witness_department.*' => 'sometimes|string',
            'witness_phone' => 'array|required_if:loan_type,Financial',
            'witness_phone.*' => 'sometimes|string'
        ]);

        // dd($data);
        DB::transaction(function () use ($data) {
        $loan = Loan::create([
            'user_id' => auth()->user()->id,
            'amount'  => $data['amount'],
            'loan_type' => ($data['loan_type']== "Financial") ? 1: 2,
            'status' => 0,
            'given_installment' => 0,
            'total_installments' => $data['total_installments'],
            'purpose' => $data['purpose'],
            'is_disbursed' =>false,

        ]);
        foreach ($data['witness_name'] as $key => $value) {
            $loan->guarantors()->create([
                'name' => $data['witness_name'][$key],
                'department' => $data['witness_department'][$key],
                'phone' => $data['witness_phone'][$key],
                'witness_accepts' => 1
            ]);
        }

       if(isset($data['account_number'])){
        $loan->loanBank()->create([
            'account_number' => $data['account_number'],
            'account_name'   =>$data['account_name'],
            'bank_name' => $data['bank_name']
        ]);
       }
       if(isset($data['account_number'])){
        $loan->loanBank()->create([
            'account_number' => $data['account_number'],
            'account_name'   =>$data['account_name'],
            'bank_name' => $data['bank_name']
        ]);

       }
       if($data['loan_type'] == 'Electronics'){
        $loan_sale = LoanProduct::create([
             'user_id' => auth()->user()->id,
             'status'  => 1,
             'total_cost' => $data['amount'],
             'loan_id' => $loan->id,
         ]);
         foreach ($data['product_service_id'] as $key => $value) {
             $product_life = ProductService::find($data['product_service_id'][$key]);
             $loan_sale->loanProductDetails()->create([
                 'product_service_id' => $data['product_service_id'][$key],
                 'quantity' => $data['product_quantity'][$key],
                 'selling_price' => $data['product_price'][$key],
             ]);
        }
     }

    });
    return redirect()->route('self-loan.all',auth()->user()->id)->with([
        'message' => 'you have successfully Applied for Loan'
    ]);

    }

}
