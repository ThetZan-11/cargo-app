<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title')</title>
    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="{{ asset('assets/font/google_font.css') }}" rel="stylesheet" />
    <!-- MDB -->
    <link href="{{ asset('assets/MDB5/css/mdb.min.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.dataTables.min.css') }}">
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    @yield('styles')
</head>

<body>
    <div id="loader">
        <dotlottie-player src="https://lottie.host/85e34039-bcb1-480e-8062-f817887c058a/mUcDEXwuot.lottie"
            background="transparent" speed="1" style="width: 300px; height: 300px; margin: auto;" loop autoplay>
        </dotlottie-player>
    </div>
