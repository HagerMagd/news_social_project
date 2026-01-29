<?php

namespace App\Http\Controllers\Admin\Auth\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function showResetForm($email){
        return view('dashbord.passwords.reset',['email'=>$email]);
       
}
    public function ResetPassword(Request $request)
    {
       $request->validate([
        'email'=>['required','email'],
        'password'=>['required','confirmed','min:8'],
        'password_confirmation'=>['required'],
    ]);

    $admin=Admin::where('email',$request->email)->first();
    if(!$admin){
        return redirect()->back()->withErrors(['erorr'=>'try again later !']);
    }$admin->update([
    'password'=>bcrypt($request->password),
    ]);
    return redirect()->route('admin.login.show')->with(['success'=>'Your password has been successfully changed!.']);

    }

}
