@extends('layout.app')
@section('body-content')
       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Posts Table</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Posts</a></li>
                        <li class="breadcrumb-item active">Posts Table</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        @if (session('success'))
                            <div class="alert alert-success">
                               {{ session('success') }}
                            </div>
                        @endif

                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Posts Table</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{route('posts.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> New post</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                  
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Post Image</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$post->title}}</td>
                                <td title="{{ $post->content }}">{{ Str::limit($post->content, 10) }}</td>
                                <td><img src="{{asset('/'.$post->featured_image)}}" alt="" style="width: 20%"></td>
                                <td>{{$post->category->name ?? 'No Category' }}</td>
                                <td>{{$post->user->name ?? 'Null'}}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>{{$post->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Are you sure you want to delete this post?')" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

   
@endsection