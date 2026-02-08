<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use function PHPUnit\Framework\returnArgument;

class AdminLoginController extends Controller
{
    public function __construct()
    {
    $this->middleware(['guest:admin'])->only('LoginForm','CheckData');
    $this->middleware(['auth:admin'])->only('LogOut');
    }
    public function LoginForm()
    {
        return view('dashbord.adminauth.login');
    }
    public function CheckData(Request $request)
    {
        $request->validate($this->FilterData());
        if(Auth::guard('admin')->attempt([
        'email'=>$request->email,
        'password'=>$request->password]
        ,$request->remember)) 
        {
            return redirect()->intended(RouteServiceProvider::AdminHome);
        }
        return redirect()->back()->with('error','Try again');
    }
    private function FilterData() :array
    {
        return [
            'email'=>['required','email'],
            'password'=>['required','min:9'],
            'remember'=>['in:on,off'],
        ];
    }
    public function LogOut(Request $request){
       Auth::guard('admin')->logout();
       return redirect()->route('admin.login.show');
    }
}
