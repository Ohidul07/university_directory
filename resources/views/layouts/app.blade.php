<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Argon Dashboard
  </title>
  <!-- Favicon -->
  <link href="{{ url('assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ url('assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
  <link href="{{ url('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <!-- bootstrap -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
  <!-- CSS Files -->
  <link href="{{ url('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ url('assets/vendor/animate.css/animate.min.css') }}">
  <!-- custom css -->
  <link href="{{ url('css/style.css') }}" rel="stylesheet" />

  @yield('css')

</head>

<body class="">

  <!-- navbar mobile & sidebar  -->
     @include('layouts.navbar-mobile')
  <!-- navbar mobile & sidebar end -->

  <div class="main-content">

    <!-- Navbar -->
        @include('layouts.navbar')
    <!-- End Navbar -->

    <!-- Header -->
        @include('layouts.header')
    <!-- Header end-->

    <!-- content -->
        @include('layouts.content')
    <!-- content end -->
    
  </div>
  <!--   Core   -->
  <script src="{{ url('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--   Argon JS   -->
  <script src="{{ url('assets/js/argon-dashboard.min.js') }}"></script>
  <script src="{{ url('js/script.js') }}"></script>
  <script src="{{ url('assets/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  @yield('script')
</body>

</html>