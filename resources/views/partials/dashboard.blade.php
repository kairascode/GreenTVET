<!DOCTYPE html>
<html>
<head>
    <title>Tree Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Tree Monitoring</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('institutions.index') }}">Institutions</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('plantings.index') }}">Plantings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Reports</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>