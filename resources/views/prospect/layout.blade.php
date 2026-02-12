<!DOCTYPE html>
<html>
<head>
    <title>Prospect Registration</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/prospect.css') }}">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center page-title">Prospect Registration</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
