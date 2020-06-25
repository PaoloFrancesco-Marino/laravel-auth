@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Blog Post</h1>

        @foreach ($posts as $post)
            <article class="mb-5">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->body }}</p>
            </article>
        @endforeach

        <div class="wrap-pagination mt-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection