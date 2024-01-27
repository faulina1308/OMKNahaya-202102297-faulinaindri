@extends('Auth.root')
@section('styleCss')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection
@section('Content')
<p class="login-box-msg">Register a new membership</p>

<form action="/register" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Full name" value="{{ old('nama') }}" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <select class="custom-select @error('stasi_id') is-invalid @enderror" name="stasi_id" id="inputGroupSelect04" required>
            <option value="" selected disabled>Pilih Stasi...</option>
            @foreach ($daftarStasi as $item)
                <option value="{{ $item->id }}" {{ (old('stasi_id') == $item->id) ? 'selected' : '' }}>{{ $item->nama_stasi }}</option>
            @endforeach
          </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-map-marker"></span>
            </div>
        </div>
        @error('stasi_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Retype password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="col-8">
            Already have account? <a href="/" class="text-center">Login</a>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
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
