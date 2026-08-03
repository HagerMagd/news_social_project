@extends('layouts.dashbord.app')

@section('title')
    update Role
@endsection

@section('body')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm border-0 mt-4">

                    <!-- Card Header -->
                    <div class="card-header bg-white text-center fw-bold fs-5">
                        update New Role
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">

                        <form action="{{ route('admin.authorization.update',$role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Admin Name -->
                            <div class="mb-3">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control @error('role') is-invalid @enderror"
                                    name="role" value="{{$role->role }}">

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    @foreach (config('authorizations.permession') as $key=>$value )
                                        <input class="form-check-input" type="checkbox" id="permession_{{$key}}" @error('permession') is-invalid @enderror value="{{$key}}" name="permession[]" @checked(in_array($key,$role->permession))>
                                    <label class="form-check-label" for="inlineCheckbox1">{{$value}}</label>
                                    @endforeach
                                </div>

                                @error('permession')
                                    <div class="text-danger d-block"">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>





                            <!-- Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">
                                    update New Role 
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
