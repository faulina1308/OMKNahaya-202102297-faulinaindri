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
        <div class="row">

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Nama</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0 text-14">{{ $user->nama }}</p>
                            </div>
                            <div class="col-sm-1">
                                <a href="#" data-toggle="modal" data-target="#exampleModalLong">
                                    <p class="text-muted mb-0 text-14"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i></p>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Stasi</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $user->stasi->nama_stasi }}
                                    <small>({{ $user->peran }})</small></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Gender</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $user->jenis_kelamin }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Tanggal Lahir</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $user->tanggal_lahir }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Telepon</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $user->no_telepon }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Alamat</p>
                            </div>
                            <div class="col-sm-8">
                                @if ($user->alamat)
                                <p class="text-muted mb-0 text-14">{{ $user->alamat }}</p>
                                @else
                                <p class="text-muted mb-0 text-14">-</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Tanggal Bergabung</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $user->tanggal_bergabung }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/update-profil" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil {{ $user->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="idUser" value="{{ $user->id }}">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Nama Lengkap" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                             value="{{ $user->tanggal_lahir }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea required class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">{{ $user->alamat }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
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
