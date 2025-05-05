@extends('layout.app')
@section('body-content')
    
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="card-title text-center">Add Post Info</h4>

                <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input id="title" name="title" type="text" placeholder="Enter Title" value="{{old('title')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="content">Post Content</label>
                                <textarea name="content" id="content" cols="30" placeholder="Enter Content" class="form-control" rows="10">{{old('content')}}</textarea>
                                {{-- <input id="content" name="content" type="text"  value="{{old('content')}}" > --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="" disabled selected>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <img id="newImg" src="https://archive.org/download/placeholder-image/placeholder-image.jpg" style="width: 20%" alt="">
                            <div class="mb-3">
                                <label for="featured_image">Featured Image</label>
                                <input id="featured_image" oninput="newImg.src=window.URL.createObjectURL(this.files[0])" name="featured_image" class="form-control" type="file" value="{{old('featured_image')}}" >
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Post</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<!-- end row -->
@endsection