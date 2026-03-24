@extends('layouts.dashbord.app')
@section('title')
    Admin Settings
@endsection
@push('style')
    <style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>body {
            background: #f8f9fc;
        }

        .settings-card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .logo-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .fa-brands {
            transition: 0.3s ease;
        }

        .fa-brands:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }

        .input-group-text {
            width: 45px;
            justify-content: center;
            border-radius: 8px 0 0 8px;
        }

        .form-control {
            border-radius: 0 8px 8px 0;
        }
    </style>
@endpush

@section('body')
    <div class="container py-5">

        <div class="row g-4">

            <!-- ================= LEFT SIDE (Display Settings) ================= -->
            <div class="col-lg-6">
                <div class="card settings-card p-4">

                    <h4 class="mb-4">
                        <i class="fa fa-gear me-2"></i> Current Settings
                    </h4>

                    <div class="text-center mb-4">
                        <img src="{{asset($getsetting->logo)}}"
                            class="logo-preview mb-3">

                        <h5>{{ $getsetting->site_name }}</h5>
                        <p class="text-muted">{{ $getsetting->samll_desc }}</p>
                    </div>

                    <hr>

                    <!-- Social Media -->
                    <h6 class="mb-3">Follow Us</h6>

                    <div class="d-flex gap-3 fs-4 mb-4">
                        <a href="{{ $getsetting->facebook }}" target="_blank" class="text-primary">
                            <i class="fa-brands fa-facebook"></i>
                        </a>

                        <a href="{{ $getsetting->instagram }}" target="_blank" class="text-danger">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="{{ $getsetting->twitter }}" target="_blank" class="text-info">
                            <i class="fa-brands fa-twitter"></i>
                        </a>

                        <a href="{{ $getsetting->youtube }}" target="_blank" class="text-danger">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>

                    <ul class="list-unstyled">

                        <li class="mb-3">
                            <i class="fa fa-envelope text-primary me-2"></i>
                            {{ $getsetting->site_email }}
                        </li>

                        <li class="mb-3">
                            <i class="fa fa-phone text-success me-2"></i>
                            {{ $getsetting->phone }}
                        </li>

                        <li class="mb-3">
                            <i class="fa-solid fa-location-dot me-2 text-danger"></i>
                            {{ $getsetting->city }}, {{ $getsetting->country }}, {{ $getsetting->street }}
                        </li>

                        <li class="mb-3">
                            <i
                                class="{{ $getsetting->status == 1 ? 'fa fa-toggle-on text-success' : 'fa fa-toggle-off text-danger' }}"></i>
                            Website Status: {{ $getsetting->status == 1 ? 'Active' : 'Not Active' }}
                        </li>

                    </ul>

                </div>

                 <div class="text-center mb-4">
                        <img src="{{asset($getsetting->favicon)}}"
                            class="logo-preview mb-3">

                    </div>

            </div>

            <!-- ================= RIGHT SIDE (Edit Form) ================= -->
            <div class="col-lg-6">
                <div class="card settings-card p-4">

                    <h4 class="mb-4">
                        <i class="fa fa-pen-to-square me-2"></i> Update Settings
                    </h4>
                    @if (session()->has('errors'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach (session('errors')->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Info -->
                        <div class="mb-3">
                            <label class="form-label">Website Name</label>
                            <input type="text" class="form-control" name="site_name"
                                value="{{ $getsetting->site_name }}">
                        </div>
                        @error('site_name')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Website Description</label>
                            <textarea class="form-control" rows="3" name="samll_desc">{{ $getsetting->samll_desc }}</textarea>
                        </div>
                        @error('samll_desc')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror

                        <!-- Contact -->
                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="site_email"
                                value="{{ $getsetting->site_email }}">
                        </div>
                        @error('site_email')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $getsetting->phone }}">
                        </div>
                        @error('phone')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror
                        <!-- Location -->
                        <hr>
                        <h6 class="mb-3">Location</h6>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="text" class="form-control" name="city" placeholder="City"
                                    value="{{ $getsetting->city }}">
                            </div>
                            @error('city')
                                <div class="alert alert-warning">
                                    <strong> {{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="col-md-4 mb-3">
                                <input type="text" class="form-control" name="country" placeholder="Country"
                                    value="{{ $getsetting->country }}">
                            </div>
                            @error('country')
                                <div class="alert alert-warning">
                                    <strong> {{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="col-md-4 mb-3">
                                <input type="text" class="form-control" name="street" placeholder="Street"
                                    value="{{ $getsetting->street }}">
                            </div>
                        </div>
                        @error('street')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror
                        <input type="text" value="{{$getsetting->id}}" hidden name="setting_id">

                        <!-- Logo & Favicon -->
                        <div class="mb-3">
                            <label class="form-label">Website Logo</label>
                            <input type="file" class="form-control dropify" name="logo">
                        </div>
                        @error('logo')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Website Favicon</label>
                            <input type="file" class="form-control dropify" name="favicon">
                        </div>
                        @error('favicon')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label">Website Status</label>
                            <select class="form-select" name="status">
                                <option value="1" @selected($getsetting->status == 1)>Active</option>
                                <option value="0" @selected($getsetting->status == 0)>Not Active</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="alert alert-warning">
                                <strong> {{ $message }}</strong>
                            </div>
                        @enderror

                        <!-- Social Media -->
                        <hr>
                        <h6 class="mb-3">Social Media Links</h6>

                        <div class="row">

                            <!-- Facebook -->
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </span>
                                    <input type="url" class="form-control" name="facebook"
                                        placeholder="Facebook URL" value="{{ $getsetting->facebook }}">
                                </div>
                                @error('facebook')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instagram -->
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-danger text-white">
                                        <i class="fab fa-instagram"></i>
                                    </span>
                                    <input type="url" class="form-control" name="instagram"
                                        placeholder="Instagram URL" value="{{ $getsetting->instagram }}">
                                </div>
                                @error('instagram')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Twitter -->
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-info text-white">
                                        <i class="fab fa-twitter"></i>
                                    </span>
                                    <input type="url" class="form-control" name="twitter" placeholder="Twitter URL"
                                        value="{{ $getsetting->twitter }}">
                                </div>
                                @error('twitter')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- YouTube -->
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-danger text-white">
                                        <i class="fab fa-youtube"></i>
                                    </span>
                                    <input type="url" class="form-control" name="youtube" placeholder="YouTube URL"
                                        value="{{ $getsetting->youtube }}">
                                </div>
                                @error('youtube')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-save me-2"></i> Save Changes
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'drop a file here ',
                'replace': 'drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
