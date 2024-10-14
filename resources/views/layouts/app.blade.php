<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Asset Management')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #f8f9fa;
        }

        .footer-text {
            margin: 15px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Asset Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('/')) active @endif" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('categories*')) active @endif"
                            href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('suppliers*')) active @endif"
                            href="{{ route('suppliers.index') }}">Pemasok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('assets*')) active @endif"
                            href="{{ route('assets.index') }}">Aset</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    {{-- <footer class="footer mt-auto">
        <div class="footer-text">
            <p>&copy; {{ date('Y') }} Asset Management System</p>
        </div>
    </footer> --}}

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
