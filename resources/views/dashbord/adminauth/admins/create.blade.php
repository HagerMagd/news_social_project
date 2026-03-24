@extends('layouts.dashbord.app')

@section('title')
Create Admin
@endsection

@section('body')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0 mt-4">

                <!-- Card Header -->
                <div class="card-header bg-white text-center fw-bold fs-5">
                    Create New Admin
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">

                    <form action="{{ route('admin.admin.store') }}" method="POST">
                        @csrf

                        <!-- Admin Name -->
                        <div class="mb-3">
                            <label class="form-label">Admin Name</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin user Name</label>
                            <input type="text"
                                   class="form-control @error('user_name') is-invalid @enderror"
                                   name="user_name"
                                   value="{{ old('user_name') }}">

                            @error('user_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin Password </label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   value="{{ old('password') }}">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin email</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!-- Admin Status -->
                        <div class="mb-4">
                            <label class="form-label">Admin Status</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    name="status">

                                <option disabled selected>Choose status</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>

                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">
                                Create Admin
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
