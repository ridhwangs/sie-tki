@extends('main')
@section('title', 'Selamat Datang')    
@section('content')

<div class="grid-x grid-padding-x">
        <div class="large-12 medium-12 cell">
          <h5>Here&rsquo;s your basic grid:</h5>
          <!-- Grid Example -->

          <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
              <div class="primary callout">
                <p><strong>This is a twelve cell section in a grid-x.</strong> Each of these includes a div.callout element so you can see where the cell are - it's not required at all for the grid.</p>
              </div>
            </div>
          </div>
          <div class="grid-x grid-padding-x">
          @foreach($main as $rows)
            <div class="large-4 medium-4 small-12 cell">
              <div class="card">
                <img src="{{ url('assets/cluster/thumbnail/'.$rows->img_src) }}">
                <div class="card-section">
                <a href="{{ route('main.view', Str::lower($rows->name)); }}" class="btn btn-sm btn-outline-secondary">View</a>
                </div>
              </div>
            </div>
          @endforeach
          </div>
        </div>
      </div>

@stop