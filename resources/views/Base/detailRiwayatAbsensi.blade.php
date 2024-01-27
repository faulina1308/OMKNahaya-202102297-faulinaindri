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
        <div class="row">
            <div class="col-md-12">
                <div class="callout">
                    <h5>{{ $kegiatan->nama_kegiatan }}</h5>
                    <small>Tanggal Kegiatan: {{ $kegiatan->tanggal_kegiatan }} sampai
                        {{ $kegiatan->tanggal_selesai }}</small><br>
                    <small>Status Kegiatan: <span class="status-kegiatan">{{ $kegiatan->status }}</span>
                        @if($kegiatan->status==="Pendaftaran") sampai {{ $kegiatan->pendaftaran }}@endif</small><br>
                    <small>Partisipasi: {{ $kegiatan->partisipasi }} dari {{ $kegiatan->max_partisipasi }}</small>
                    <div class="col-md-3 pl-0">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                aria-valuenow="{{ ($kegiatan->partisipasi/$kegiatan->max_partisipasi) * 100 }}"
                                aria-valuemin="0" aria-valuemax="100"
                                style="width: {{ ($kegiatan->partisipasi/$kegiatan->max_partisipasi) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-2 mb-0">Deskripsi Kegiatan:</h5>
                    <small>
                        {!! $kegiatan->deskripsi !!}
                    </small>
                </div>
            </div>
        </div>
        @if (count($dataAbsen)>0)
        <div class="card">
            <div class="card-header text-center">
                <h2>Absensi Kegiatan</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-left">
                            <tr>
                            <tr>
                                <th class="pr-3">No</th>
                                <th class="pr-3">Nama</th>
                                <th class="pr-3">Stasi</th>
                                <th class="pr-3">Waktu Absen</th>
                                <th class="pr-3">Keterangan</th>
                                <th class="pr-3">Kehadiran</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            @foreach ($dataAbsen as $item)
                            <tr>
                                <td class="pr-3">{{ $loop->iteration }}</td>
                                <td class="pr-3">{{ $item->user->nama }}</td>
                                <td class="pr-3">{{ $item->user->stasi->nama_stasi }}</td>
                                <td class="pr-3">{{ $item->waktu_absen }}</td>
                                <td class="pr-3 col-md-1">
                                    <input type="text" value="{{ $item->keterangan }}"
                                        name="keterangan[{{ $item->id }}]"
                                        class="form-control keterangan-input text-center"
                                        style="{{ ($item->absensi === 'Izin') ? 'display: block;' : 'display: none;' }}" disabled>
                                </td>
                                <td class="pr-3 col-md-2">
                                    <div class="form-group">
                                        <select class="form-control select-absensi" name="absensi[{{ $item->id }}]" disabled>
                                            <option value="Hadir" {{ ($item->absensi === 'Hadir') ? 'selected' : '' }}>
                                                Hadir</option>
                                            <option value="Alpa" {{ ($item->absensi === 'Alpa') ? 'selected' : '' }}>
                                                Alpa</option>
                                            <option value="Izin" {{ ($item->absensi === 'Izin') ? 'selected' : '' }}>
                                                Izin</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $("#example1").DataTable();
    });

</script>
<script>
    $(document).ready(function () {
        $('.select-absensi').on('change', function () {
            var selectedValue = $(this).val();
            var $keteranganInput = $(this).closest('tr').find('.keterangan-input');
            var $keteranganSpan = $(this).closest('tr').find('.keterangan-span');
            if (selectedValue === 'Izin') {
                $keteranganInput.show();
                $keteranganSpan.hide();
            } else {
                $keteranganInput.hide();
                $keteranganSpan.show();
            }
        });
    });

</script>
@endsection
