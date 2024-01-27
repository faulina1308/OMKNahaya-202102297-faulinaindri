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
        @if (count($dataUser)>0)
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped w-400">
                <thead class="text-left">
                    <tr>
                        <th class="pr-3">No</th>
                        <th class="pr-3">Nama</th>
                        <th class="pr-3">Stasi</th>
                        <th class="pr-3">Peran</th>
                        <th class="pr-3">Bergabung</th>
                        <th class="pr-3">Gender</th>
                        <th class="pr-3">Tanggal Lahir</th>
                        <th class="pr-3">Alamat</th>
                        <th class="pr-3">Kontak</th>
                        <th class="pr-3">Email</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    @foreach ($dataUser as $item)
                    <tr>
                        <td class="pr-3">{{ $loop->iteration }}</td>
                        <td class="pr-3">
                            <div class="row">
                                <div class="col-md-9">
                                    {{ $item->nama }}
                                </div>
                                <div class="col-md-2 pr-1">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#anggotaModal{{ $item->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                    <div class="modal fade"
                                        id="anggotaModal{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <!-- Widget: user widget style 1 -->
                                                        <div class="card card-widget widget-user">
                                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                                            <div class="widget-user-header bg-info">
                                                                <h3 class="widget-user-username">{{ $item->nama }}</h3>
                                                                <h5 class="widget-user-desc">{{ $item->peran }}</h5>
                                                            </div>
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="../dist/img/user1-128x128.jpg"
                                                                    alt="User Avatar">
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-4 border-right">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header">{{ $item->partisipasi }}</h5>
                                                                            <span class="description-text">Ikuti Kegitatan</span>
                                                                        </div>
                                                                        <!-- /.description-block -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                    <div class="col-sm-4 border-right">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header">{{ $item->stasi->nama_stasi }}</h5>
                                                                            <span
                                                                                class="description-text">Asal Stasi</span>
                                                                        </div>
                                                                        <!-- /.description-block -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                    <div class="col-sm-4">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header">{{ $item->keanggotaan }}</h5>
                                                                            <span
                                                                                class="description-text">Keanggotaan</span>
                                                                        </div>
                                                                        <!-- /.description-block -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                </div>
                                                                <!-- /.row -->
                                                            </div>
                                                        </div>
                                                        <!-- /.widget-user -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                        <form action="/update-peran" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="idUser" value="{{ $item->id }}">
                                                            <input type="hidden" name="peran" value="{{ $item->peran }}">
                                                            @if ($item->peran==='Anggota')
                                                                <button type="submit" class="btn btn-primary">Jadikan Ketua</button>
                                                            @endif
                                                            @if ($item->peran==='KetuaStasi')
                                                                <button type="submit" class="btn btn-primary">Jadikan Anggota</button>
                                                            @endif
                                                        </form>
                                                        <form action="/hapus-user" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="idUser" value="{{ $item->id }}">
                                                            <button type="submit" class="btn btn-danger ml-2">Hapus</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pr-3">{{ $item->stasi->nama_stasi }}</td>
                        <td class="pr-3">{{ $item->peran }}</td>
                        <td class="pr-3">{{ $item->tanggal_bergabung }}</td>
                        <td class="pr-3">{{ $item->jenis_kelamin }}</td>
                        <td class="pr-3">{{ $item->tanggal_lahir }}</td>
                        <td class="pr-3">{{ $item->alamat }}</td>
                        <td class="pr-3">{{ $item->no_telepon }}</td>
                        <td class="pr-3">{{ $item->email }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Ketua stasi aktif belum tersedia</p>
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

<script>
    $(function () {
        $("#example1").DataTable();
    });

</script>
@endsection
