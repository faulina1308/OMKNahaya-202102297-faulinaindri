<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OMK Nahaya | {{ $judul }}</title>
    @yield('styleCss')
    <link rel="stylesheet" href="{{ asset('/custom/style.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="m-3" aria-live="polite" aria-atomic="true" style="position: fixed; top: 0; right: 0; z-index: 9999; width: 300px">
            @if (session()->has('success'))
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-header bg-primary text-white">
                        <strong class="mr-auto">Berhasil</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-header bg-danger text-white">
                        <strong class="mr-auto">Gagal</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>
       
        <!-- Top bar -->
        @include('Partial.topbar')
        <!-- End Top bar -->
        <!-- Main Sidebar Container -->
        @include('Partial.sidebar')
        <!-- End Main Sidebar Container -->
        <div class="content-wrapper">
            <!-- Content -->
            @yield('Content')
            <!-- End Content -->
        </div>
        <!-- Footer -->
        @include('Partial.footer')
        <!-- End Footer -->
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @yield('styleJs')
    <script>
        var toastEl = document.querySelector('.toast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
        setTimeout(function() {
            var toast = new bootstrap.Toast(toastEl);
            toast.hide();
        }, 7000);
    </script>
</body>

</html>
