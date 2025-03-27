<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ app()->getLocale() }}">

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
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.dataTables.min.css') }}">
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Jquery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    @yield('styles')
</head>

<body>
