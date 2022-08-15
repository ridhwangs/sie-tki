<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link rel="stylesheet" href="{{ url('css/foundation.css') }}" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            @yield('style');
        </style>
    </head>
    <body>  
       
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="large-12 cell">
                <h1>Welcome to Foundation</h1>
                </div>
            </div>
            @yield('content')
        </div>
        <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="{{ url('js/vendor/jquery.js') }}"></script>
        <script src="{{ url('js/vendor/what-input.js') }}"></script>
        <script src="{{ url('js/vendor/foundation.min.js') }}"></script>
        <script>
            $(document).foundation();
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @yield('script')
    </body>
</html>
