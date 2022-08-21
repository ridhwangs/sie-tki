@extends('dashboard')
@section('title', 'CLUSTER '. $cluster->name)

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@yield('title') </h1> <a href="{{ route('siteplan.index'); }}" class="btn-close" aria-label="Close"></a>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ url('assets/cluster/compressed/'.$cluster->img_src) }}" class="img-thumbnail rounded mx-auto d-block" loading="lazy" alt="" width="350px">
                    </div>
                    <div class="col-md-8">
                    <form method="POST" id="form-main" action="{{ route('cluster.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{  $cluster->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $cluster->name }}" aria-describedby="nameHelp" required>
                                <div id="nameHelp" class="form-text">Cluster.</div>
                            </div>
                            <div class="mb-3">
                                <label for="information" class="form-label">Information</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="information" placeholder="Leave a comment here" id="informationFloat" style="height: 100px">{!! $cluster->information !!}</textarea>
                                    <label for="informationFloat">Informasi ex. Keunggulan kawasan</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" form="form-main" class="btn btn-primary float-end" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Simpan perubahan
                </button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No Rumah</th>
                                <th>Type</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Marketing</th>
                                <th>Kode VA</th>
                                <th>Jalan</th>
                                <th widht="1%">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attribute as $rows)
                            @php 
                                $status = [
                                    '0' => 'Tersedia',
                                    '1' => 'Terjual',
                                    '2' => 'Booked',
                                    '3' => 'Show Unit'
                                ];
                                $table_status = [
                                    '0' => '',
                                    '1' => 'table-success',
                                    '2' => 'table-warning',
                                    '3' => 'table-danger',
                                ];
                            @endphp
                                <tr class="{{ $table_status[$rows->status] }}">
                                    <td><a href="javascript:void(0);" onclick="viewDetails({{ $rows->id }})"><i class="fa-solid fa-file-pen"></i></a> {{ $rows->no }}</td>
                                    <td>{{ $rows->type_kavling }}</td>
                                    <td>{{ $rows->keterangan }}</td>
                                    <td>{{ $status[$rows->status] }}</td>
                                    <td>{{ $rows->marketing }}</td>
                                    <td>{{ $rows->kode_va }}</td>
                                    <td>{{ $rows->jalan }}</td>
                                    <td>
                                        @if($rows->status == 2)
                                            <a class="btn btn-success" onclick="approved({{ $rows->id }})" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Approved</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalApproved" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Approving</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-approved" method="post" action="{{ route('siteplan.update') }}">
            @csrf
            <input type="hidden" class="form-control id" id="id" name="id" value="">
            <input type="hidden" class="form-control" id="status" name="status" value="1">
            <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Marketing</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext marketing" id="marketing" value="">
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
            </div>
            <div class="mb-3">
                <label for="kode_va" class="form-label">Kode VA</label>
                <input type="text" class="form-control" id="kode_va" name="kode_va" aria-describedby="kodeVaHelp">
                <div id="kodeVaHelp" class="form-text">Input kode VA Penghuni jika diketahui.</div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="setuju" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Konfirmasi</label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="form-approved" class="btn btn-success">Approve</button>
      </div>
    </div>
  </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="modalDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDetailsTitle">{Null}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-attr" method="post" action="{{ route('siteplan.update') }}">
            @csrf
            <input type="hidden" class="form-control id" id="id" name="id">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="no">Nomor</label>
                        <input type="text" class="form-control" id="no" name="no" placeholder="no">
                    </div>
                    <div class="form-group">
                        <label for="type_kavling">Type Kavling</label>
                        <input type="text" class="form-control" id="type_kavling" name="type_kavling" placeholder="type_kavling">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control status" id="status" name="status">
                            <option value="1">Terjual</option>
                            <option value="0">Tersedia</option>
                            <option value="2">Booked</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="marketing">Marketing</label>
                        <input type="text" class="form-control marketing" id="marketing" name="marketing" placeholder="marketing">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Lainya</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-md-5 border-start border-danger">
                    <div class="form-group">
                        <label for="size_width">Size Width</label>
                        <input type="text" class="form-control" id="size_width" name="size_width" placeholder="size_width">
                    </div>  
                    <div class="form-group">
                        <label for="size_height">Size Height</label>
                        <input type="text" class="form-control" id="size_height" name="size_height" placeholder="size_height">
                    </div>
                    <div class="form-group">
                        <label for="margin_left">Margin Left</label>
                        <input type="text" class="form-control" id="margin_left" name="margin_left" placeholder="margin_left">
                    </div> 
                    <div class="form-group">
                        <label for="margin_top">Margin Top</label>
                        <input type="text" class="form-control" id="margin_top" name="margin_top" placeholder="margin_top">
                    </div>  
                    <div class="form-group">
                        <label for="background_color">Color</label>
                        <input type="text" class="form-control" id="background_color" name="background_color" placeholder="background_color">
                    </div> 
                    <div class="form-group">
                        <label for="border_prop">Border</label>
                        <input type="text" class="form-control" id="border_prop" name="border_prop" placeholder="border_prop">
                    </div>                
                </div>
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
    function approved(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('siteplan.details', '') }}/' + id,
            data: {_token: CSRF_TOKEN},
            type: 'GET',
            dataType: 'json',
        })
        .done(function (data) {
            $('#modalApproved').modal('show'); 
            $("#staticEmail").val(data.marketing)
            $(".id").val(data.id)
            $("#marketing").val(data.nama_user)
            console.log(data);
        })
        .fail(function (data) {
            console.log(data);
        })
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
            $(".id").val(data.id);
            $("#no").val(data.no);
            $(".status").val(data.status);
            $("#keterangan").val(data.keterangan);
            $(".marketing").val(data.marketing);
            $("#type_kavling").val(data.type_kavling);
            $('#modalDetails').modal('show'); 
            $("#size_width").val(data.size_width);
            $("#size_height").val(data.size_height);
            $("#margin_left").val(data.margin_left);
            $("#margin_top").val(data.margin_top);
            $("#background_color").val(data.background_color);
            $("#border_prop").val(data.border_prop);
        })
        .fail(function (data) {
            console.log(data);
        })
    }

    $('#form-attr').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "JSON",
        })
        .done(function (data) {
            location.reload();
        })
        .fail(function (data) {
            console.log(data);
        })
        return false;
    });

    function open_popup(url) {
        params = 'width=' + screen.width;
        params += ', height=' + screen.height;
        params += ', top=0, left=0'
        params += ', fullscreen=yes';
        params += ', directories=no';
        params += ', location=no';
        params += ', menubar=no';
        params += ', resizable=no';
        params += ', status=no';
        params += ', toolbar=no';
        myWindow = window.open(url, 'VIEW MODE', params);
        // Add this event listener; the function will be called when the window closes
        if (window.focus) {
        myWindow.focus()
        }
        return false;
    }
</script>
@stop