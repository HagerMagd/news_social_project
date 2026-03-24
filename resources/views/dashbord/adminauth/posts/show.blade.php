@extends('layouts.dashbord.app')
@section('title')
    Show {{ $post->title }} Post
@endsection
@section('body')

    <body class="bg-light">

        <div class="container py-5">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- Image Slider -->
                <div id="postImagesSlider" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#postImagesSlider" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#postImagesSlider" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#postImagesSlider" data-bs-slide-to="2"></button>
                    </div>

                    <!-- Images -->
                    <div class="carousel-inner">
                        @if ($post->images->isNotEmpty())
                            @foreach ($post->images as $image)
                                <div class="carousel-item  @if ($loop->index == 0) active @endif ">
                                    <img src="{{ asset($image->path) }}" class="d-block w-100"
                                        style="height:400px; object-fit:cover;">
                                </div>
                            @endforeach
                        @else
                            <div class="border p-5 text-muted">
                                No Image Available
                            </div>
                        @endif




                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#postImagesSlider"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#postImagesSlider"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>

                <!-- Post Content -->
                <div class="card-body p-4">

                    <h3 class="fw-bold mb-3">Post Title : {{ $post->title }} </h3>
                    <h5 class="fw-bold mb-3">
                        <li class="fa fa-user"> </li> {{ $post->user->name ?? $post->admin->name }}
                    </h5>
                    <h4 class="fw-bold mb-3"> Category : {{ $post->catgegory->name }}</h4>
                    <h6 class="fw-bold mb-3">
                        <li class="fa fa-edit"> </li> {{ $post->created_at->format('Y-m-d h:m') }}
                    </h6>
                    </h6>

                    <p class="text-muted mb-2"> Post status :
                        <span class="badge {{ $post->status == 1 ? 'bg-success' : 'bg-warning' }}">

                            {{ $post->status == 1 ? 'Active' : 'Not Active' }}
                        </span>

                    </p>
                    <p class="text-muted mb-2"> Post Comment Status :
                        <span class="badge {{ $post->comment_able == 1 ? 'bg-success' : 'bg-warning' }}">

                            {{ $post->comment_able == 1 ? 'Active' : 'Not Active' }}
                        </span>
                        <span class="ms-3">
                            <li class="fa fa-eye"> </li> {{ $post->num_of_views }}
                        </span>

                    </p>

                    <hr>

                    <div class="mt-3">
                        <p>
                            {!! $post->desc !!}
                        </p>
                    </div>

                </div>

                <!-- Edit Button -->
                @if ($post->user_id == null)
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a type="button" class="btn btn-danger" href="{{ route('admin.post.edit', $post->id) }}"> <i
                                class="fa fa-edit"> Edit</i></a>
                        <a type="button" class="btn btn-warning" href="javascript:void(0)"
                            onclick="if(confirm('Do You Want Delete {{ $post->title }} post ?')){document.getElementById('Delete_post').submit()} return false"
                            class="text-danger me-2" title="Delete Post">
                            <i class="fa fa-trash"> Delete </i>
                        </a>
                        <a type="button" class="btn btn-fa fa-trash" href="{{ route('admin.post.status', $post->id) }}">  

                            <i class="fa {{ $post->status == 1 ? 'fa-ban' : 'fa-unlock' }}">{{$post->status==1 ? 'Block' : 'Active '}} </i>

                        </a>
                    </div>
                @endif

            </div>

        </div>
        <form id="Delete_post" action="{{ route('admin.post.destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
        </form>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
@endsection
