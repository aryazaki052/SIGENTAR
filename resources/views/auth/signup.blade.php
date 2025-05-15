<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" action="{{ route('signup') }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h1 class="text-2xl font-bold mb-4">Sign Up</h1>

        @if ($errors->any())
        <div class="mb-4 text-red-500 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <input type="text" name="name" placeholder="Nama Lengkap" class="w-full p-2 border rounded mb-2"
            value="{{ old('name') }}" required>

        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded mb-2"
            value="{{ old('email') }}" required>

        <input type="text" name="token" placeholder="Masukan Token" class="w-full p-2 border rounded mb-2" required>

        <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded mb-2" required>

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
            class="w-full p-2 border rounded mb-4" required>

        <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">
            Daftar
        </button>

        <p class="mt-4 text-sm text-center">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>
    </form>
</body>

</html>
