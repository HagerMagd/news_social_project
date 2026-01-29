@extends('layouts.dashbord.auth.app')
@section('title')
    reset your password
@endsection
@section('body')
     <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">reset new password</h1>
                                    </div>
                                    <form class="user" action="{{route('admin.password.reset')}}" method="post">
                                        @csrf
                               
                                        
                                        @error('erorr')
                                            <div class="text-danger">
                                               {{$message}} 
                                            </div>
                                        @enderror
                                         <div class="form-group">
                                            <input  hidden  type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                               value="{{$email}}" name="email">
                                                @error('email')
                                                   <div class="text-danger">
                                                     {{$message}}
                                                   </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter new password..." name="password">
                                                @error('password')
                                                   <div class="text-danger">
                                                     {{$message}}
                                                   </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="confirm new password..." name="password_confirmation">
                                                @error('password-confirm')
                                                   <div class="text-danger">
                                                     {{$message}}
                                                   </div>
                                                @enderror
                                        </div>
                                       
                                        <button type="submit" href="index.html" class="btn btn-primary btn-user btn-block">
                                           reset
                                        </button>
                                        <hr>
                                       
                                    </form>
                                    <hr>
                                  
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

@endsection