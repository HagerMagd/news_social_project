@extends('layouts.frontend.app')

@section('title')
Setting
@endsection

@section('body')
<!-- Dashboard Start-->
<div class="container mt-4">
  <div class="row">
    
    <!-- Sidebar -->
    <aside class="col-md-3">
      <div class="user-info text-center p-3 border rounded">
        <img
          src="{{asset($user->image)}}"
          alt="User Image"
          class="rounded-circle mb-2"
          style="width: 80px; height: 80px; object-fit: cover"
        />
        <h5 class="mb-0" style="color: #ff6f61"> {{$user->name}}</h5>
      </div>

      <div class="list-group mt-3">
        <a href="{{route('frontend.dashboard.profile')}}" class="list-group-item list-group-item-action">
          <i class="fas fa-user"></i> Profile
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="{{route('frontend.dashboard.setting')}}" class="list-group-item list-group-item-action active">
          <i class="fas fa-cog"></i> Settings
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="col-md-9">
      <h2 class="mb-4">Settings</h2>

      <!-- Settings Form -->
      <form class="mb-5" enctype="multipart/form-data" method="POST" action="{{route("frontend.dashboard.updatesetting")}}">
        @csrf
        <div class="form-group mb-3">
          <label>Username:</label>
          <input  name="user_name"text" class="form-control" value="{{$user->user_name}}" />
          @error('user_name')
          <small class="text-danger">
            {{$message}}
          </small>
        @enderror
        </div>
 
           <div class="form-group mb-3">
          <label>name:</label>
          <input  name="name" text" class="form-control" value="{{$user->name}}" />
          @error('name')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
        <div class="form-group mb-3">
          <label>Email:</label>
          <input name="email" type="email" class="form-control" value="{{$user->email}}" />
          @error('emai')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
        <div class="form-group mb-3">
          <label>Profile Image:</label>
          <input name="image" type="file" class="form-control" />
          @error('image')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
        <div class="form-group mb-3">
          <label>Country:</label>
          <input name="country" type="text" class="form-control" value="{{$user->country}}" placeholder="Enter your country" />
          @error('country')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
        <div class="form-group mb-3">
          <label>City:</label>
          <input  name="city"  type="text" value="{{$user->city}}" class="form-control" placeholder="Enter your city" />
          @error('city')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
        <div class="form-group mb-3">
          <label>Street:</label>
          <input name="street" type="text" value="{{$user->street}}" class="form-control" placeholder="Enter your street" />
          @error('street')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
        <div class="form-group mb-3">
          <label>phone:</label>
          <input name="phone" type="text" value="{{$user->phone}}" class="form-control" placeholder="Enter your street" />
          @error('phone')
          <small class="text-danger"> {{$message}}</small>
        @enderror
        </div>
       
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>

      <!-- Change Password Form -->
      <h2 class="mb-4">Change Password</h2>
      <form action="{{route('frontend.dashboard.changepassword')}}" method="post">
        @csrf
        <div class="form-group mb-3">
          <label>Current Password:</label>
          <input name="current_password" type="password" class="form-control"  placeholder="Enter Current Password" />
          @error('current_password')
            <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div>
        <div class="form-group mb-3">
          <label>New Password:</label>
          <input  name="password"type="password" class="form-control" placeholder="Enter New Password" />
          
          @error('password')
            <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div>
        <div class="form-group mb-3">
          <label>Confirm New Password:</label>
          <input name="password_confirmation" type="password" class="form-control" placeholder="Enter Confirm New Password" />
          @error('password_confirmation')
            <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div>
        <button type="submit" class="btn btn-warning">Change Password</button>
      </form>
    </div>

  </div>
</div>
<!-- Dashboard End-->
@endsection
