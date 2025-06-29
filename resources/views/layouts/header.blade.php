<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Stock Management')</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 70px; /* So footer doesn't overlap */
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container d-flex justify-content-between">
        <div>
            <a class="navbar-brand me-3" href="#">SABSJS IT StockManagement</a>
            <a class="btn btn-light btn-sm" href="{{ route('dashboard') }}">🏠 Home</a>
        </div>

        <div class="d-flex">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="ms-2">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
