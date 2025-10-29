<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
    <h1 class="font-bold text-6xl text-gray-800 text-center mb-10">Noctura</h1>

    <div class="bg-white p-8 rounded-xl shadow-lg w-96">
        <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Login</h1>

        @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-3 text-center">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700 font-medium mb-1">Username</label>
            <input type="text" name="username" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-pink-700" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-pink-700" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-pink-700" required>
        </div>
        <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition">Login</button>
        </form>
    </div>

</body>
</html>
