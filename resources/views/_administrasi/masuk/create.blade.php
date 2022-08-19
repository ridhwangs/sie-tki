@extends('dashboard')
@section('title', 'Form Administrasi')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@yield('title')</h1> <a href="{{ route('administrasi.'.$jenis); }}" class="btn-close" aria-label="Close"></a>
</div>
@if(session()->has('message'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <form action="{{ route('administrasi.store') }}" id="form" method="POST">
        @csrf
            <div class="form-group row mb-2">
                <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">
                    <input type="text" name="jenis" id="jenis" class="form-control form-control-sm" value="{{ $jenis }}" placeholder="Jenis" readonly>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="rfid" class="col-sm-2 col-form-label">C.O.A</label>
                <div class="col-sm-10">
                    <input type="text" name="rfid" id="rfid" class="form-control form-control-sm" value="{{ old('coa') }}" placeholder="Chart Of Account" autofocus="yes">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm" value="{{ old('tanggal') }}" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" value="{{ old('keterangan') }}" placeholder="Keterangan">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm" value="{{ old('jumlah') }}" placeholder="Rp. " required>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="w-100 btn btn-sm btn-primary mt-3"  form="form" type="submit">Simpan</button>
    </div>
</div>
@stop