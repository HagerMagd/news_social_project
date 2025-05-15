<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){

        return view('frontend.contact-us');
    }

    public function store(ContactRequest  $request){
       $request->validated();
       $request->merge([
        'ip_address'=>$request->ip(),
       ]);
        $contact= Contact::create($request->except('_token'));
        if(!$contact){
            Session::flash('error','contact us failed');
             return redirect()->back();
        }
        session::flash('success','your message created successfully');
        return redirect()->back();
            
    }
    
}
