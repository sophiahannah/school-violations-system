<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('PUPLogo 1 Login.png') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        @include('layouts.admin.sidebar')

        <main class="w-100">
            {{-- Navbar --}}
            @include('layouts.admin.navbar')

            {{-- Main content --}}
            @yield('content')
        </main>

    </div>
</body>

</html>