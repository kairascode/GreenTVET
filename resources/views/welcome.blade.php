<head>
    <title>Tree Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to the Tree Monitoring System</h1>
        <p>Track and manage tree planting and allocation for TVET institutions.</p>
        @if (auth()->check())
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        @endif
    </div>
</body>
</html>