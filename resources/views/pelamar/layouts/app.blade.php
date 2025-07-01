<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    @include('pelamar.layouts.sidebar')
    <div class="ml-64">
        @include('pelamar.layouts.navbar')
        <div class="p-6">
            @yield('content')
        </div>
    </div>
</body>

</html>
