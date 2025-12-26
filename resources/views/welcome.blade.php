<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>School Violations System</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <main class="bg-dark min-vh-100 w-100">
        <div class="d-flex justify-content-center align-items-center min-vh-100 w-auto">
            <span class="text-white">
                School Violations System
            </span>
        </div>
    </main>
</body>

</html>