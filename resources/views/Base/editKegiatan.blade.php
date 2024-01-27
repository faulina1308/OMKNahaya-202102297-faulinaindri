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
        <div class="col-md-12">
            <form action="/kegiatan-omk-edit/{{ $dataKegiatan->slug }}" method="POST"> 
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama" placeholder="Judul blog" autofocus required value="{{ $dataKegiatan->nama_kegiatan }}">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="judul">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan" class="form-control @error('tanggal_kegiatan') is-invalid @enderror" required value="{{ $dataKegiatan->tanggal_kegiatan }}">
                            @error('tanggal_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="judul">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" required value="{{ $dataKegiatan->tanggal_selesai }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="judul">Estimasi Anggaran</label>
                            <input type="text" name="anggaran" id="anggaran" class="form-control @error('anggaran') is-invalid @enderror" required value="{{ number_format($dataKegiatan->anggaran, 0, ',', '.') }}" oninput="formatAnggaran(this)">
                            @error('anggaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="judul">Jumlah Partisipasi</label>
                            <input type="number" name="max_partisipasi" class="form-control @error('max_partisipasi') is-invalid @enderror" min="1" required value="{{ $dataKegiatan->max_partisipasi }}">
                            @error('max_partisipasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="judul">Tanggal Tutup Pendaftaran</label>
                            <input type="date" name="pendaftaran" class="form-control @error('pendaftaran') is-invalid @enderror" required value="{{ $dataKegiatan->pendaftaran }}">
                            @error('pendaftaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control deskripsi @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="15">{!! $dataKegiatan->deskripsi !!}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.3/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea.deskripsi',
        height:500,
    })
</script>
<script>
    function formatAnggaran(input) {
        let anggaran = input.value.replace(/\D/g, '');
        if (anggaran.length > 0) {
            anggaran = parseInt(anggaran, 10).toLocaleString('id-ID');
        }
        input.value = anggaran;
    }
</script>
@endsection
