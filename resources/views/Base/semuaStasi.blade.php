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
        <div class="d-flex justify-content-end ">
            <a class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahStasi">Tambah Stasi</a>
        </div>
        @if (count($dataStasi)>0)
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="text-left">
                    <tr>
                        <th class="pr-3">No</th>
                        <th class="pr-3">Nama Stasi</th>
                        <th class="pr-3">Jumlah Anggota</th>
                        <th class="pr-3">Ketua Stasi Saat ini</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    @foreach ($dataStasi as $item)
                    <tr>
                        <td class="pr-3">{{ $loop->iteration }}</td>
                        <td class="pr-3">
                            {{ $item->nama_stasi }}
                            &nbsp; &nbsp;
                            <a href="#" data-toggle="modal" data-target="#editStasi{{ $item->id }}">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                        </td>
                        <td class="pr-3">
                            {{ $item->user_count }}
                        </td>
                        <td class="pr-3">
                            @foreach ($ketuaStasi as $ketua)
                            @if ($item->id===$ketua->stasi_id)
                            {{ $ketua->nama }}
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <div class="modal fade" id="editStasi{{ $item->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="/edit-stasi/{{$item->slug}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Stasi {{ $item->nama_stasi }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="judul">Nama Stasi</label>
                                            <input type="text" name="nama_stasi" class="form-control @error('nama_stasi') is-invalid @enderror" id="nama_stasi" placeholder="Nama Stasi" autofocus required value="{{ $item->nama_stasi }}">
                                            @error('nama_stasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="Submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Belum ada stasi ditambahkan</p>
        @endif
    </div>
</div>
<div class="modal fade" id="tambahStasi" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/tambah-stasi" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Stasi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Nama Stasi</label>
                        <input type="text" name="nama_stasi" class="form-control @error('nama_stasi') is-invalid @enderror" id="nama_stasi" placeholder="Nama Stasi" autofocus required value="{{ old('nama_stasi') }}">
                        @error('nama_stasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Tambah</button>
                </div>
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
