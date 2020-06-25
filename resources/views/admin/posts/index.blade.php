@extends('layouts.admin')

@section('content')
    <div class="container">
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
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <a class="btn btn-success" href="">Show</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="">Delete</a>
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