<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/qldo7ufx2hm75trpzbk22suj0hn44naz0lzhe9rfm7h4e7lb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/tabulator_bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('menu/primary')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
