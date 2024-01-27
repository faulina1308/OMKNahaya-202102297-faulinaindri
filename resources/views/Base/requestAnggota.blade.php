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
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="text-left">
                        <tr>
                            <tr>
                                <th class="pr-3">No</th>
                                <th class="pr-3">Nama</th>
                                <th class="pr-3">Email</th>
                                <th class="pr-3">Stasi</th>
                                <th class="pr-3">Action</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        @foreach ($dataUser as $item)
                            <tr>
                                <td class="pr-3">{{ $loop->iteration }}</td>
                                <td class="pr-3">{{ $item->nama }}</td>
                                <td class="pr-3">{{ $item->email }}</td>
                                <td class="pr-3">{{ $item->stasi->nama_stasi }}</td>
                                <td class="pr-3">
                                    <form action="/aktif-akun" method="POST">
                                        @csrf
                                        <input type="hidden" name="idUser" value="{{ $item->id }}">
                                        <button class="btn btn-success">Aktivasi</button>
                                    </form>
                                    <form action="/tolak-akun" class="mt-1" method="POST">
                                        @csrf
                                        <input type="hidden" name="idUser" value="{{ $item->id }}">
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
         @else
            <p>Tidak ada request aktivasi akun</p>
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