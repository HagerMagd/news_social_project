@extends('layouts.frontend.app')
@section('title')
    Notifications
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(Auth::guard('web')->user()->image) }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61">{{ Auth::guard('web')->user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile') }}"
                    class="list-group-item list-group-item-action  menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('frontend.dashboard.notification.index') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting') }}" class="list-group-item list-group-item-action menu-item"
                    data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

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
                            {{ $notify->data['post_title'] }} Post
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
