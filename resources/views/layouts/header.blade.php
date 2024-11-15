<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/logo.png" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="/vendor/jQuery/jquery.min.js"></script>
    {{-- aos --}}
    <link href="/vendor/aos/aos.css" rel="stylesheet">
    <!-- bootstrap -->
    {{-- <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <!-- icons -->
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-icons/bootstrap-icons.css">


    <!-- Template -->
    <link href="/vendor/frontend-ui/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/frontend-ui/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/frontend-ui/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/vendor/frontend-ui/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/vendor/frontend-ui/css/style.css" rel="stylesheet">


    {{-- my styles --}}
    <link rel="stylesheet" href="/css/styles.css">
    {{-- sweetalert --}}
    <script src='/vendor/sweetalert/sweetalert2.all.min.js'></script>

    {{-- fakeloader --}}
    <link rel="stylesheet" href="/vendor/fakeloader/css/demo.css">
    <link rel="stylesheet" href="/vendor/fakeloader/css/fakeLoader.min.css">

    {{-- calendar --}}
    <link rel="stylesheet" href="/vendor/calendar/datepicker.css">

    <!-- live animation -->
    <link rel="stylesheet" href="/vendor/live-animation/animate.compat.css">
    <link rel="stylesheet" href="/vendor/live-animation/animate.css">
    <link rel="stylesheet" href="/vendor/live-animation/animate.min.css">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}

    <style>
        body {
            font-family: "Raleway", sans-serif;
        }

        body h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        button {
            font-family: "Raleway", sans-serif;
        }
    </style>

    @livewireStyles
</head>

{{-- <body oncontextmenu="return false;"> --}}

<body>
