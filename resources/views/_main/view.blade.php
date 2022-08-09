@extends('main')
@section('title', $main->name)    
@section('style')
    body {
        font-family: 'Nunito', sans-serif;
        background-color:black;
        height:100vh;
        width:100vh;
    }
    .break-top {
        padding-top:55px;
    }
     .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
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
        <nav class="navbar fixed-top" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <b class="navbar-brand"><a href="{{ route('main') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-angle-left"></i></a> @yield('title')</b>
                <div class="d-flex">
                    @if($zoom_level > 1)
                    <a class="btn btn-sm btn-link" href="{{ route('main.view', $main->name); }}?zoom={{ $zoom_level - 1 }}"><i class="fa-solid fa-magnifying-glass-minus"></i></a>
                    @endif
                        <input id="controllerMain" min="1" max="10" step="1" value="{{ $zoom_level }}" onchange="showVal(this.value)" type="range"/> 
                    @if($zoom_level < 10)
                    <a class="btn btn-sm btn-link" href="{{ route('main.view', $main->name); }}?zoom={{ $zoom_level + 1 }}"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                    @endif
                    
                </div>
               
            </div>
        </nav>    
        <div class="break-top"></div>
        <div class="contenMain" style="transform: scale(0.1);transform-origin: 0% 0% 0px;">
            <img src="{{ url('assets/cluster/compressed/'.$main->img_src) }}"  style="position:relative; width: fit-content;">
            @foreach($attribute AS $rows)
                <div id="{{ $rows->_div }}"  @if($rows->status != 3) onclick="viewDetails({{ $rows->id }});" @endif>
                    {{  Str::replace('_', '', $rows->no);  }}
                </div>
            @endforeach
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="modalDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailsTitle">{Null}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-attr" method="post" action="{{ route('cluster.update') }}">
                    @csrf
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="nomor_rumah">
                        <div class="form-group">
                            <label for="no">Nomor</label>
                            <input type="text" class="form-control" id="no" placeholder="no" readonly>
                        </div>
                        <div class="form-group">
                            <label for="type_kavling">Type Kavling</label>
                            <input type="text" class="form-control" id="type_kavling" placeholder="type_kavling" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Terjual</option>
                                <option value="0">Tersedia</option>
                                <option value="2">Booked</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marketing">Marketing</label>
                            <input type="text" class="form-control" id="marketing" name="marketing" placeholder="marketing">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Lainya</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-attr" class="btn btn-primary rounded-0">Simpan</button>
                </div>
                </div>
            </div>
        </div>
@stop
@section('script')
<script>
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
    function showVal(a){
        $('#cover-spin').show(0);
        // var zoomScale = Number(a)/10;
        // setZoom(zoomScale,document.getElementsByClassName('contenMain')[0]);
        location.replace("{{ route('main.view', $main->name); }}?zoom=" + a);
    }
    function viewDetails(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('siteplan.details', '') }}/' + id,
            data: {_token: CSRF_TOKEN},
            type: 'GET',
            dataType: 'json',
        })
        .done(function (data) {
            $("#modalDetailsTitle").html(data._div);
            $("#id").val(data.id);
            $("#no").val(data.no);
            $("#status").val(data.status);
            $("#keterangan").val(data.keterangan);
            $("#marketing").val(data.marketing);
            $("#type_kavling").val(data.type_kavling);
            $('#modalDetails').modal('show'); 
            console.log(data);
        })
        .fail(function (data) {
            console.log(data);
        })
    }
</script>
@stop