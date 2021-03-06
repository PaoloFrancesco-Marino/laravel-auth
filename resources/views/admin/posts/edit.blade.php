@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Post</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" type="text" name="title" value="{{ old('title', $post->title) }}">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" id="" cols="30" rows="10">{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="form-group">
                <label class="d-block" for="path_img">Upload Image</label>
                @isset($post->path_img)
                    <img width="400" src="{{ asset('storage/' . $post->path_img) }}" alt="{{ $post->title }}">

                    <h6 class="mt-2">Change Image:</h6>
                @endisset
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">
            </div>

            <input class="btn btn-primary" type="submit" value="Updated Post">

        </form>
    </div>
@endsection