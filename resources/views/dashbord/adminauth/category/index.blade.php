@extends('layouts.dashbord.app')
@section('title')
    categories Mangement
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
                            <h5 class="mb-0">Post Categories</h5>

                            <a class="btn btn-primary btn-sm" a href="{{ route('admin.category.create') }}">
                                + Add New Category
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
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Post Count</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Post Count</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>


                                        @forelse ($categories as $category)
                                            <tr>

                                                <td>{{ $category->id }}</td>

                                                <td>{{ $category->name }}</td>

                                                <td>{{ $category->slug }}</td>

                                                <!-- Status Badge -->
                                                <td>
                                                    <span
                                                        class="badge {{ $category->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $category->status == 1 ? 'Active' : 'Not Active' }}
                                                    </span>
                                                </td>

                                                <td>{{ $category->posts_count }}</td>

                                                <td>{{ $category->created_at->format('d M Y') }}</td>

                                                <!-- Actions -->
                                                <td class="text-center">

                                                    <!-- Delete -->
                                                    <a href="javascript:void(0)"
                                                        onclick="if(confirm('Do You Want Delete {{ $category->name }}?'))
       {document.getElementById('Delete_category_{{ $category->id }}').submit()} return false"
                                                        class="text-danger me-2">

                                                        <i class="fa fa-trash" title="Delete Category"></i>
                                                    </a>

                                                    <!-- Status Toggle -->
                                                    <a href="{{ route('admin.Categories.Status', $category->id) }}"
                                                        class="text-warning me-2">

                                                        <i class="fa 
            {{ $category->status == 1 ? 'fa-ban' : 'fa-unlock' }}"
                                                            title="{{ $category->status == 1 ? 'Deactivate' : 'Activate' }}">
                                                        </i>
                                                    </a>

                                                    <!-- Edit -->

                                                    <a href="#" class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#category-edit-{{ $category->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>





                                                </td>


                                            </tr>

                                            <form id="Delete_category_{{ $category->id }}"
                                                action="{{ route('admin.category.destroy', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @include('dashbord.adminauth.category.edit')

                        @empty
                            <tr>
                                <td class="alert alert-info" colspan="6">No Categories</td>
                            </tr>
                            @endforelse



                            </tbody>

                            </table>
                            {{ $categories->appends(request()->input())->links() }}

                        </div>


                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
