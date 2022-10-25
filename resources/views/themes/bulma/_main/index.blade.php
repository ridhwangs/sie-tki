@extends($themes)
@section('title', 'Selamat Datang')    
@section('style')
html {
  scroll-behavior: smooth;
}
  body {
        font-family: 'Nunito', sans-serif;
        background-color:black;
        height:100vh;
        margin: 0;
        padding: 0;
    }
    
    ul {
        list-style-type: none;
        margin: 0;
        padding: 8px 0px 8px 0px;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover:not(.active) {
        background-color: #111;
    }
@stop
@section('content')
   <nav>
        <ul>
            <li><a href="https://tamankopoindah.co.id" class="button is-dark"><i class="fa-solid fa-angle-left"></i></a></li>
        </ul>
    </nav>
<section class="section" id="cluster">
  <div class="container">
    <div class="columns is-multiline">
      @foreach($main as $rows)
        <div id="col1" class="column is-3-desktop is-half-tablet" style="cursor: pointer;" onclick="gotoUrl('{{ route('main.view', ['themes' => $themes , 'name' => Str::lower($rows->name)]); }}')">
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
@section('script')
<script>
    function gotoUrl(url) {
      location.replace(url);
    }
</script>
@stop