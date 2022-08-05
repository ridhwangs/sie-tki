@extends('_member.main')
@section('title', 'Dashboard')

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@yield('title')</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No Rumah</th>
                            <th>Type Kavling</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Marketing</th>
                            <th>Kode VA</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th widht="1%">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attribute as $rows)
                        @php 
                            $status = [
                                '0' => 'Tersedia',
                                '1' => 'Terjual',
                                '2' => 'Booked'
                            ];
                            $table_status = [
                                '0' => '',
                                '1' => 'table-success',
                                '2' => 'table-warning'
                            ];
                            $home_icon = [
                                '0' => '<i class="fa-solid fa-house-blank"></i>',
                                '1' => '<i class="fa-solid fa-house-user"></i>',
                                '2' => '<i class="fa-solid fa-house-lock"></i>'
                            ];
                        @endphp
                            <tr class="{{ $table_status[$rows->status] }}">
                                <td>{!! $home_icon[$rows->status] !!} {{ $rows->no }}</td>
                                <td>{{ $rows->type_kavling }}</td>
                                <td>{{ $rows->keterangan }}</td>
                                <td>{{ $status[$rows->status] }}</td>
                                <td>{{ $rows->marketing }}</td>
                                <td>{{ $rows->kode_va }}</td>
                                <td>{{ $rows->created_by }}</td>
                                <td>{{ $rows->created_at }}</td>
                                <td>{{ $rows->updated_at }}</td>
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
@stop