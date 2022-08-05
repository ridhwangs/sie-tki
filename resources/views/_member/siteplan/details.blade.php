@extends('_member.main')
@section('title', 'Siteplan '. $cluster->name)

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@yield('title')</h1> <a href="{{ route('siteplan.index'); }}" class="btn-close" aria-label="Close"></a>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ url($cluster->img_src) }}" class="img-thumbnail rounded mx-auto d-block" loading="lazy" alt="" width="350px">
                    </div>
                    <div class="col-md-8">
                    <form method="POST" id="form-main" action="{{ route('main.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{  $cluster->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $cluster->name }}" aria-describedby="nameHelp" required>
                                <div id="nameHelp" class="form-text">Jangan menggunakan spasi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="information" class="form-label">Information</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="information" placeholder="Leave a comment here" id="informationFloat" style="height: 100px">{!! $cluster->information !!}</textarea>
                                    <label for="informationFloat">Informasi ex. Keunggulan kawasan</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" form="form-main" class="btn btn-primary float-end" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Simpan perubahan
                </button>
            </div>
        </div>
    </div>
    <div class="col-12">
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalApproved" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Approving</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-approved" method="post" action="{{ route('attribute.update') }}">
            @csrf
            <input type="hidden" class="form-control" id="id" name="id" value="">
            <input type="hidden" class="form-control" id="status" name="status" value="1">
            <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Marketing</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="marketing" value="">
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
            </div>
            <div class="mb-3">
                <label for="kode_va" class="form-label">Kode VA</label>
                <input type="text" class="form-control" id="kode_va" name="kode_va" aria-describedby="kodeVaHelp">
                <div id="kodeVaHelp" class="form-text">Input kode VA Penghuni jika diketahui.</div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="setuju" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Konfirmasi</label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="form-approved" class="btn btn-success">Approve</button>
      </div>
    </div>
  </div>
</div>

@stop
@section('script')
<script>
    function approved(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('attribute.details', '') }}/' + id,
            data: {_token: CSRF_TOKEN},
            type: 'GET',
            dataType: 'json',
        })
        .done(function (data) {
            $('#modalApproved').modal('show'); 
            $("#staticEmail").val(data.marketing)
            $("#id").val(data.id)
            $("#marketing").val(data.nama_user)
            console.log(data);
        })
        .fail(function (data) {
            console.log(data);
        })
    }
</script>
@stop