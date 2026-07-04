<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <title>{{ $setting->app_name }} || {{ $title }}</title>
    <meta content="{{ $setting->description }}" name="description">
    <meta content="{{ $setting->keywords }}" name="keywords">
    <meta content="Fadli Gunawan" name="author">

    <!-- Favicons -->
    <link href="{{ $setting->avatar ? asset('storage/' . $setting->avatar) : asset('NiceAdmin/img/Logo.png') }}"
        rel="icon">
    <link href="{{ $setting->avatar ? asset('storage/' . $setting->avatar) : asset('NiceAdmin/img/Logo.png') }}"
        rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('NiceAdmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

    <!-- add on -->
    <link rel="stylesheet" href="{{ asset('NiceAdmin/vendor/dataTables/css/dataTables.bootstrap5.css') }}">
    <link href="{{ asset('NiceAdmin/vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/vendor/select2/css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('NiceAdmin/css/style.css') }}" rel="stylesheet">

    <style>
        label.required::after {
            content: " *";
            color: red;
            font-weight: bold;
        }

        table.dataTable thead th {
            background-color: #0d6efd !important;
            color: white !important;
            text-align: center !important;
        }

        #data-table td {
            text-align: center;
            vertical-align: middle;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        #main {
            flex: 1;
        }

        .footer {
            text-align: center !important;
            padding: 15px 0;
            background: #fff;
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ $setting->avatar ? asset('storage/' . $setting->avatar) : asset('NiceAdmin/img/Logo.png') }}"
                                        alt="">
                                    <span class="d-none d-lg-block">{{ $setting->App_name }}</span>
                                </a>
                            </div><!-- End Logo -->

                            {{ $slot }}

                            <div class="credits">
                                {{ $setting->copyright }}
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- add on -->
    <script src="{{ asset('NiceAdmin/vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/sweetalert2/sweetalert2@11') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/dataTables/js/dataTables.js') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/dataTables/js/dataTables.bootstrap5.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('NiceAdmin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/vendor/select2/js/select2.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('NiceAdmin/js/main.js') }}"></script>

    <script>
        let flashSuccess = "{{ session('success') ?? '' }}";
        if (flashSuccess) {
            Swal.fire({
                title: "Mantap!",
                text: flashSuccess,
                icon: "success",
                timer: 3000,
                showConfirmButton: false,
            });
        }

        let flashError = "{{ session('error') ?? '' }}";
        if (flashError) {
            Swal.fire({
                icon: "error",
                title: "Waduh...",
                text: flashError,
            });
        }
    </script>

    @stack('scripts')

</body>

</html>
