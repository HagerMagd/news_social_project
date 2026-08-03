@extends('layouts.dashbord.app')
@section('title')
    Roles Mangement
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <div class="container mt-4">

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-sm border-0">

                        <!-- Header -->
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Roles</h5>

                            <a class="btn btn-primary btn-sm" a href="{{ route('admin.authorization.create') }}">
                                + Add New Rols
                            </a>
                        </div>

                        <!-- Body -->
                        <div class="card-body">

                            <!-- Search & Filter -->
                            @include('dashbord.adminauth.system_role.filter.filter')

                            <!-- Table -->
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover align-middle text-center">

                                    <thead class="table-light">
                                        <tr>

                                            <th>#</th>
                                            <th>role</th>
                                            <th>permession</th>
                                             <th>ralated admins</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>role</th>
                                            <th>permession</th>
                                             <th>ralated admins</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>


                                        @forelse ($roles as $role)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $role->role }}</td>
                                                <td>
                                                    @foreach ($role->permession as $permession)
                                                        {{ $permession }} , 
                                                    @endforeach
                                                </td>

                                                 <td>{{ $role->admins->count()}}</td>

                                                <td>{{ $role->created_at->format('d M Y - h:m') }}</td>

                                                <!-- Actions -->
                                                <td class="text-center">

                                                    <!-- Delete -->
                                                    <a href="javascript:void(0)"
                                                        onclick="if(confirm('Do You Want Delete {{ $role->role }} Role ?'))
       {document.getElementById('Delete_role_{{ $role->id }}').submit()} return false"
                                                        class="text-danger me-2">

                                                        <i class="fa fa-trash" title="Delete role"></i>
                                                    </a>
                                                    <!-- Edit -->

                                                    <a href="{{ route('admin.authorization.edit', $role->id) }}"
                                                        class="text-primary" 

                                                        title="{{ $role->role }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <form id="Delete_role_{{ $role->id }}"
                                                action="{{ route('admin.authorization.destroy', $role->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                         

                                        @empty
                                            <tr>
                                                <td class="alert alert-info" colspan="6">No roles</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                {{ $roles->appends(request()->input())->links() }}

                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </div>
    @endsection
