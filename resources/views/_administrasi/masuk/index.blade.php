@extends('dashboard')
@section('title', 'Administrasi Kas Masuk')
@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fa fa-sign-in" aria-hidden="true"></i> @yield('title')  <a href="{{ route('administrasi.create', 'masuk') }}" class="btn btn-sm btn-link">Form Administrasi</a></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>
@if(session()->has('message'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row mb-2">
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body">
                <form method="GET" id="form-filter" class="row">
                    <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="inputPassword4" class="form-label">Hingga Tanggal</label>
                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" required>
                    </div>
                    <div class="col-md-12">
                        <label for="coa" class="form-label">(C.O.A)</label>
                        <select id="coa" class="form-select" name="coa" required>
                            <option value="" selected disabled>Silahkan Pilih...</option>
                            <option value="all">Tampilkan Semua</option>
                            @foreach($coa AS $rows)
                                <option value="{{ $rows->coa }}">{{ $rows->coa }} - {{ $rows->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="submit" form="form-filter" class="btn btn-sm btn-primary">Filter</button>
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalSinkronisasi">Sinkronisasi Parkir</a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSinkronisasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Sinkronisasi Per Tanggal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('administrasi.get.parkir') }}" id="form-sinkronisas" method="POST" autocomplete="off">
                @csrf
                    <div class="form-group row mb-2">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="form-sinkronisas" class="btn btn-primary">Sinkronisasi</button>
            </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body" style="height:225px;">
                <div class="table-responsive">
                    <table class="table table-sm table-hover" style="width: 100%;">
                        <thead style="display: block;">
                            <tr>
                                <th style="width:80px">C.O.A</th>
                                <th style="width:290px">Keterangan</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody style="display: block;height: 140px;overflow-y: auto;overflow-x: hidden;">
                            @php
                                $sum_masuk = 0;
                            @endphp
                            @foreach($sum_group AS $key => $rows)
                                @php
                                    $sum_masuk += $rows->kas_masuk;
                                @endphp
                                <tr>
                                    <td style="width:80px">{{ $rows->coa }}</td>
                                    <td style="width:290px">{{ $rows->keterangan }}</td>
                                    <td align="right">{{ number_format($rows->kas_masuk) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="display: block;">
                            <tr>
                                <td style="width:280px" align="right" colspan="2"><a href="{{ route('administrasi.masuk.print') }}?@php echo @$_SERVER['QUERY_STRING']; @endphp&alokasi=gor"><i class="fas fa-print"></i></a> <b>Total</b></td>
                                <td align="right">{{ number_format($sum_masuk) }} </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body" style="height:225px;">
                <div class="table-responsive">
                    <table class="table table-sm table-hover" style="width: 100%;">
                        <thead style="display: block;">
                            <tr>
                                <th style="width:80px">C.O.A</th>
                                <th style="width:290px">Keterangan</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody style="display: block;height: 140px;overflow-y: auto;overflow-x: hidden;">
                            @php
                                $sum_masuk_2 = 0;
                            @endphp
                            @foreach($sum_group_2 AS $key => $rows)
                                @php
                                    $sum_masuk_2 += $rows->kas_masuk;
                                @endphp
                                <tr>
                                    <td style="width:80px">{{ $rows->coa }}</td>
                                    <td style="width:290px">{{ $rows->keterangan }}</td>
                                    <td align="right">{{ number_format($rows->kas_masuk) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="display: block;">
                            <tr>
                                <td style="width:280px" align="right" colspan="2"><a href="{{ route('administrasi.masuk.print') }}?@php echo @$_SERVER['QUERY_STRING']; @endphp&alokasi=butterfly"><i class="fas fa-print"></i></a><b>Total</b></td>
                                <td align="right">{{ number_format($sum_masuk_2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @if(!empty(@request()->tgl_akhir))
    <div class="col-md-12">
        <p>
        @if(!empty(@request()->tgl_awal))
            Menampilkan hasil filter dari tanggal {{ @request()->tgl_awal }} hingga tanggal {{ @request()->tgl_akhir }}
        @else
            Menampilkan hasil filter per tanggal {{ @request()->tgl_akhir }}
        @endif
             <a href="{{ route('administrasi.masuk') }}" class="btn-close float-end" aria-label="Close"></a>
        </p>
       
    </div>
    @endif
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
                                <th width="1px"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($administrasi AS $rows)
                            <tr>
                                <td>{{ $rows->kd_transaksi }}</td>
                                <td>{{ $rows->coa }}</td>
                                <td>{{ $rows->tanggal }}</td>
                                <td>{{ $rows->keterangan }}</td>
                                <td align="right">{{ number_format($rows->kas_masuk) }}</td>
                                <td>{{ $rows->created_by }}</td>
                                <td>{{ $rows->created_at }}</td>
                                <td><a class="btn btn-sm  btn-secondary" href="{{ route('administrasi.masuk.show', $rows->id) }}"><i class="fa-solid fa-pencil "></i></a></td>
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