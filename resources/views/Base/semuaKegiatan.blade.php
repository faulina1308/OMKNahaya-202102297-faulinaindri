@extends('Partial.root')
@section('styleCss')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('Content')
<div class="card m-3">
    <div class="card-header text-center">
        <h2>{{ $page }}</h2>
    </div>
    <div class="card-body">
        @if (count($dataKegiatan)>0)
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped w-400">
                <thead class="text-left">
                    <tr>
                        <th class="pr-3">No</th>
                        <th class="pr-3">Kegiatan</th>
                        <th class="pr-3">Tanggal</th>
                        <th class="pr-3">Peserta</th>
                        <th class="pr-3">Pendaftaran <br>ditutup</th>
                        <th class="pr-3">Anggaran</th>
                        <th class="pr-3">Status</th>
                        <th class="pr-3">Informasi Tambahan</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    @foreach ($dataKegiatan as $item)
                    <tr>
                        <td class="pr-3">{{ $loop->iteration }}</td>
                        <td class="pr-3">
                            <div class="row">
                                <div class="col-md-11">
                                    {{ $item->nama_kegiatan }}
                                </div>
                                <div class="col-md-1">
                                    @can('KetuaOMK')
                                        <a href="/kegiatan-omk-edit/{{ $item->slug }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <form action="/batalkan-kegiatan/{{ $item->slug }}" method="POST">
                                            @csrf
                                            <button type="submit" class="custom-button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            &nbsp; &nbsp;
                        </td>
                        <td class="pr-3">{{ $item->tanggal_kegiatan }} - {{ $item->tanggal_selesai }}</td>
                        <td class="pr-3">{{ $item->partisipasi }} dari {{ $item->max_partisipasi }}</td>
                        <td class="pr-3">{{ $item->pendaftaran }}</td>
                        <td class="pr-3">Rp.{{ number_format($item->anggaran, 0, ',', '.') }}</td>
                        <td class="pr-3">{{ $item->status }}</td>
                        <td class="pr-3">{!! $item->deskripsi !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Belum ada kegiatan</p>
        @endif
    </div>
</div>
@endsection
@section('styleJs')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>
@endsection
