<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index(){
        auth()->user()->unreadNotifications->markAsRead();
        return view('frontend.user-dashboard.notification');
    }
    public function readAll(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function delete(Request $request){
        $notification=auth()->user()->notifications()->where('id',$request->notify_id);
        $notification->delete();
        Session::flash('success','Your Notification Deleted seccessfully !');
        return redirect()->back();


    }
    public function deleteAll(){
        auth()->user()->notifications()->delete();
        Session::flash('success','Your Notifications Deleted seccessfully !');
        return redirect()->back();
    }
}
