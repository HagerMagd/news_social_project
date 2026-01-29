<?php

namespace App\Http\Controllers\Admin\Auth\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotifi;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPassword extends Controller

{
    public $otp;
    public function __construct()
    {
        $otp=$this->otp = new Otp;
        
    }
    public function ShowEmailForm(){
        return view('dashbord.passwords.email');
    }
    public function SendOtp(Request $request){
    
    $request->validate(['email'=>'required','email']);
    $admin=Admin::where('email',$request->email)->first();
    if(!$admin){
        return redirect()->back()->withErrors(['email'=>'Try Again Later!']);
    }
    $admin->notify( new SendOtpNotifi());
    return redirect()->route('admin.password.showotpform',['email'=>$admin->email]);

    }
    public function ShowotpForm($email){
        return view('dashbord.passwords.confirm',['email'=>$email]);
    }
    public function VreifyOtp(Request $request){
         $request->validate([
        'email'=>['required','email'],
        'confirmcode'=>['required','min:5'],
    ]);
    $otp = $this->otp->validate($request->email,$request->confirmcode);
    if ($otp->status == false){
        return redirect()->back()->withErrors(['token'=>'invalid code !']);
    }return redirect()->route('admin.password.reset.form',['email'=>$request->email]);

    }

}
