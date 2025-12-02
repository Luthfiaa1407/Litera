<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-6 rounded shadow w-96">
        <h1 class="text-xl font-bold mb-4">Lupa Password</h1>

        @if (session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" required class="w-full border rounded px-3 py-2 mb-4">

            <button class="w-full bg-blue-600 text-white py-2 rounded">
                Kirim OTP
            </button>
        </form>
    </div>

</body>

</html>
