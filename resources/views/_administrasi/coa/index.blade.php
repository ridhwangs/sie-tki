@extends('dashboard')
@section('title', 'Chart Of Accounts')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">@yield('title')  <a href="{{ route('coa.create') }}" class="btn btn-sm btn-link">Create New Account</a></h1>
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
                        <th>C.O.A</th>
                        <th>Keterangan</th>
                        <th>Alokasi</th>
                        <th>Transaksi</th>
                        <th width="1px">#</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($coa AS $rows)
                    <tr>
                        <td>{{ $rows->coa }}</td>
                        <td>{{ $rows->keterangan }}</td>
                        <td>{{ $rows->alokasi }}</td>
                        <td>{{ $rows->transaksi }}</td>
                        <td><a class="btn btn-sm  btn-secondary" href="{{ route('coa.edit', $rows->id) }}"><i class="fa-solid fa-pencil "></i></a></td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
@section('script')
@stop