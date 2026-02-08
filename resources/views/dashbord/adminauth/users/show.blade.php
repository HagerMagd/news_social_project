@extends('layouts.dashbord.app')

@section('title')
    User Details
@endsection

@section('body')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <div class="card shadow-sm border-0 mt-4">

                    <!-- Header -->
                    <div class="card-header bg-white text-center fw-bold fs-5">
                        User Profile
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">

                        <!-- User Image -->
                        <div class="text-center mb-4">

                            @if ($user->image)
                                <img src="{{ asset($user->image) }}" class="rounded-circle shadow-sm" width="120"
                                    height="120" style="object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}"
                                    class="rounded-circle shadow-sm">
                            @endif

                            <h5 class="mt-3">{{ $user->name }}</h5>

                            <span
                                class="badge 
                            {{ $user->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->status == 1 ? 'Active' : 'Not Active' }}
                            </span>

                        </div>

                        <!-- Info -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>User Name:</strong>
                                <p class="text-muted">{{ $user->user_name }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Email:</strong>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Phone:</strong>
                                <p class="text-muted">{{ $user->phone }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Country:</strong>
                                <p class="text-muted">{{ $user->country }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>City:</strong>
                                <p class="text-muted">{{ $user->city }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Street:</strong>
                                <p class="text-muted">{{ $user->street }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Email Status:</strong>
                                <span
                                    class="badge 
                                {{ $user->email_status == 1 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $user->email_status == 1 ? 'Verified' : 'Not Verified' }}
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Created At:</strong>
                                <p class="text-muted">{{ $user->created_at->format('d M Y') }}</p>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="text-center mt-4">

                            <a href="{{ route('admin.user.status', $user->id) }}" class="btn btn-secondary px-4">
                                @if ($user->status == 1)
                                    Block
                                @else
                                    Active
                                @endif
                            </a>
                            <a href="javascript:void(0)"
                                onclick="if(confirm('Do You Want Delete {{ $user->name }}?'))
                                        {document.getElementById('Delete_user').submit()} return false"
                                class="btn btn-primary px-4">

                                Delete User
                            </a>

                            <form id="Delete_user"
                                action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
