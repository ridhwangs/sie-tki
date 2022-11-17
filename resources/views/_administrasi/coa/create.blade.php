@extends('dashboard')
@section('title', 'Form Chart Of Accounts')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@yield('title')</h1> <a href="{{ route('coa.index'); }}" class="btn-close" aria-label="Close"></a>
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
        <form action="{{ route('coa.store') }}" id="form" method="POST" autocomplete="off">
        @csrf
            <div class="form-group row mb-2">
                <label for="coa" class="col-sm-2 col-form-label">C.O.A</label>
                <div class="col-sm-10">
                    <input type="text" name="coa" id="coa" class="form-control form-control-sm" value="{{ old('coa') }}" placeholder="Chart Of Account" autofocus="yes" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" value="{{ old('keterangan') }}" placeholder="Keterangan" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="alokasi" class="col-sm-2 col-form-label">Alokasi</label>
                <div class="col-sm-10">
                     <select name="alokasi" id="alokasi" class="form-control form-control-sm" required>
                        <option value="" disabled selected>-- pilih alokasi --</option>
                        <option value="GOR">GOR</option>
                        <option value="BUTTERFLY">BUTTERFLY</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="transaksi" class="col-sm-2 col-form-label">Transaksi</label>
                <div class="col-sm-10">
                    <select name="transaksi" id="transaksi" class="form-control form-control-sm" required>
                        <option value="" disabled selected>-- pilih jenis transaksi --</option>
                        <option value="D">DEBIT</option>
                        <option value="K">KREDIT</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="w-100 btn btn-sm btn-primary mt-3"  form="form" type="submit">Simpan</button>
    </div>
</div>
@stop