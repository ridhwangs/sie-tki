@extends($themes)
@section('title', 'Selamat Datang')    
@section('style')
html {
  scroll-behavior: smooth;
}
@stop
@section('content')
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ route('landing') }}">
      <img src="{{ url('assets/logo.png') }}" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="#cluster">
          Cluster
      </a>
      <a class="navbar-item" href="#fasilitas">
          Gallery
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-light" href="{{ route('login') }}">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>   

<section class="hero is-fullheight video">
    <div class="hero-video">
        <video poster="{{ url('assets/cluster/details/siteplan.png') }}" playsinline="" autoplay="" muted="" loop="">
            <source src="{{ url('assets/video/new_gardenville.MP4') }}" type="video/webm">
        </video>
    </div>
    <div class="hero-body">
        <div class="container">
            
        </div>
    </div>
    <div class="hero-foot">
        <div class="has-text-centered">
            
        </div>
    </div>
</section>
<section class="section" id="cluster">
  <div class="container">
    <div class="columns is-multiline">
      @foreach($main as $rows)
        <div id="col1" class="column is-3-desktop is-half-tablet">
          <div class="card">

            <header class="card-header">
              <p class="card-header-title">
              {{ $rows->name; }}
              </p>
            </header>
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="{{ url('assets/cluster/thumbnail/'.$rows->img_src) }}" alt="Placeholder image">
              </figure>
            </div>
            <footer class="card-footer">
              <a href="{{ route('main.view', ['themes' => $themes , 'name' => Str::lower($rows->name)]); }}" class="card-footer-item">View</a>
              <!-- jika login -->
              <!-- <a href="#" class="card-footer-item">Edit</a> -->
            </footer>
          </div>
        </div>
        @endforeach
    </div>
  </div>
</section>
<section class="section" id="fasilitas">
        <div class="container has-text-centered">
            <img src="{{ url('assets/logo.png') }}" width="312">
            <h2 class="title">Gallery</h2>
           
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/bloomingville/tampak.png') }}">
                        </figure>
                        <p class="title">Bloomingville</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/gardenville/view-2.png') }}">
                        </figure>
                        <p class="title">Gardenville</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/gardenville/view-3.png') }}">
                        </figure>
                        <p class="title">Gardenville</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/pinewood/soho_pinewood.jpg') }}">
                        </figure>
                        <p class="title">Pinewood</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/redwood/mapple.jpg') }}">
                        </figure>
                        <p class="title">Redwood</p>
                    </article>
                </div>
            </div>

            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/sherwood/CLOVER.jpg') }}">
                        </figure>
                        <p class="title">Sherwood</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/sherwood/ROSEMARY.jpg') }}">
                        </figure>
                        <p class="title">Sherwood</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/sherwood/ROSEWOOD.jpg') }}">
                        </figure>
                        <p class="title">Sherwood</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/sommerville/AMBROSIA.jpg') }}">
                        </figure>
                        <p class="title">Sommerville</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/sommerville/OAKWOOD.jpg') }}">
                        </figure>
                        <p class="title">Sommerville</p>
                    </article>
                </div>
            </div>
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/springville/ACACIA.jpg') }}">
                        </figure>
                        <p class="title">Springville</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/springville/EBONY_1.jpg') }}">
                        </figure>
                        <p class="title">Springville</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <figure class="image">
                            <img src="{{ url('assets/cluster/details/springville/OLIVE.jpg') }}">
                        </figure>
                        <p class="title">Springville</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
@stop