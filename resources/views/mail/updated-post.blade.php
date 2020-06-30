@component('mail::message')
# New Post Updated

{{ $title }}

@component('mail::button', ['url' => config('app.url') . '/posts' ])
View blog archive
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent