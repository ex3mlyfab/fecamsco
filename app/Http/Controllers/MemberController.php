<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    public function showSelfUpdate(){
        return view('users.update-member');
    }
    public function storeSelfUpdate(Request $request, User $user)
    {

        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:100'],
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'email'=>  ["required","email",Rule::unique('users')->ignore($user->id)],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'telephone' => ['required', 'numeric'],
            'department' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'file_no' => 'nullable|string',
            'rank' => 'nullable|string',
            'grade' => 'nullable|string',
            'ippis_no' => ["required", "numeric",Rule::unique('members')->ignore($user->member->id)],
            'residential_address' => 'required|string',
            'permanent_address' => 'required|string',
            'next_of_kin' => 'required|string',
            'nok_relationship' => 'required|string',
            'nok_address' => ['required', 'string'],
            'deduction_amount' => 'nullable|numeric',
            'effective_date' => 'nullable',
            'witness_name' => 'nullable|array',
            'witness_name.*' => 'nullable|required|string',
            'witness_department' => 'nullable|array',
            'witness_department.*' => 'nullable|required|string',
            'witness_phone' => 'nullable|array',
            'witness_phone.*' => 'nullable|required|string',
            'passport_photograph' => 'nullable|image'
        ]);

        if (isset($data['passport_photograph'])) {
            //

            $file = $data['passport_photograph']; // your base64 encoded
            // dd($request->passport_photograph, public_path());
            // using file pond
            // $image = str_replace('data:image/png;base64,', '', $image);
            // // $image = str_replace(' ', '+', $image);
            // @list($type, $file_data) = explode(';', $image);
            // @list(, $file_data) = explode(',', $file_data);
            $storage_path = public_path('backend/images/userAvatar');
            // $extension = $file->getClientOriginalExtension();
            // if(isset(auth()->user()->member->avatar))
            // {
            //    Storage::delete('avatars/'.auth()->user()->member->avatar);
            // }
            // $filepath = public_path('uploads/');

            $extension = $file->getClientOriginalExtension();
                // $path = $file->storeAs(
                //     'avatars', $data['last_name']. Date('Y-m-d') . 'user' . '.' . $extension
                // );
            $fileName =  $data['last_name']. Date('Y-m-d') . 'member' . '.' . $extension;
            $file->move($storage_path, $fileName);


            $data['avatar'] = $fileName;
        }


        DB::transaction(function () use ($data,$user) {
            $user->update([
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'],
                'first_name' => $data['first_name'],
                'title' => $data['title'],
                'email' => $data['email'],
            ]);

            if(isset($data['avatar'])){
                $user->member()->update([
                    'avatar' => $data['avatar']
                    ]);
            }

            $user->member()->update([
                'telephone' => $data['telephone'],
                'department' => $data['department'],
                'location' => $data['location'],
                'file_no' => $data['file_no'],
                'rank' => $data['rank'],
                'grade' => $data['grade'],
                'residential_address' => $data['residential_address'],
                'permanent_address' => $data['permanent_address'],
                'next_of_kin' => $data['next_of_kin'],
                'nok_relationship' => $data['nok_relationship'],
                'nok_address' => $data['nok_address'],
                'declaration' => 1,
                'status' => 6
            ]);
        });
        return redirect()->route('user.show', auth()->user()->id)->with([
            'message' => 'you have successfully updated your membership'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.member');
    }
    public function addNewMember()
    {
        return view('office.create');
    }
    public function updateMember(User $member)
    {
        return view('office.update-member',[
            'member' => $member
        ]);
    }
    public function storeMemberImage($imageFile){

    }
    public function updateMemberStore(Request $request, User $member)
    {
        $data = $request->validate([

            'title' => ['nullable', 'string', 'max:100'],
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'email'=> ["required","email",Rule::unique('users')->ignore($member->id)],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'telephone' => ['required', 'numeric'],
            'department' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'file_no' => 'nullable|string',
            'rank' => 'nullable|string',
            'grade' => 'nullable|string',
            'ippis_no' => ["required", "numeric",Rule::unique('members')->ignore($member->member->id)],
            'residential_address' => 'required|string',
            'permanent_address' => 'required|string',
            'next_of_kin' => 'required|string',
            'nok_relationship' => 'required|string',
            'nok_address' => ['required', 'string'],
            'deduction_amount' => 'nullable|numeric',
            'effective_date' => 'nullable',
            'witness_name' => 'nullable|array',
            'witness_name.*' => 'nullable|required|string',
            'witness_department' => 'nullable|array',
            'witness_department.*' => 'nullable|required|string',
            'witness_phone' => 'nullable|array',
            'witness_phone.*' => 'nullable|required|string',
            'passport_photograph' => 'nullable|image'
        ]);
        if (isset($data['passport_photograph'])) {
            //
            $file = $data['passport_photograph']; // your base64 encoded
            // using file pond
            // $image = str_replace('data:image/png;base64,', '', $image);
            // // $image = str_replace(' ', '+', $image);
            // @list($type, $file_data) = explode(';', $image);
            // @list(, $file_data) = explode(',', $file_data);
            $storage_path = public_path() . '/backend/images/userAvatar';


            // if(isset($member->member->avatar))
            // {
            //    Storage::delete('avatars/'.$member->member->avatar);
            // }

            // $extension = $file->getClientOriginalExtension();
            //     $path = $file->storeAs(
            //         'avatars', $data['last_name']. Date('Y-m-d') . 'user' . '.' . $extension
            //     );

            //     $data['avatar'] = $path;
            $extension = $file->getClientOriginalExtension();
                // $path = $file->storeAs(
                //     'avatars', $data['last_name']. Date('Y-m-d') . 'user' . '.' . $extension
                // );
            $fileName =  $data['last_name']. Date('Y-m-d') . 'member' . '.' . $extension;
            $file->move($storage_path, $fileName);

            $data['avatar'] = $fileName;
        }


        DB::transaction(function () use ($data, $member) {
            $member->update([
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'],
                'first_name' => $data['first_name'],
                'title' => $data['title'],
                'email' => $data['email'],
            ]);


            if(isset($data['avatar'])){
                $member->member()->update([
                    'avatar' => $data['avatar']
                    ]);
            }
            $member->member()->update([
                'telephone' => $data['telephone'],
                'department' => $data['department'],
                'location' => $data['location'],
                'file_no' => $data['file_no'],
                'rank' => $data['rank'],
                'grade' => $data['grade'],
                'residential_address' => $data['residential_address'],
                'permanent_address' => $data['permanent_address'],
                'next_of_kin' => $data['next_of_kin'],
                'nok_relationship' => $data['nok_relationship'],
                'nok_address' => $data['nok_address'],
                'declaration' => 1,
                'status' => 6
            ]);
        });
        return redirect()->route('user.show', $member->id)->with([
            'message' => 'you have successfully updated membership Details'
        ]);
    }
    public function storeNewMember(Request $request)
    {
        $data = $request->validate([

            'title' => ['nullable', 'string', 'max:100'],
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'email'=> 'required|string|unique:users,email',
            'middle_name' => ['nullable', 'string', 'max:100'],
            'telephone' => ['required', 'numeric'],
            'department' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'file_no' => 'nullable|string',
            'ippis_no' => 'required|string|unique:members,ippis_no',
            'rank' => 'nullable|string',
            'grade' => 'nullable|string',
            'residential_address' => 'required|string',
            'permanent_address' => 'required|string',
            'next_of_kin' => 'required|string',
            'nok_relationship' => 'required|string',
            'nok_address' => ['required', 'string'],
            'deduction_amount' => 'required|numeric',
            'effective_date' => 'required',
            'witness_name' => 'required|array',
            'witness_name.*' => 'sometimes|required|string',
            'witness_department' => 'required|array',
            'witness_department.*' => 'sometimes|required|string',
            'witness_phone' => 'required|array',
            'witness_phone.*' => 'sometimes|required|string',
            'passport_photograph' => 'nullable|image'
        ]);

        if (isset($data['passport_photograph'])) {
            //
            $file = $data['passport_photograph']; // your base64 encoded
            // using file pond
            // $image = str_replace('data:image/png;base64,', '', $image);
            // // $image = str_replace(' ', '+', $image);
            // @list($type, $file_data) = explode(';', $image);
            // @list(, $file_data) = explode(',', $file_data);
            $storage_path = public_path() . '/backend/images/userAvatar';
            $extension = $file->getClientOriginalExtension();

            $fileName = $data['last_name']. Date('Y-m-d') . 'member' . '.' . $extension;
            $file->move($storage_path, $fileName);
            // $extension = $file->getClientOriginalExtension();
            // $path = $file->storeAs(
            //     'avatars', $data['last_name']. Date('Y-m-d') . 'user' . '.' . $extension
            // );

            $data['avatar'] = $fileName;

        }
        DB::transaction(function () use ($data) {
            $user = User::create([
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'],
                'first_name' => $data['first_name'],
                'title' => $data['title'],
                'email' => $data['email'],
                'password' => Hash::make($data['last_name']."&". $data['first_name']),
            ]);


            $user->member()->create([
                'telephone' => $data['telephone'],
                'department' => $data['department'],
                'location' => $data['location'],
                'file_no' => $data['file_no'],
                'ippis_no' => $data['ippis_no'],
                'rank' => $data['rank'],
                'grade' => $data['grade'],
                'residential_address' => $data['residential_address'],
                'permanent_address' => $data['permanent_address'],
                'next_of_kin' => $data['next_of_kin'],
                'nok_relationship' => $data['nok_relationship'],
                'nok_address' => $data['nok_address'],
                'deduction_amount' => $data['deduction_amount'],
                'effective_date' => $data['effective_date'],
                'declaration' => 1,
                'avatar' => $data['avatar'],
                'status' => 6
            ]);
            $user->deductions()->create([
                'deduction_amount' => $data['deduction_amount'],
                'effective_from' => $data['effective_date'],
                'status' => true
            ]);
            foreach ($data['witness_name'] as $key => $value) {
                $user->guarantors()->create([
                    'name' => $data['witness_name'][$key],
                    'department' => $data['witness_department'][$key],
                    'phone' => $data['witness_phone'][$key],
                    'witness_accepts' => 1
                ]);
            }
        });

        return redirect()->route('all.users')->with([
            'message' => 'you have successfully registered new Member' ]);

    }

    public function viewAvatar($location): ?StreamedResponse
    {
        return Storage::disk('public')->response($location);
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'middle_name' => ['nullable', 'string', 'max:100'],
            'telephone' => ['required', 'numeric'],
            'department' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'file_no' => 'nullable|string',
            'ippis_no' => 'required|string',
            'rank' => 'nullable|string',
            'grade' => 'nullable|string',
            'residential_address' => 'required|string',
            'permanent_address' => 'required|string',
            'next_of_kin' => 'required|string',
            'nok_relationship' => 'required|string',
            'nok_address' => ['required', 'string'],
            'deduction_amount' => 'required|numeric',
            'effective_date' => 'required',
            'witness_name' => 'required|array',
            'witness_name.*' => 'sometimes|required|string',
            'witness_department' => 'required|array',
            'witness_department.*' => 'sometimes|required|string',
            'witness_phone' => 'required|array',
            'witness_phone.*' => 'sometimes|required|string',
            'declared' => 'required',
            'passport_photograph' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048'

        ]);
        // dd($data);
        if (isset($data['passport_photograph'])) {
            //

            $file = $data['passport_photograph']; // your base64 encoded
            // using file pond
            // $image = str_replace('data:image/png;base64,', '', $image);
            // // $image = str_replace(' ', '+', $image);
            // @list($type, $file_data) = explode(';', $image);
            // @list(, $file_data) = explode(',',// $storage_path = public_path() . '/backend/images/userAvatar';
             $extension = $file->getClientOriginalExtension();
            $fileName = auth()->user()->last_name . Date('Y-m-d') .'.' . $extension;
            $storage_path = public_path() . '/backend/images/userAvatar';
            $file->move($storage_path, $fileName);

            $path = $file->storeAs(
                'avatars', auth()->user()->last_name. Date('Y-m-d') . 'user' . '.' . $extension
            );

            $data['avatar'] = $fileName;
        }


        DB::transaction(function () use ($data) {
            $user = auth()->user();
            if (isset($data['middle_name'])) {
                $user->update([
                    'middle_name' => $data['middle_name']
                ]);
            }
            $user->member()->create([
                'telephone' => $data['telephone'],
                'department' => $data['department'],
                'location' => $data['location'],
                'file_no' => $data['file_no'],
                'ippis_no' => $data['ippis_no'],
                'rank' => $data['rank'],
                'grade' => $data['grade'],
                'residential_address' => $data['residential_address'],
                'permanent_address' => $data['permanent_address'],
                'next_of_kin' => $data['next_of_kin'],
                'nok_relationship' => $data['nok_relationship'],
                'nok_address' => $data['nok_address'],
                'deduction_amount' => $data['deduction_amount'],
                'effective_date' => $data['effective_date'],
                'declaration' => 1,
                'status' => 2
            ]);
            if(isset($data['avatar'])){
                $user->member()->update([
                    'avatar' => $data['avatar']
                    ]);
            }
            $user->deductions()->create([
                'deduction_amount' => $data['deduction_amount'],
                'effective_from' => $data['effective_date'],
                'status' => true
            ]);
            foreach ($data['witness_name'] as $key => $value) {
                $user->guarantors()->create([
                    'name' => $data['witness_name'][$key],
                    'department' => $data['witness_department'][$key],
                    'phone' => $data['witness_phone'][$key],
                    'witness_accepts' => 1
                ]);
            }
        });
        return redirect()->route('user.show', auth()->user()->id)->with([
            'message' => 'you have successfully registered your membership'
        ]);
        // dd('successful');
    }
    public function guarantorFormDownload(User $user){

        $userP  =[
            'fullname' => $user->fullname,
            'guarantors' => $user->guarantors,
        ];

        $pdf = FacadePdf::loadView('layouts.pdf-views.guarantors', $userP);
        return $pdf->download($user->fullname.'Guarantors.pdf');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function manualDeposit(User $user){
        return view('users.manual-deposit', compact('user'));
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
