<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    @vite('resources/css/app.css') {{-- Include Tailwind CSS --}}
</head>
<body class="bg-gradient-to-br from-blue-100 to-white h-screen flex items-center justify-center">

    <div class="text-center space-y-6">
        <h1 class="text-5xl font-bold text-gray-800">Selamat Datang</h1>
        <p class="text-lg text-gray-600">Silakan login atau buat akun baru untuk melanjutkan</p>

        <div class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">Register</a>
            @endauth
        </div>
    </div>

</body>
</html>
