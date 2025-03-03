<?php

namespace App\Http\Controllers\frontend;


use Illuminate\Http\Request;
use App\Models\NewsSubscriber;
use App\Http\Controllers\Controller;
use App\Mail\NewSubsriberMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewsSubscribController extends Controller
{
    public function store( Request $request)
    {
        $request->validate([
            'email'=>['required','email','unique:news_subscribers,email'],
        ]);

        $NewsSubscriber=NewsSubscriber::create([
            'email'=> $request->email,
        ]);
        if(!$NewsSubscriber){
            //flash()->addError('Sorry, Try Again!');
            Session::flash('error','sorry,try again !');          
             return redirect()->back();
        }
        Mail::to($request->email)->send(new NewSubsriberMail);
        flash()->addSuccess('welcome !');
        return redirect()->back();
    }
}
