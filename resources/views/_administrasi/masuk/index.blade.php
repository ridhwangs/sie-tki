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
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>C.O.A</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($administrasi AS $rows)
                    <tr>
                        <td><a href="javascript:void(0);" onclick="details({{ $rows->id }})">{{ $rows->kd_transaksi }}</a></td>
                        <td>{{ $rows->coa }}</td>
                        <td>{{ $rows->tanggal }}</td>
                        <td>{{ $rows->keterangan }}</td>
                        <td>{{ $rows->kas_masuk }}</td>
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

@stop
@section('script')
@stop