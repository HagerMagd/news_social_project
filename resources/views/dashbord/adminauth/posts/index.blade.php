@extends('layouts.dashbord.app')
@section('title')
    Posts Mangement
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
                            <h5 class="mb-0"> Posts Mangement
                            </h5>

                            <a class="btn btn-primary btn-sm" a href="{{ route('admin.post.create') }}">
                                + Add New Posts
                            </a>
                        </div>

                        <!-- Body -->
                        <div class="card-body">

                            <!-- Search & Filter -->
                            @include('dashbord.adminauth.category.categoryfilter.filter')

                            <!-- Table -->
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover align-middle text-center">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>num_of_views</th>
                                            <th>User </th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>num_of_views</th>
                                            <th>User </th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>


                                        @forelse ($posts as $post)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $post->title }}</td>

                                                <td>{{ $post->catgegory->name }}</td>

                                                <!-- Status Badge -->
                                                <td>
                                                    <span
                                                        class="badge {{ $post->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $post->status == 1 ? 'Active' : 'Not Active' }}
                                                    </span>
                                                </td>

                                                <td>{{ $post->num_of_views }}</td>
                                                <td>{{ $post->user->name ?? $post->admin->name }}</td>



                                                <!-- Actions -->
                                                <td class="text-center">

                                                    <!-- Delete -->
                                                    <a href="javascript:void(0)"
                                                        onclick="if(confirm('Do You Want Delete {{ $post->title }} post ?')){document.getElementById('Delete_post_{{ $post->id }}').submit()} return false"
                                                        class="text-danger me-2" title="Delete Post">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Status Toggle -->
                                                    <a href="{{ route('admin.post.status', $post->id) }}"
                                                        class="text-warning me-2"
                                                        title="{{ $post->status == 1 ? 'Deactivate' : 'Activate' }}">
                                                        <i
                                                            class="fa {{ $post->status == 1 ? 'fa-ban' : 'fa-unlock' }}"></i>
                                                    </a>
                                                    <a href="{{ route('admin.post.show', $post->id) }}">
                                                        <li class="fa fa-eye"title="show details "></li>
                                                    </a>

                                                    <!-- Edit posts for admin only -->
                                                    @if ($post->user_id == null)
                                                        <a href="{{ route('admin.post.edit', $post->id) }}"
                                                            class="text-info me-2" title="Edit Post ">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif


                                                </td>



                                            </tr>

                                            <form id="Delete_post_{{ $post->id }}"
                                                action="{{ route('admin.post.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>



                                        @empty
                                            <tr>
                                                <td class="alert alert-info" colspan="6">No posts</td>
                                            </tr>
                                        @endforelse



                                    </tbody>

                                </table>
                                {{ $posts->appends(request()->input())->links() }}

                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </div>
    @endsection
