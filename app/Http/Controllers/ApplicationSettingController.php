<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Executive;
use App\Models\Member;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class ApplicationSettingController extends Controller
{
    public function index(){
        $settings= AppSetting::all();
        return view('app-setting.index', compact('settings'));
    }

    public function storeSetting(Request $request){
       $request->validate([
           'name' => 'required|unique:app_settings,setting_name',
           'value' => 'required'
       ]);

       AppSetting::create([
           'setting_name' => $request->name,
           'setting_value' => $request->value
       ]);

       return redirect()->back()->with('message', 'Setting created successfully');
    }

    public function Update(AppSetting $setting, Request $request){

        // dd($setting);
        $request->validate([
            'name' => 'required',
            'value' => 'required'
        ]);

        $setting->update([
            'setting_name' => $request->name,
            'setting_value' => $request->value
        ]);

        return redirect()->back()->with('message', 'Setting updated successfully');
    }
    public function addUserToExco(Request $request){
       $request->validate([
           'postion' => 'required',
           'user_id' => 'required',
           'status' => 'required',
           'avatar' => 'nullable'
       ]);

       Executive::create([
        'user_id' => $request->user_id,
        'position' => $request->postion,
        'status' => 1,
        'avatar'=> $request->avatar
       ]);

       return redirect()->back()->with('message', 'User added to executives successfully');
    }

    public function executives()
    {
        $members = Member::all();
        $executives = Executive::all();
        return view('app-setting.executives', compact('executives', 'members'));
    }
    public function updateExecutive(Executive $executive, Request $request)
    {
        $request->validate([
 'postion' => 'required',
           'user_id' => 'required',
           'status' => 'required',
           'avatar' => 'nullable'
       ]);

       $executive->update([
         'user_id' => $request->user_id,
        'position' => $request->postion,
        'status' => 1,
        'avatar'=> $request->avatar
       ]);
    }

}
