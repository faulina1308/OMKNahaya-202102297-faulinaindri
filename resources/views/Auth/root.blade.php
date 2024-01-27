<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OMK Nahaya | {{ $judul }}</title>
    @yield('styleCss')
</head>

<body class="hold-transition login-page" style="background-image: url('{{ asset('bg.jpg') }}');background-size: cover;background-position: center;background-attachment: fixed;">
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
    <div class="login-box">
        
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1"><b>OMK</b>Nahaya</p>
            </div>
            <div class="card-body">
                
                @yield('Content')
                <div class="social-auth-links text-center mt-2 mb-3">
                </div>
                <!-- /.social-auth-links -->
                <p class="mb-1">
                </p>
                @if ($judul=='Login')
                    <p class="mb-0">
                        <a href="/register" class="text-center">Register a new membership</a>
                    </p>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
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
