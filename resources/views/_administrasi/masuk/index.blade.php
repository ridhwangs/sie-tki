@extends('dashboard')
@section('title', 'Administrasi Kas Masuk')
@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">@yield('title')  <a href="{{ route('administrasi.create', 'masuk') }}" class="btn btn-sm btn-link">Form Administrasi</a></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>
@if(session()->has('message'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="GET" id="form-filter" class="row">
                    <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="inputPassword4" class="form-label">Hingga Tanggal</label>
                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" required>
                    </div>
                    <div class="col-md-12">
                        <label for="coa" class="form-label">(C.O.A)</label>
                        <select id="coa" class="form-select" name="coa" required>
                            <option value="" selected disabled>Silahkan Pilih...</option>
                            @foreach($coa AS $rows)
                                <option value="{{ $rows->coa }}">{{ $rows->coa }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="submit" form="form-filter" class="btn btn-sm btn-primary">Filter</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h1>Kas Masuk : {{ number_format($sum) }}</h1>
            </div>
        </div>
    </div>
   
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>C.O.A</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th width="1px">Created By</th>
                                <th width="1px">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($administrasi AS $rows)
                            <tr>
                                <td><a href="{{ route('administrasi.masuk.show', $rows->id) }}">{{ $rows->kd_transaksi }}</a></td>
                                <td>{{ $rows->coa }}</td>
                                <td>{{ $rows->tanggal }}</td>
                                <td>{{ $rows->keterangan }}</td>
                                <td align="right">{{ number_format($rows->kas_masuk) }}</td>
                                <td>{{ $rows->created_by }}</td>
                                <td>{{ $rows->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                        {!! $administrasi->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@stop
@section('script')
<script>
    $("#tgl_awal").val("{{ request()->tgl_awal }}");
    $("#tgl_akhir").val("{{ request()->tgl_akhir }}");
    $("#coa").val("{{ request()->coa }}");
</script>
@stop