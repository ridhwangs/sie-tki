@extends('siteplan')
@section('title', $main->name)    
@section('style')
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
        padding: 0;
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


    @foreach($attribute AS $rows)
        #{{ $rows->_div }}{
            position: absolute;
            z-index: inherit;
            @if($rows->status == 0)
                background: {{ $rows->background_color }};
                cursor: pointer;
            @elseif($rows->status == 3)
                background: #dd3838;
            @else
                background: #babbb5;
            @endif
            width: {{ $rows->size_width }};
            height: {{ $rows->size_height }};
            left: {{ $rows->margin_left }};
            top: {{ $rows->margin_top }};
            border: {{ $rows->border_prop }};
            line-height: {{ $rows->line_height }};
            text-align: center;
            font-size: {{ $rows->font_size }};
            font-weight: bold;
            
            
            <!-- opacity: 0.1; -->
        }
        #{{ $rows->_div }}:hover{
            
            @if($rows->status == 0)
                background-color: #2980b9;
            @endif
        }
    @endforeach
@stop
@section('content')
    <nav>
        <ul>
            <li><a href="{{ route('main', $themes) }}" class="button is-danger"><i class="fa-solid fa-angle-left"></i></a></li>
       
            <li style="float:right">
                @if($zoom_level < 10)
                    <a href="{{ route('main.view', ['themes' => $themes , 'name' => Str::lower($main->name)]); }}?zoom={{ $zoom_level + 1 }}"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                @endif
            </li>
            <li style="float:right">
                <div style="padding-top:15px;">
                    <input id="controllerMain" min="1" max="10" step="1" value="{{ $zoom_level }}" onchange="showVal(this.value)" type="range"/> 
                </div>        
             </li>
            <li style="float:right">
                @if($zoom_level > 1)
                    <a href="{{ route('main.view', ['themes' => $themes , 'name' => Str::lower($main->name)]); }}?zoom={{ $zoom_level - 1 }}"><i class="fa-solid fa-magnifying-glass-minus"></i></a>
                @endif
            </li>
        </ul>
    </nav>

    <div class="contenMain" style="transform: scale(0.1);transform-origin: 0% 0% 0px;">
        <img src="{{ url('assets/cluster/w-1200/'.$main->img_src) }}" style="position:relative;" width="{{ $main->img_width }}px" height="{{ $main->img_height }}px">
        @foreach($attribute AS $rows)
            <div id="{{ $rows->_div }}"  @if($rows->status == 0) onclick="viewDetails({{ $rows->id }});" @endif>
                {{  Str::replace('_', '', $rows->no);  }}
                <!-- {{ $rows->id; }} -->
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
        // var zoomScale = Number(a)/10;
        // setZoom(zoomScale,document.getElementsByClassName('contenMain')[0]);
        location.replace("{{ route('main.view', ['themes' => $themes , 'name' => Str::lower($main->name)]); }}?zoom=" + a);
    }
    
    function viewDetails(id) {
        var zoom = {{ $zoom_level }};
        location.replace("{{ route('main.details', ['themes' => $themes , '']); }}/" + id + "?zoom=" + zoom);
    }
    
</script>
@stop