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
@endsection
@section('Content')
<div class="card m-3">
    <div class="card-header text-center">
        <h2>{{ $page }}</h2>
    </div>
    <div class="card-body">
        @if (count($dataKegiatan)>0)
            <div class="row">
                @foreach ($dataKegiatan as $item)
                    <div class="col-md-12">
                        <div class="callout callout-info">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5>{{ $item->nama_kegiatan }}</h5>
                                    <small>Tanggal Kegiatan: {{ $item->tanggal_kegiatan }}</small><br>
                                    <small>Status Kegiatan: <span class="status-kegiatan">{{ $item->status }}</span>
                                        @if($item->status==="Pendaftaran") sampai {{ $item->pendaftaran }}@endif</small><br>
                                    <small>Partisipasi: {{ $item->partisipasi }} dari {{ $item->max_partisipasi }}</small>
                                    <div class="col-md-3 pl-0 mb-3">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                                aria-valuenow="{{ ($item->partisipasi/$item->max_partisipasi) * 100 }}"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ ($item->partisipasi/$item->max_partisipasi) * 100 }}%">
                                            </div>
                                        </div>
                                    </div>
                                    @if ($user->peran!=='Anggota')
                                        <a href="/riwayat-kegiatan/{{ $item->slug }}">Detail Absensi</a>
                                    @else
                                        <small>
                                            Kehadiran:
                                            @if ($item->absensi[0]->absensi==='Izin')
                                                <span class="absensi-izin">Izin</span> Keterangan {{ $item->absensi[0]->keterangan }}
                                            @endif
                                            @if ($item->absensi[0]->absensi==='Hadir')
                                                <span class="status-kegiatan">Hadir</span> Keterangan {{ $item->absensi[0]->waktu_absen }}
                                            @endif
                                            @if ($item->absensi[0]->absensi==='Alpa')
                                                <span class="absensi-alpa">Alpa</span>
                                            @endif
                                        </small>
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <h5>Deskripsi Kegiatan:</h5>
                                    <small>
                                        {!! $item->deskripsi !!}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
        <p>Belum ada riwayat kegiatan</p>
        @endif
    </div>
</div>
@endsection
@section('styleJs')
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
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
@endsection
