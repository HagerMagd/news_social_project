@extends('layouts.dashbord.app')

@section('title')
    Edit Post
@endsection

@section('body')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-sm border-0">

                    <!-- Header -->
                    <div class="card-header bg-white text-center fw-bold fs-5">
                        Edit New Post
                    </div>

                    @if (session()->has('errors'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach (session('errors')->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    <!-- Body -->
                    <div class="card-body p-4">

                        <form action="{{ route('admin.post.update', $post->id) }}" method="Post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Row 1 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Post Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter post title"
                                        value="{{ @old('title', $post->title) }}">
                                </div>
                                @error('title')
                                    <div class="alert alert-warning">
                                        <strong> {{ $message }}</strong>
                                    </div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Post Type</label>
                                    <select class="form-select" name="category_id">


                                        <option selected disabled>Choose Type</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('category_id')
                                <div class="alert alert-warning">
                                    <strong> {{ $message }}</strong>
                                </div>
                            @enderror




                            <!-- Image -->
                            <div class="mb-3">
                                <label class="form-label">Post Image</label>
                                <input type="file" class="form-control" name="images[]" id="post_images" accept="image/*"
                                    multiple>
                            </div>
                            @error('images')
                                <div class="alert alert-warning">
                                    <strong> {{ $message }}</strong>
                                </div>
                            @enderror

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Post Description</label>
                                <textarea class="form-control" name="desc" rows="5" placeholder="Write post content here..." id="postContent">{!! @old('desc', $post->desc) !!} </textarea>
                            </div>
                            @error('desc')
                                <div class="alert alert-warning">
                                    <strong> {{ $message }}</strong>
                                </div>
                            @enderror

                            <!-- Row 2 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Post Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1"@selected($post->status == 1)>Active</option>
                                        <option value="0" @selected($post->status == 0)>Not Active</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="alert alert-warning">
                                        <strong> {{ $message }}</strong>
                                    </div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Comments</label>
                                    <select class="form-select" name="comment_able">
                                        <option value="1"@selected($post->comment_able == 1)>Enabled</option>
                                        <option value="0" @selected($post->comment_able == 0)>Disabled</option>
                                    </select>
                                </div>
                            </div>
                            @error('comment_able')
                                <div class="alert alert-warning">
                                    <strong> {{ $message }}</strong>
                                </div>
                            @enderror

                            <!-- Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">
                                    Update Post
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>



    @push('js')
        <script>
            $(function() {
                //file

                $('#post_images').fileinput({
                    theme: 'fa5',
                    allowedFileTypes: ['image'],
                    showUpload: false,
                    enableResumebleUpload: false,
                    maxFileCount: 5,
                    shwoCancel: false,
                    initialPreviewAsData: true,
                    initialPreview: [
                        @if ($post->images->count() > 0)
                            @foreach ($post->images as $image)
                                "{{ asset($image->path) }}",
                            @endforeach
                        @endif

                    ],
                    initialPreviewConfig: [
                        @if ($post->images->count() > 0)
                            @foreach ($post->images as $image)
                                {
                                    caption: "{{ $post->path }}",
                                    width: '120px',
                                    url: "{{ route('admin.post.delete.image', [$image->id, '_token' => csrf_token()]) }}", // server delete action 
                                    key: "{{ $image->id }}",

                                },
                            @endforeach
                        @endif
                    ],

                });
                //for bodycontent
                $('#postContent').summernote({
                    placeholder: 'Enter Your Post',
                    tabsize: 2,
                    height: 300,
                });
            });
        </script>
    @endpush
@endsection
