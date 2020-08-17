<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ url('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/ionicons/css/ionicons.min.css') }}">

    <!-- Addon CSS -->
    <link rel="stylesheet" href="{{ url('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    @yield('addon-css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
    <script src="{{ url('assets/js/page/modules-ion-icons.js') }}"></script>

</head>