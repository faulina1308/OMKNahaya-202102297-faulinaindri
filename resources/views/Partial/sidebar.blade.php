<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">OMK Nahaya</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $user->nama }}</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{($judul==='Dashboard')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user-teraktif" class="nav-link {{($judul==='Anggota Teraktif')?'active ':''}}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Anggota Teraktif
                        </p>
                    </a>
                </li>
                @cannot('Anggota')
                    <li class="nav-item {{($judul==='Anggota')?'menu-open':''}}">
                        <a href="#" class="nav-link {{($judul==='Anggota')?'active':''}}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Anggota OMK
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/request-anggota-baru" class="nav-link {{($page==='Aktivasi Anggota Baru')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Request Aktivasi</p>
                                </a>
                            </li>
                            @can('KetuaOMK')
                            <li class="nav-item">
                                <a href="/semua-ketua-stasi" class="nav-link {{($page==='Semua Ketua Stasi')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Ketua Stasi</p>
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a href="/semua-anggota-omk" class="nav-link {{($page==='Semua Anggota OMK')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Anggota OMK</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @can('KetuaOMK')
                    <li class="nav-item {{($judul==='Stasi')?'menu-open':''}}">
                        <a href="#" class="nav-link {{($judul==='Stasi')?'active':''}}">
                            <i class="nav-icon fa fa-map-marker"></i>
                            <p>
                                Stasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/stasi-view" class="nav-link {{($page==='List Stasi')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Stasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    <li class="nav-item {{($judul==='Kegiatan')?'menu-open':''}}">
                        <a href="#" class="nav-link {{($judul==='Kegiatan')?'active':''}}">
                            <i class="nav-icon fa fa-calendar"></i>
                            <p>
                                Kegiatan OMK
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/kegiatan-omk" class="nav-link {{($page==='List Kegiatan'||$page==='Edit Kegiatan')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Kegiatan</p>
                                </a>
                            </li>
                            @can('KetuaOMK')
                            <li class="nav-item">
                                <a href="/kegiatan-omk-add" class="nav-link {{($page==='Tambah Kegiatan')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Kegiatan</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcannot
                @cannot('Anggota')
                <li class="nav-item">
                    <a href="/absensi-kegiatan" class="nav-link {{($judul==='Absensi')?'active':''}}">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Absensi Kegiatan
                        </p>
                    </a>
                </li>
                @endcannot
                @can('Anggota')
                <li class="nav-item {{($judul==='Kegiatan')?'menu-open':''}}">
                    <a href="#" class="nav-link {{($judul==='Kegiatan')?'active':''}}">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Kegiatan OMK
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pendaftaran-kegiatan" class="nav-link {{($page==='Pendaftaran Kegiatan')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sedang-berlangsung" class="nav-link {{($page==='Kegiatan Sedang Berlangsung')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sedang Berlangsung</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="nav-item {{($judul==='Riwayat')?'menu-open':''}}">
                    <a href="#" class="nav-link {{($judul==='Riwayat')?'active':''}}">
                        <i class="nav-icon fa fa-clock-o"></i>
                        <p>
                            Riwayat Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/riwayat-kegiatan-selesai" class="nav-link {{($page==='Riwayat Kegiatan Selesai')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Selesai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/riwayat-kegiatan-dibatalkan" class="nav-link {{($page==='Riwayat Kegiatan Dibatalkan')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dibatalkan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
