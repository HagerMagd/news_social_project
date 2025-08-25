<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\SettingRequest;
use App\utlis\ImagesManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.user-dashboard.setting', compact('user'));
    }
    public function updatesetting(SettingRequest $request)
    {
        $request->validated();
        $user = User::findOrfail(auth()->user()->id);
        $user->update(request()->except('_token', 'image'));
        ImagesManger::uploadImages($request,null,$user);
        return redirect()->back()->with('success', 'Profile Setting Updated Sucessfully!');
    }
    public function changePassword(Request $request)
    {
        $request->validate([

            'current_password'=>['required'],
            'password'=>['required','confirmed'],
            'password_confirmation'=>['required']
            
        ]);
        if(!Hash::check($request->current_password,auth()->user()->password)){
           Session::flash('error','Password Does not Match ');
           return redirect()->back();
        }
        
        $user=User::findOrFail(auth()->user()->id);
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
       Session::flash('success','Password Changed ');
         return redirect()->back();
    }
    
}
