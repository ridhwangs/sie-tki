@extends($themes)
@section('title', 'Selamat Datang')    
@section('content')
    
    <!-- Start Top Bar -->
    <div class="title-bar" data-responsive-toggle="mainNavigation" data-hide-for="medium" data-e="qf2qn0-e" style="display: none;">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-toggle="mainNavigation"></button>
        <div class="title-bar-title">Menu</div>
      </div>
      <div class="title-bar-right">
        Marketing Site
      </div>
    </div>
    
    <div class="top-bar" id="mainNavigation" style="display: flex;">
      <div class="top-bar-left">
        <ul class="menu vertical medium-horizontal">
          <li class="menu-text hide-for-small-only">Marketing Site</li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu vertical medium-horizontal">
          <li><a href="#">Login</a></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->


    <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
      <ul class="orbit-container">
        <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
        <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
        <li class="orbit-slide is-active">
          <img src="https://via.placeholder.com/2000x750">
        </li>
        <li class="orbit-slide">
          <img src="https://via.placeholder.com/2000x750">
        </li>
        <li class="orbit-slide">
          <img src="https://via.placeholder.com/2000x750">
        </li>
        <li class="orbit-slide">
          <img src="https://via.placeholder.com/2000x750">
        </li>
      </ul>
    </div>

    <hr>

    <div class="row column text-center ">
      <h2>NEW CLUSTER GARDENVILLE</h2>
      <hr>
    </div>

    <div class="row small-up-1 medium-up-2 large-up-4 ">
        @foreach($main as $rows)
        <div class="column shadow">
          <img src="{{ url('assets/cluster/thumbnail/'.$rows->img_src) }}">
          <h5 class="text-center">{{ $rows->name }}</h5>
          <a href="{{ route('main.view', Str::lower($rows->name)); }}" class="button small expanded hollow">Lihat</a>
        </div>
        @endforeach
    </div>

    <hr>
    <div class="row">
 
    @foreach($attribute as $row)

      <div class="medium-4 columns">
        <div class="media-object">
          <div class="media-object-section">
            <img class="thumbnail" src="https://via.placeholder.com/100x100">
          </div>
          <div class="media-object-section">
            <h5>{{ $row->type_kavling }}</h5>
            <p>{{ $row->jalan }}</p>
          </div>
        </div>
      </div>
    @endforeach
    </div>

    <div class="callout large secondary">
      <div class="row">
        <div class="large-4 columns">
          <h5>TAMAN KOPO INDAH BANDUNG</h5>
        </div>
        <div class="large-3 large-offset-2 columns">
        </div>
        <div class="large-3 columns">
        </div>
      </div>
    </div>
@stop