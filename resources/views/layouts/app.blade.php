<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

  <nav class="bg-gray-800 text-white py-4 px-10 flex justify-between items-center fixed top-0 left-0 right-0 z-10">
    <h1 class="font-bold text-xl cursor-pointer">Noctura</h1>

    <ul class="flex space-x-6">
        <li>
            <a href="{{ route('dashboard') }}" class="hover:bg-gray-700 px-3 py-2 rounded-md duration-300">
               Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('events.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded-md duration-300">
               Manage Events
            </a>
        </li>
    </ul>

    <div class="flex items-center gap-1 cursor-pointer">
        @if (session('is_logged_in'))
            <img src="{{ asset('storage/ui/fluent--person-20-filled.png') }}" alt="User Icon" class="w-6 h-6">
            <span class="text-gray-300 text-lg font-semibold">{{ session('username') }}</span>
            <form id="logout-form" action="{{ route('logout') }}" method="GET">
                @csrf
                <button type="button"
                    onclick="openLogoutModal()"
                    class="bg-white hover:bg-gray-300 text-gray-800 font-semibold px-3 py-1 ml-3 rounded-md duration-300">
                    Logout
                </button>
            </form>
        @else
            <form action="{{ route('login') }}" method="GET">
                @csrf
                <button type="submit"
                    class="bg-white hover:bg-gray-300 text-gray-800 font-semibold px-3 py-1 rounded-md duration-300">
                    Login
                </button>
            </form>
        @endif
    </div>
  </nav>

  <main class="pt-6 px-10">
    <div class="my-16">
        @yield('content')
    </div>
  </main>

  @include('components.logout-modal')

  @yield('scripts')

</body>
</html>
