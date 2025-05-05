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
                <h4 class="card-title text-center">Add Category Info</h4>

                <form method="POST" action="{{route('categories.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="name">Category Name</label>
                                <input id="name" name="name" type="text" placeholder="Category Name" value="{{old('name')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Category</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<!-- end row -->
@endsection