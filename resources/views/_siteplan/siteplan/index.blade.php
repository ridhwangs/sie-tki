@extends('dashboard')
@section('title', 'Siteplan')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">@yield('title')</h1>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nama Cluster</th>
                        <th>Information</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Update At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($main as $rows)
                        <tr>
                            <td><img src="{{ url($rows->img_src) }}" class="img-thumbnail rounded mx-auto d-block" loading="lazy" alt="" width="150px"></td>
                            <td><a href="{{ route('siteplan.details', $rows->name) }}">{{ $rows->name }}</a></td>
                            <td>{{ $rows->information }}</td>
                            <td>{{ $rows->created_by }}</td>
                            <td>{{ $rows->created_at }}</td>
                            <td>{{ $rows->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop