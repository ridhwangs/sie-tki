@extends('dashboard')
@section('title', 'Card Table')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">@yield('title')</h1>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <th>RFID</th>
                        <th>Nama Pemilik</th>
                        <th>Home No</th>
                        <th>Kode VA</th>
                        <th>Custer</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($card AS $rows)
                    <tr>
                        <td><a href="javascript:void(0);" onclick="details({{ $rows->id }})">{{ $rows->rfid }}</a></td>
                        <td>{{ $rows->nama_pemilik }}</td>
                        <td>{{ $rows->home_no }}</td>
                        <td>{{ $rows->kode_va }}</td>
                        <td>{{ $rows->nama_cluster }}</td>
                        <td>{{ $rows->created_by }}</td>
                        <td>{{ $rows->created_at }}</td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                {!! $card->links() !!}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDetailsTitle">{Null}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-attr" method="post" action="{{ route('card.store') }}">
                @csrf
                <input type="hidden" class="form-control" id="id" name="id">
                <div class="form-group mb-2">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Nama Pemilik">
                </div>
                <div class="form-group mb-2">
                    <label for="home_no">Home No</label>
                    <input type="text" class="form-control" id="home_no" name="home_no" placeholder="Home No">
                </div>
                <div class="form-group">
                    <label for="kode_va">Kode Va</label>
                    <input type="text" class="form-control" id="kode_va" name="kode_va" placeholder="Kode Va">
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
    function details(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('card.show', '') }}/' + id,
            data: {_token: CSRF_TOKEN},
            type: 'GET',
            dataType: 'json',
        })
        .done(function (data) {
            $("#modalDetailsTitle").html("RFID: "+ data.rfid);
            $("#id").val(data.id);
            $("#nama_pemilik").val(data.nama_pemilik);
            $("#home_no").val(data.home_no);
            $("#kode_va").val(data.kode_va);
            $('#modalDetails').modal('show'); 
            console.log(data);
        })
        .fail(function (data) {
            console.log(data);
        })
    }
</script>
@stop