@extends('layouts.dashbord.app')
@section('title')
    Admins Mangement
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->

        <div class="container mt-4">

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-sm border-0">

                        <!-- Header -->
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">ADMINS</h5>

                            <a class="btn btn-primary btn-sm" a href="{{ route('admin.admin.create') }}">
                                + Add New Admin
                            </a>
                        </div>

                        <!-- Body -->
                        <div class="card-body">

                            <!-- Search & Filter -->
                            @include('dashbord.adminauth.admins.filter.filter')

                            <!-- Table -->
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover align-middle text-center">

                                    <thead class="table-light">
                                        <tr>

                                            <th>#</th>
                                            <th>Name</th>
                                            <th>username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Permations</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Permations</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>


                                        @forelse ($admins as $admin)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $admin->name }}</td>

                                                <td>{{ $admin->user_name }}</td>
                                                <td>{{ $admin->email }}</td>

                                                <!-- Status Badge -->
                                                <td>
                                                    <span
                                                        class="badge {{ $admin->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $admin->status == 1 ? 'Active' : 'Not Active' }}
                                                    </span>
                                                </td>
                                                <td>{{$admin->authorizations->role ?? 'No Role'}}</td>

                                                <td>{{ $admin->created_at->format('d M Y - h:m') }}</td>

                                                <!-- Actions -->
                                                <td class="text-center">

                                                    <!-- Delete -->
                                                    <a href="javascript:void(0)"
                                                        onclick="if(confirm('Do You Want Delete {{ $admin->name }}?'))
       {document.getElementById('Delete_admin_{{ $admin->id }}').submit()} return false"
                                                        class="text-danger me-2">

                                                        <i class="fa fa-trash" title="Delete admin"></i>
                                                    </a>

                                                    <!-- Status Toggle -->
                                                    <a href="{{ route('admin.status', $admin->id) }}"
                                                        class="text-warning me-2">

                                                        <i class="fa 
            {{ $admin->status == 1 ? 'fa-ban' : 'fa-unlock' }}"
                                                            title="{{ $admin->status == 1 ? 'Deactivate' : 'Activate' }}">
                                                        </i>
                                                    </a>

                                                    <!-- Edit -->

                                                    <a href="{{route('admin.admin.edit',$admin->id)}}" class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#admin-edit-{{ $admin->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>





                                                </td>


                                            </tr>

                                            <form id="Delete_admin_{{ $admin->id }}"
                                                action="{{ route('admin.admin.destroy', $admin->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @include('dashbord.adminauth.admins.edit')

                                        @empty
                                            <tr>
                                                <td class="alert alert-info" colspan="6">No admins</td>
                                            </tr>
                                        @endforelse



                                    </tbody>

                                </table>
                                {{ $admins->appends(request()->input())->links() }}

                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </div>
    @endsection
