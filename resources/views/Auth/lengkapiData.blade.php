@extends('Auth.root')
@section('styleCss')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection
@section('Content')
<p class="login-box-msg">Hai {{ $user->nama }}, Kamu perlu melengkapi data kamu dulu</p>
<form action="/lengkapi-data" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
            value="{{ old('no_telepon') }}" name="no_telepon" placeholder="Nomor Telepon" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-phone"></span>
            </div>
        </div>
        @error('no_telepon')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <select class="custom-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
            id="inputGroupSelect04" required>
            <option value="" selected disabled>Pilih Gender...</option>
            <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-venus-mars"></span>
            </div>
        </div>
        @error('jenis_kelamin')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <p class="mb-0">Tanggal lahir</p>
    <div class="input-group mb-3">
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"
            value="{{ old('tanggal_lahir') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-calendar"></span>
            </div>
        </div>
        @error('tanggal_lahir')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat lengkap" id="floatingTextarea">{{ old('alamat') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="col-8">
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
@section('styleJs')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
@endsection
