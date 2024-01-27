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
    <div class="card-body d-flex justify-content-center">
        <div class="col-md-12" id="calendar"></div>
    </div>
</div>
@endsection
@section('styleJs')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @foreach($dataKegiatan as $kegiatan)
                {
                    title: 'Pendaftaran Kegiatan : {{ $kegiatan->nama_kegiatan }}',
                    description: 'Pendaftaran Kegiatan : {{ $kegiatan->nama_kegiatan }}',
                    start: '{{ $kegiatan->created_at->format("Y-m-d") }}',
                    end:'{{ $kegiatan->pendaftaran }}', 
                },
                {
                    title: 'Pelaksanaan Kegiatan : {{ $kegiatan->nama_kegiatan }}',
                    description: 'Pelaksanaan Kegiatan : {{ $kegiatan->nama_kegiatan }}',
                    start: '{{ $kegiatan->tanggal_kegiatan }}', 
                    end:'{{ $kegiatan->tanggal_selesai }}', 
                },
            @endforeach
        ],
    });
    calendar.render();
});
</script>

@endsection
