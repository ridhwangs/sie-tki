<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            @yield('style');
        </style>
    </head>
    <body>  
      

    <section class="section">
        <div class="container has-text-centered">
            <h2 class="title">Pilih tema</h2>
            <div class="columns is-centered" style="padding: 2rem">
                <div class="column" onclick="themes('bulma')">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-2by1">
                                <img src="{{ url('banner/bulma-banner.png') }}" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4">Bulma</p>
                                    <p class="subtitle is-6">https://bulma.io/</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column" onclick="themes('foundation')">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-2by1">
                                <img src="{{ url('banner/foundation.jpg') }}" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4">Foundation</p>
                                    <p class="subtitle is-6">https://get.foundation/</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column" onclick="themes('bootsrap')">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-2by1">
                                <img src="{{ url('banner/bootstrap_1200_630.jpg') }}" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4">Bootsrap</p>
                                    <p class="subtitle is-6">https://getbootstrap.com/</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">
                    <a href="https://bulma.io">
                        <img src="//bulma.io/images/made-with-bulma.png" alt="Made with Bulma" width="128" height="24">
                    </a>
                </p>
            </div>
        </div>
    </footer>
        
    <script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function themes(themes) {
            location.replace("{{ route('main', '') }}/" + themes);
        }
    </script>
    </body>
</html>
