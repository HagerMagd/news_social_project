@extends('layouts.dashbord.auth.app')
@section('title')
    Confirm code
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
                                        <h1 class="h4 text-gray-900 mb-4">    Confirm code
</h1>
                                    </div>
                                    <form class="user" action="{{route('admin.password.vreifyotp')}}" method="post">
                                        @csrf
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
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter your code" name="confirmcode">
                                                @error('token')
                                                   <div class="text-danger">
                                                     {{$message}}
                                                   </div>
                                                @enderror
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                           send
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