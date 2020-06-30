@component('mail::message')
# New Post published

read te new post:

{{ $title }}

@component('mail::button', ['url' => config('app.url') . '/posts' ])
View blog archive
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent



{{-- <h1>New Post published</h1>

<p>Read the new post</p>

<p><strong>Title:</strong>{{ $title }}</p>
<p><strong>Slug:</strong>{{ $slug }}</p>
<p><strong>Post:</strong>{{ $body }}</p> --}}


