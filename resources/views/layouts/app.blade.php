<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="auto">
<head>

    <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Estilos personalizados -->
<style>
    .text-primary {
        color: #4B49AC !important;
    }
    .btn-primary {
        background-color: #4B49AC;
        border-color: #3F3D8F;
    }
    .btn-primary:hover {
        background-color: #3F3D8F;
        border-color: #343276;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white !important;
    }
    .card-border-danger {
        border: 1px solid rgba(220, 53, 69, 0.3);
    }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KUBICO')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/lightgallery.js/dist/css/lightgallery.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Modern CSS Loading -->
    <!-- Bootstrap 5.3.3 with SRI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    
    <!-- LightGallery Modern CSS -->
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery-bundle.min.css" 
          integrity="sha256-5QO5f1JREyfcqYIeQQK4Ov3U3Zq/2W7EZ7N6WrW+2MI=" 
          crossorigin="anonymous">
    
    <!-- Custom CSS with versioning -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('partials.navbar')

    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Modern Script Loading -->
    <!-- Bootstrap 5.3.3 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous" defer></script>
    
    <!-- LightGallery Modern ES Module -->
    <script type="module">
        import lightGallery from 'https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.es5.min.js'
        window.lightGallery = lightGallery
    </script>

    <!-- Custom JS with lazy loading -->
    <script src="{{ asset('js/app.js') }}" 
            type="module" 
            defer 
            crossorigin="anonymous"></script>

            <script src="https://cdn.jsdelivr.net/npm/lightgallery.js/dist/js/lightgallery.min.js"></script>
</body>
</html>