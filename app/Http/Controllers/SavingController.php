<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('office.transaction');
    }
    public function get_saving_data(Request $request)
    {
        $users = Deposit::join('users', 'deposits.user_id', '=', 'users.id')
                ->select('deposits.*')
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
            ->editColumn('amount', function ($user) {

                return showAmountPer($user->amount);
            })
            ->editColumn('deposit_period', function ($user) {

                return date('M-Y',strtotime($user->description));
            })
            ->editColumn('member_names', function ($user) {
                return $user->user->middle_name . ' ' . $user->user->last_name . " ". $user->user->first_name;
            })
            ->editColumn('email', function ($user) {
                return $user->user->email;
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
            ->rawColumns(['member_names', 'amount','email','deposit_period', 'action'])
            ->make(true);
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
