<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Monitoring System - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        @media (max-width: 991px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar col-lg-2 col-md-3 d-none d-md-block p-3">
            <h5 class="mb-3">Tree Monitoring</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('institutions.index') }}">Institutions</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('species.index') }}">Tree Species</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('plantings.index') }}">Plantings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('allocations.index') }}">Allocations</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('plantings.map') }}">Map</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Reports</a></li>
                <li class="nav-item">
                             <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-danger p-0">Logout</button>
                            </form>
                </li>  
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar for Mobile -->
            <nav class="navbar navbar-expand-md navbar-light bg-light d-md-none">
                <a class="navbar-brand" href="{{ route('dashboard') }}">Tree Monitoring</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('institutions.index') }}">Institutions</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('species.index') }}">Tree Species</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('plantings.index') }}">Plantings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('allocations.index') }}">Allocations</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('plantings.map') }}">Map</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Reports</a></li>
                        <li class="nav-item">
                             <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-danger p-0">Logout</button>
                            </form>
                        </li>  
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
