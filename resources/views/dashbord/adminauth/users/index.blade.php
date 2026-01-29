@extends('layouts.dashbord.app')
@section('title')
    Users
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
        @include('dashbord.adminauth.users.userfilter.filter')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td> {{ $user->email }}</td>
                                    <td>{{ $user->country }}</td>
                                    <td>{{ $user->status == 0 ? 'Not Active' : 'Active' }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="if(confirm('Do You Want Delete {{$user->name}}?'))
                                        {document.getElementById('Delete_user_{{$user->id}}').submit()} return false">
                                            <li class="fa fa-trash" title="delete {{$user->id}}"></li>
                                        </a>
                                        <a href="{{route('admin.user.status',$user->id)}}">
                                            <li class="fa @if ($user->status==1)  fa-ban @else fa-unlock @endif 
                                                @if ($user->status==1)
                                                     " title="block user {{$user->id}}"
                                                @else
                                                      " title="Unblock user {{$user->id}}"
                                                @endif></li>
                                        </a>
                                        <a href="#">
                                            <li class="fa fa-eye"title="show details "></li>
                                        </a>
                                    </td>
                                </tr>
                                <form id="Delete_user_{{$user->id}}" action="{{ route('admin.users.destroy',$user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6">No users</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->appends(request()->input())->links() }}
                    {{-- To continue displaying filtered data via search --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
