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
                <div class="col-md-3 col-lg-2 bg-light min-vh-100">
                    @include('layouts.sidebar')
                </div>
            @endauth

            {{-- ✅ Main content --}}
            <div class="{{ auth()->check() ? 'col-md-9 col-lg-10 px-md-4' : 'col-12 px-4' }}">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>