<?php

namespace App\Http\Controllers;

use App\Models\SavingUploadDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SavingsUploadController extends Controller
{
    //
    public function get_saving_data(Request $request)
    {

        $savings = SavingUploadDetail::orderBy('created_at', "desc");

        // $invoices = Invoice::with("client")
        //     ->select('invoices.*')
        //     ->orderBy("invoices.id", "desc");

        return DataTables::eloquent($savings)
            ->filter(function ($query) use ($request) {
                if ($request->has('deduction_period')) {
                    $query->where('deduction_period', 'like', "%{$request->get('deduction_period')}%");
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
            ->editColumn('total_amount', function ($savings) {
                return  showAmountPer($savings->total_saving);
            })
            ->editColumn('approval', function ($savings) {
                return $savings->approvedBy->last_name ?? " ";
            })
            ->editColumn('uploaded', function ($savings) {
                return $savings->uploadedBy->last_name ?? " ";
            })
            ->addColumn('action', function ($savings) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a href="' . route('deposit.show', $savings->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-savings"></i> ' . __('Show savings') . '</a></div>';
            })
            ->setRowId(function ($savings) {
                return "row_" . $savings->id;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
