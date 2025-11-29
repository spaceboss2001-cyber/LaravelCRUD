<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CarDealer @yield('title')</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50">
    <nav class="relative border-b bg-white" x-data="{ open:false }">
        <div class="flex items-center justify-between px-4 py-3">

            <a href="{{ route('home') }}">
                <img class="w-16 h-16" src="/images/logo.svg" />
            </a>

            <button class="md:hidden" @click="open = !open">
                <svg class="w-7 h-7" fill="none" stroke="black" stroke-width="2" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <ul class="hidden md:flex gap-3 text-black font-base">

                @if (Route::has('login'))
                    @auth
                        <li class="px-5 py-1.5 bg-amber-100 hover:bg-white border rounded-sm text-sm">
                            <a href="{{ route('cars') }}">Cars</a>
                        </li>

                        <li class="px-5 py-1.5 bg-amber-100 hover:bg-white border rounded-sm text-sm">
                            <a href="{{ route('carparts.index') }}">Carparts</a>
                        </li>

                        <li class="px-5 py-1.5 bg-amber-100 hover:bg-white border rounded-sm text-sm">
                            <a href="{{ route('reservation') }}">Reserveren</a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="px-5 py-1.5 bg-amber-100 hover:bg-white border rounded-sm text-sm">
                                    Logout
                                </button>
                            </form>
                        </li>

                    @else
                        <li class="px-5 py-1.5 bg-amber-100 hover:bg-white border rounded-sm text-sm">
                            <a href="{{ route('login') }}">Log in</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="px-5 py-1.5 bg-amber-100 hover:bg-white border rounded-sm text-sm">
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>

        <div class="md:hidden" x-show="open" x-transition>
            <ul class="px-4 pb-3 flex flex-col gap-2 text-black font-base">

                @if (Route::has('login'))
                    @auth
                        <li class="px-4 py-2 bg-amber-100 border rounded-sm">
                            <a href="{{ route('cars') }}">cars</a>
                        </li>

                        <li class="px-4 py-2 bg-amber-100 border rounded-sm">
                            <a href="{{ route('carparts.index') }}">carparts</a>
                        </li>

                        <li class="px-4 py-2 bg-amber-100 border rounded-sm">
                            <a href="{{ route('reservation') }}">Reserveren</a>
                        </li>

                        <li class="px-4 py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full px-4 py-2 bg-amber-100 border rounded-sm">Logout</button>
                            </form>
                        </li>

                    @else
                        <li class="px-4 py-2 bg-amber-100 border rounded-sm">
                            <a href="{{ route('login') }}">Log in</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="px-4 py-2 bg-amber-100 border rounded-sm">
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <main class="py-6 px-4 md:px-8 lg:px-16">
        @yield('content')
    </main>

    <footer class="bg-white shadow p-4 text-center">
        &copy; 2025 CarDealer
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>

</html>

