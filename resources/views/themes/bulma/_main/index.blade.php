@extends($themes)
@section('title', 'Selamat Datang')    
@section('style')
html {
  scroll-behavior: smooth;
}
.hero-video{
    display: block !important;
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
@stop