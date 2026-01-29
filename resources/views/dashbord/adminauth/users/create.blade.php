@extends('layouts.dashbord.app')
@section('title')
    Create User
@endsection
@section('body')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <div class="card shadow-sm border-0 mt-4">

                    <!-- Card Header -->
                    <div class="card-header bg-white text-center fw-bold fs-5">
                        Create New User
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">

                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Row 1 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter your name">
                                </div>
                                @error('name')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">User Name</label>
                                    <input type="text" class="form-control" name="user_name"
                                        placeholder="Enter user name">
                                </div>
                            </div>
                             @error('user_name')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                            <!-- Row 2 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                                </div>
                                 @error('email')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Email Status</label>
                                    <select class="form-select" name="email_verified_at">
                                        <option selected disabled>Choose status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>
                                 @error('email_verified_at')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror
                            </div>

                            <!-- Row 3 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">User Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                @error('image')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" placeholder="Enter country">
                                </div>
                                @error('country')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}} </strong>
                                </div>
                                    
                                @enderror
                            </div>

                            <!-- Row 4 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter city">
                                </div>
                                @error('city')
                                <div class="alert alert-warning">
                                    <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Street</label>
                                    <input type="text" class="form-control" name="street" placeholder="Enter street">
                                </div>
                                @error('street')
                                <div class="alert alert-warning">
                                    <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror
                            </div>

                            <!-- Row 5 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">User Status</label>
                                    <select class="form-select" name="status">
                                        <option selected disabled>Choose status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>
                                @error('status')
                                <div class="alert alert-warning">
                                    <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter phone">
                                </div>
                                @error('phone')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror
                            </div>

                            <!-- Row 6 -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter password">
                                </div>
                                @error('password')
                                <div class="alert alert-warning">
                                 <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirm password">
                                </div>
                                @error('password_confirmation')
                                <div class="alert alert-warning">
                                     <strong>  {{$message}}</strong>
                                </div>
                                    
                                @enderror
                            </div>

                            <!-- Button Center -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">
                                    Create User
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
