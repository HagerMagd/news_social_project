@extends('layouts.frontend.app')
@section('title')
    Notifications
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        @include('frontend.user-dashboard._slidbar',['notifi_active'=>'active'])

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('frontend.dashboard.notification.deleteAll') }}" style="margin-left:270px"
                            class="btn btn-sm btn-danger">Delete All</a>
                    </div>

                </div>
                @forelse (auth()->user()->notifications as $notify)
                    <a href="{{ $notify->data['url'] }}?notify={{ $notify->id }}">
                        <div class="notification alert alert-info">
                            <strong>You Have New Comment From {{ $notify->data['user_name'] }}</strong> on
                            {{ $notify->data['post_title'] }} Post   <strong>since </strong>   {{$notify->created_at->diffForHumans()}}
                            <div class="float-right">
                                <button class="btn btn-danger btn-sm"
                                onclick="if(confirm('Are Y Sure Delete This Notifiction ?'))
                              {document.getElementById('deletenotify').submit()} return false"  
                                >Delete</button>
                            </div>
                        </div>
                    </a>
                    <form action="{{ route('frontend.dashboard.notification.delete') }}" method="POST" id='deletenotify'>
                    @csrf
                        <input hidden name="notify_id" value="{{ $notify->id }}">
                    </form>
                @empty
                    <div class="alert alert-info">

                        No Notifiction Yet !!

                    </div>
                @endforelse



            </div>
        </div>
    </div>
    <!-- Dashboard End-->
@endsection
