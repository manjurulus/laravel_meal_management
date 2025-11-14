<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meal Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            {{-- ✅ Sidebar --}}
            @auth
                @include('layouts.sidebar')
            @endauth

            {{-- ✅ Main content --}}
            <main class="{{ auth()->check() ? 'col-md-9 ms-sm-auto col-lg-10 px-md-4' : 'col-12 px-4' }}">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>