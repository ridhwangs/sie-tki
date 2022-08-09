@extends('dashboard')
@section('title', 'Register New Card')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@yield('title')</h1> <a href="{{ route('card.index'); }}" class="btn-close" aria-label="Close"></a>
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
        <form action="{{ route('card.store') }}" id="form-register" method="POST">
        @csrf
            <div class="form-group row mb-2">
                <label for="cluster_id" class="col-sm-2 col-form-label">Cluster</label>
                <div class="col-sm-10">
                    <select class="form-control" id="cluster_id" name="cluster_id">
                        @foreach($master_cluster AS $rows)
                            <option value="{{ $rows->cluster_id }}">{{ $rows->nama_cluster }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="rfid" class="col-sm-2 col-form-label">RFID</label>
                <div class="col-sm-10">
                    <input type="text" name="rfid" id="rfid" class="form-control form-control-sm" value="{{ old('rfid') }}" placeholder="RFID Card" autofocus="yes" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="nama_pemilik" class="col-sm-2 col-form-label">Nama Pemilik</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control form-control-sm" value="{{ old('nama_pemilik') }}" placeholder="Nama Pemilik">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="kode_va" class="col-sm-2 col-form-label">Kode VA</label>
                <div class="col-sm-10">
                    <input type="text" name="kode_va" id="kode_va" class="form-control form-control-sm" value="{{ old('kode_va') }}" placeholder="Kode Va">
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="w-100 btn btn-sm btn-primary mt-3"  form="form-register" type="submit">Register</button>
    </div>
</div>
@stop