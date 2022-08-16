@extends('main')
@section('title', $main->name)    
@section('style')
    body {
        font-family: 'Nunito', sans-serif;
        background-color:black;
        height:100vh;
    }
    .break-top {
        padding-top:55px;
    }
    
    @foreach($attribute AS $rows)
        #{{ $rows->_div }}{
            position: absolute;
            z-index: inherit;
            background: {{ $rows->background_color }};
            width: {{ $rows->size_width }};
            height: {{ $rows->size_height }};
            left: {{ $rows->margin_left }};
            top: {{ $rows->margin_top }};
            border: {{ $rows->border_prop }};
            line-height: {{ $rows->line_height }};
            text-align: center;
            font-size: {{ $rows->font_size }};
            font-weight: bold;
            cursor: pointer;
            <!-- opacity: 0.5; -->
        }
        #{{ $rows->_div }}:hover{
            background-color: #2980b9;
            color: white;
        }
    @endforeach
 
@stop
@section('content')
<div class="top-bar stacked-for-medium" id="responsive-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">{{ $main->name }}</li>
    </ul>
  </div>
  <div class="top-bar-right">
        @if($zoom_level > 1)
            <a class="btn btn-sm btn-link" href="{{ route('main.view', $main->name); }}?zoom={{ $zoom_level - 1 }}"><i class="fa-solid fa-magnifying-glass-minus"></i></a>
        @endif
            <input id="controllerMain" min="1" max="10" step="1" value="{{ $zoom_level }}" onchange="showVal(this.value)" type="range"/> 
        @if($zoom_level < 10)
            <a class="btn btn-sm btn-link" href="{{ route('main.view', $main->name); }}?zoom={{ $zoom_level + 1 }}"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
        @endif
        
  </div>
</div>   
        <div class="contenMain" style="transform: scale(0.1);transform-origin: 0% 0% 0px;">
            <img src="{{ url('assets/cluster/compressed/'.$main->img_src) }}"  style="position:relative; width: fit-content;">
            @foreach($attribute AS $rows)
                <div id="{{ $rows->_div }}"  @if($rows->status != 3) onclick="viewDetails({{ $rows->id }});" @endif>
                    {{  Str::replace('_', '', $rows->no);  }}
                </div>
            @endforeach
        </div>
@stop
@section('script')
<script>
    $(function() {
        console.log( "ready!" );
        var scaleNow = $("#controllerMain").val();
        setZoom({{ $zoom_level }}/10,document.getElementsByClassName('contenMain')[0]);
        function setZoom(zoom,el) {
            transformOrigin = [0,0];
                el = el || instance.getContainer();
                var p = ["webkit", "moz", "ms", "o"],
                    s = "scale(" + zoom + ")",
                    oString = (transformOrigin[0] * 100) + "% " + (transformOrigin[1] * 100) + "%";
                for (var i = 0; i < p.length; i++) {
                    el.style[p[i] + "Transform"] = s;
                    el.style[p[i] + "TransformOrigin"] = oString;
                }
                el.style["transform"] = s;
            el.style["transformOrigin"] = oString;
            
        }
       
       
    });

    function showVal(a){
        $('#cover-spin').show(0);
        // var zoomScale = Number(a)/10;
        // setZoom(zoomScale,document.getElementsByClassName('contenMain')[0]);
        location.replace("{{ route('main.view', $main->name); }}?zoom=" + a);
    }
    
    function viewDetails(id) {
        location.replace("{{ route('main.details', ''); }}/" + id);
    }
    
</script>
@stop