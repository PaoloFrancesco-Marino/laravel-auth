@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">New Post</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" id="" cols="30" rows="10">{{ old('body') }}</textarea>
            </div>

            <div class="form-group">
                <label for="path_img">Upload Image</label>
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">
            </div>

            <input class="btn btn-primary" type="submit" value="Create Post">

        </form>
    </div>
@endsection