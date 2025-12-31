@extends('layouts.frontend.app')
@section('title')

Contact
@endsection
@section('body')
    <!-- Breadcrumb Start -->
    @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Contact</li>
@endsection
    <!-- Contact Start -->
    <div class="row align-items-center">
    <!-- Col 1: Form -->
    <div class="col-md-8">
        <div class="contact-form">
            <form action="{{ route('frontend.contact.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" />
                        <strong class="text-danger">
                            @error('name') {{ $message }} @enderror
                        </strong>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" />
                        <strong class="text-danger">
                            @error('email') {{ $message }} @enderror
                        </strong>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" name="phone" class="form-control" placeholder="Your Phone" />
                        <strong class="text-danger">
                            @error('phone') {{ $message }} @enderror
                        </strong>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Subject" />
                    <strong class="text-danger">
                        @error('title') {{ $message }} @enderror
                    </strong>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="body" rows="5" placeholder="Message"></textarea>
                    <strong class="text-danger">
                        @error('body') {{ $message }} @enderror
                    </strong>
                </div>
                <div>
                    <button class="btn" type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Col 2: Contact Info -->
    <div class="col-md-4">
        <div class="contact-info">
            <h3>Get in Touch</h3>
            <p class="mb-4">
                The contact form is currently inactive. Get a functional and
                working contact form with Ajax & PHP in a few minutes. Just copy
                and paste the files, add a little code and you're done.
            </p>
            <h4><i class="fa fa-map-marker"></i>{{$getsetting->street}}, {{$getsetting->city}}, {{$getsetting->country}}</h4>
            <h4><i class="fa fa-envelope"></i>{{$getsetting->site_email}}</h4>
            <h4><i class="fa fa-phone"></i>{{$getsetting->phone}}</h4>
            <div class="social">
                <a href="{{$getsetting->twitter}}"><i class="fab fa-twitter" title="twitter"></i></a>
                <a href="{{$getsetting->facebook}}"><i class="fab fa-facebook-f" title="facebook"></i></a>
                <a href="{{$getsetting->instagram}}"><i class="fab fa-instagram"  title="instagram"></i></a>
                <a href="{{$getsetting->youtube}}"><i class="fab fa-youtube"  title="youtube"></i></a>
            </div>
        </div>
    </div>
</div>

   
    <!-- Contact End -->
@endsection
