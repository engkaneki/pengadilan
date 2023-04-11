<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dukcapil Hadir di Pengadilan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}img/logo.png">

    <!-- Bootstrap Css -->
    <link href="{{ asset('/') }}assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/') }}assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="bg-white">

    <div class="auth-page d-flex align-items-center min-vh-100">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="d-flex flex-column h-100 py-5 px-4">
                        <div class="text-center text-muted mb-2">
                            <div class="pb-3">
                                <a href="index.html">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/') }}img/logo.png" alt="" height="24"> <span
                                            class="logo-txt">DUKCAPIL HADIR DI PENGADILAN</span>
                                    </span>
                                </a>
                                {{-- <p class="text-muted font-size-10 w-75 mx-auto mt-3 mb-0">DINAS KEPENDUDUKAN DAN
                                    PENCATATAN SIPIL KAB. BATU BARA</p> --}}
                            </div>
                        </div>

                        <div class="my-auto">
                            <div class="p-3 text-center">
                                <img src="{{ asset('/') }}assets/images/auth-img.png" alt=""
                                    class="img-fluid">
                            </div>
                        </div>

                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> DUKCAPIL KAB. BATU BARA
                            </p>
                        </div>
                    </div>

                    <!-- end auth full page content -->
                </div>
                <!-- end col -->

                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                        <div class="bg-overlay-gradient"></div>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center g-0 align-items-center w-100">
                            <div class="col-xl-4 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="px-3 py-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">Selamat Datang</h5>
                                                <p class="text-muted mt-2">Silahkan login ke halaman pelayanan</p>
                                            </div>
                                            <form class="mt-4 pt-2" action="{{ url('login/proses') }}" method="post">
                                                @csrf
                                                <div class="form-floating form-floating-custom mb-3">
                                                    <input type="text" class="form-control" id="input-username"
                                                        placeholder="Enter User Name" name="username">
                                                    <label for="input-username">Username</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-users-alt"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                    <input type="password" class="form-control" id="password-input"
                                                        placeholder="Enter Password" name="password">
                                                    <button type="button"
                                                        class="btn btn-link position-absolute h-100 end-0 top-0"
                                                        id="password-addon">
                                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                    </button>
                                                    <label for="password-input">Password</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-padlock"></i>
                                                    </div>
                                                </div>

                                                <div class="mt-3">
                                                    <button class="btn btn-success w-100" type="submit">Log In</button>
                                                </div>

                                            </form><!-- end form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
    <!-- end authentication section -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('/') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/feather-icons/feather.min.js"></script>

    <script src="{{ asset('/') }}assets/js/pages/pass-addon.init.js"></script>

</body>

</html>
