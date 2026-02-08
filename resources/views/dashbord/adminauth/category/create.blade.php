@extends('layouts.dashbord.app')

@section('title')
Create Category
@endsection

@section('body')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0 mt-4">

                <!-- Card Header -->
                <div class="card-header bg-white text-center fw-bold fs-5">
                    Create New Category
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">

                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf

                        <!-- Category Name -->
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
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

                        <!-- Category Status -->
                        <div class="mb-4">
                            <label class="form-label">Category Status</label>
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
                                Create Category
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
