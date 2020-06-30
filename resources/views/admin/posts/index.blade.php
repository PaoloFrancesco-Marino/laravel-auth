@extends('layouts.admin')

@section('content')
    <div class="container">

        @if (session('post-deleted'))
            <div class="alert alert-success">
                <div>Post Deleted</div>
                {{ session('post-deleted') }}
            </div>
        @endif

        <h1 class="mb-4">Blog Post</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th colspan="3"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                <tr class="mb-5">
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('admin.posts.show', $post->id) }}">Show</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="wrap-pagination mt-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection