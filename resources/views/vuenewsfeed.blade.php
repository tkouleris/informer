{{--<newsfeed-component></newsfeed-component>--}}
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
<div id="app">
    <NewsfeedComponent></NewsfeedComponent>
</div>
