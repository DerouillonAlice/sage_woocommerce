<!doctype html>
<html @php(language_attributes())>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body @php(body_class())>
    @php(wp_body_open())


    <div id="app">
        <a class="sr-only focus:not-sr-only" href="#main">
            {{ __('Skip to content', 'sage') }}
        </a>

        @include('sections.header')

        <main id="main" class="main">
            @yield('content')
        </main>

        @include('sections.footer')
    </div>

</body>
</html>
