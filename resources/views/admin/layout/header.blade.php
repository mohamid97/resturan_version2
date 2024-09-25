<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CanGrow| Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href=" {{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href=" {{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href=" {{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href=" {{ asset('plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!--  &lt;!&ndash; Bootstrap 4 RTL &ndash;&gt;-->
{{--    <link rel="stylesheet"  href="{{ asset('rtl/rtl.css') }}">--}}
{{--    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">--}}
{{--    <!--  &lt;!&ndash; Custom style for RTL &ndash;&gt;-->--}}
{{--    <link rel="stylesheet" href=" {{ asset('dist/css/custom.css') }} ">--}}

    @yield('styles')

<style>
    #spinner-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
        z-index: 9999; /* Ensure it's on top of everything */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #spinner {
        /* Add styles for your spinner animation */
    }

    .loader {
        color: #17a2b8;
        display: inline-block;
        position: relative;
        font-size: 48px;
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
    }



</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="spinner-overlay">
    <div id="spinner">
        <span class="loader">Loading...</span>
    </div>
</div>
<div class="wrapper">
@include('sweetalert::alert')



