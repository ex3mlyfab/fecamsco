<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Member;
use App\Models\User;
use App\Models\Deposit;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     private $memberContribution = null;
    public function index(Request $request): View
    {
        $registered = Member::whereIn('status',[3,6])->count();
        $awaiting = Member::where('status',2)->count();
        $denied= Member::where('status',1)->count();
        $newUser= User::doesntHave('member')->count();


            return view('users.index',
        [
            'registered' =>$registered,
            'awaiting' => $awaiting,
            'denied' => $denied,
            'newUser' => $newUser
        ]);
    }
    public function awaitingApproval(): View
    {
        return view('users.awaiting_approval');
    }
    public function deniedApproval(): View
    {
        return view('users.denied_approval');
    }
    public function onlineRegistered(): View
    {
        return view('users.online_registered');
    }
    public function member(){
        return view('users.registered_member');
    }
    public function updateEmail(User $user)
    {
        return view('users.change-email', compact('user'));
    }
    public function generateFullName(){

        $sep = " \n\t";
        User::all()->each(function($user) use ($sep){
            $names = [];
            $token = strtok($user->last_name, $sep);
            while ($token !== false) {
                $names[] = $token;
                $token = strtok($sep);
            }
            // dd($names);
            $user->last_name = $names[0];
            if( array_key_exists(1, $names) && $names[1] != null){
                $user->middle_name = $names[1];
            }
            if( array_key_exists(2, $names) && $names[2] != null){
                $user->first_name = array_slice($names, 2);
            }else{
                $user->last_name = $user->last_name;
            }
            $user->save();

        });
    }
    public function get_table_data(Request $request)
    {

        $users = User::query()
            ->with('member')
            ->select('users.*')
            ->orderBy('users.id', "desc");

        // $invoices = Invoice::with("client")
        //     ->select('invoices.*')
        //     ->orderBy("invoices.id", "desc");

        return DataTables::eloquent($users)
            ->filter(function ($query) use ($request) {
                if ($request->has('last_name')) {
                    $query->where('users.fullname_virtual', 'like', "%{$request->get('last_name')}%");
                }

                // if ($request->has('ippis')) {
                //    $query->where('members.ippis_no', $request->get('ippis'));
                // // }

                // if ($request->has('status')) {
                //     $query->whereIn('status', json_decode($request->get('status')));
                // }

                // if ($request->has('date_range')) {
                //     $date_range = explode(" - ", $request->get('date_range'));
                //     $query->whereBetween('invoice_date', [$date_range[0], $date_range[1]]);
                // }
            })
            // ->editColumn('grand_total', function ($invoice) use ($currency) {
            //     return "<span class='float-right'>" . decimalPlace($invoice->grand_total, $currency) . "</span>";
            // })
            ->editColumn('status', function ($user) {

                return member_status($user->member_status);
            })
            ->editColumn('user_names', function ($user) {
                return $user->fullname_virtual;
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
            ->rawColumns(['other_names', 'status', 'action'])
            ->make(true);
    }
    public function get_member_data(Request $request)
    {
        $users = Member::whereIn('status', [3,6])
                ->join('users', 'members.user_id', '=', 'users.id')
                ->select('members.*', 'users.fullname_virtual', 'users.email')
                ->orderBy('created_at', 'desc');


        return DataTables::eloquent($users)
         ->filter(function ($query) use ($request) {
                if ($request->has('last_name')) {
                    $query->where('users.fullname_virtual', 'like', "%{$request->get('last_name')}%");
                }
                if ($request->has('ippis')) {
                   $query->where('members.ippis_no','like',  "%{$request->get('ippis')}%");
                }
            })
            ->editColumn('email', function ($user) {

                return $user->user->email;
            })
            ->editColumn('status', function ($user) {

                return member_status($user->status);
            })
            ->editColumn('member_names', function ($user) {
                return $user->user->fullname_virtual;
            })
            ->addColumn('action', function ($user) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a href="' . route('user.show', $user->user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-user"></i> ' . __('Show User') . '</a>'
                    . '<a href="' . route('member-update.create', $user->user->id) . '" data-fullscreen="true" class="dropdown-item ajax-modal">' . __('Edit User') . '</a>'
                    .'<a href="' . route('member-email.create', $user->user->id) . '" data-fullscreen="true" class="dropdown-item ajax-modal">' . __('Edit User Email') . '</a>'.'</div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['member_names', 'email','status', 'action'])
            ->make(true);
    }
    public function get_awaiting_data(Request $request)
    {
        $users = Member::where('status',2)
                ->join('users', 'members.user_id', '=', 'users.id')
                ->select('members.*', 'users.first_name', 'users.email')
                ->orderBy('created_at', 'desc');


        return DataTables::eloquent($users)
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
                    . '<a href="' . route('user.show', $user->user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-user"></i> ' . __('Show User') . '</a>'
                    . '<a href="' . route('member-update.create', $user->user->id) . '" data-fullscreen="true" class="dropdown-item ajax-modal">' . __('Edit User') . '</a></div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['member_names', 'email','status', 'action'])
            ->make(true);
    }
    public function get_online_data(Request $request)
    {
        $users = User::doesntHave('member')
                ->orderBy('created_at', 'desc');


        return DataTables::eloquent($users)
            ->editColumn('member_names', function ($user) {
                return $user->middle_name . ' ' . $user->last_name . " ". $user->first_name;
            })
            ->editColumn('status', function () {
                return 'Online registered';
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
            ->rawColumns(['member_names', 'action'])
            ->make(true);
    }
    public function get_denied_data(Request $request)
    {
        $users = Member::where('status', 1)
                ->join('users', 'members.user_id', '=', 'users.id')
                ->select('members.*', 'users.first_name', 'users.email')
                ->orderBy('created_at', 'desc');


        return DataTables::eloquent($users)
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
                    . '<a href="' . route('user.show', $user->user->id) . '" class="dropdown-item ajax-modal"><i class="fa fa-user"></i> ' . __('Show User') . '</a>'
                    . '<a href="' . route('member-update.create', $user->user->id) . '" data-fullscreen="true" class="dropdown-item ajax-modal">' . __('Edit User') . '</a></div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['member_names', 'email','status', 'action'])
            ->make(true);
    }
    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['email','other_names' ,'action'])
                ->make(true);
        }
    }


    public function getMoreUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function usersContribution(User $user){
        return view('users.contribution', [
            'user' =>$user
        ]);
    }
    public function memberContribution(User $user){
        $this->memberContribution = $user->id;
        return view('users.adminUserContribution', [
            'user' =>$user
        ]);
    }
    public function get_user_contribution_data(Request $request, User $user)
    {
        //dd($this->memberContribution);
         $users = Deposit::where('user_id', $user->id)
                ->orderBy('description', 'desc');


        return DataTables::eloquent($users)
            ->editColumn('amount', function ($user) {

               return showAmountPer($user->amount);
            })
            ->editColumn('period', function ($user) {

                return $user->description->format('M-Y');
            })
            ->editColumn('serial_number', function ($user) {
                return $user->ind +1;
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
             ->addIndexColumn()
            ->rawColumns(['amount', 'period'])
            ->make(true);
    }
    public function usersLoan(User $user){
        return view('users.loans', [
            'user' =>$user
        ]);
    }
    public function assignRoleToUser(){
        return view('office.assign-role',[
            'users' => User::query()->whereHas('member', function ($query) {
                $query->whereIn('status', [3,6]);
            })->get(),
            'roles' => Role::whereNotIn('name', ['SuperAdmin'])->get()
        ]);
    }
    public function processAssignRole(Request $request)
    {

        $data = $request->validate([
            'user_id'=> 'required|numeric',
            'role_id' => 'required|numeric'
        ]);
        $data = $request->user_id;
        $nominal = $request->role_id;
        $role= Role::find($nominal);
        $user = User::find($data);
        $user->syncRoles([$role]);

        return redirect()->route('role.assign')->with('message', 'Role Assigned Successfully');

    }
    public function declineMembership(User $user){
        $user->member()->update([
            'status' => 1
        ]);
        return redirect()->route('all.users')->with('message', 'Member Status changed Succesfully');
    }
    public function approveMembership(User $user){
        $user->member()->update([
            'status' => 3
        ]);
        return redirect()->route('all.users')->with('message', 'Member Status changed Succesfully');
    }
    public function updateContribution(User $user)
    {
        return view('users.update-contribution', [
            'user' =>$user
        ]);
    }
    public function olaTable()
    {
        return view('users.try');
    }
    public function tryQuery(Request $request)
    {
        // $q = $request->get('q');
        // $perPage = $request->get('per_page', 10);
        // $sort = $request->get('sort');

        // $users = QueryBuilder::for(User::class)
        //     ->allowedSorts(['first_name', 'email','last_name'])
        //     ->where('first_name', 'like', "%$q%")
        //     ->orWhere('email', 'like', "%$q%")
        //     ->latest()
        //     ->paginate($perPage)
        //     ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);


        // return array("data" => $users);
        $model = User::query();
        $dataTables = new DataTables();
        return $dataTables->eloquent($model)
            ->make(false);
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
    public function show(User $user)
    {
        return view('users.profile', [
            'user' => $user
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
