<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — EDL Bénin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen transition-colors duration-300">
<div class="flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 dark:bg-gray-950 min-h-screen p-6 fixed flex flex-col">

        {{-- Logo --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 bg-gradient-to-br from-orange-500 to-yellow-400 rounded-xl flex items-center justify-center">
                    <span class="text-lg">☀️</span>
                </div>
                <div>
                    <div class="text-white font-extrabold leading-none">EDL Admin</div>
                    <div class="text-xs text-gray-500 leading-none">Énergie Pour le Bénin</div>
                </div>
            </div>
            <button onclick="toggleDarkMode()" id="dark-mode-btn"
                    class="text-xl hover:scale-110 transition-transform">🌙</button>
        </div>

        {{-- Navigation --}}
        <nav class="space-y-1 flex-1">

            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 mb-2">Navigation</p>

            <a href="{{ route('blog.index') }}"
               class="flex items-center gap-3 text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2.5 rounded-xl transition">
                🌍 Voir le blog
            </a>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 text-gray-300 hover:text-white hover:bg-orange-600 px-4 py-2.5 rounded-xl transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-orange-600 text-white' : '' }}">
                📊 Dashboard
            </a>

            <hr class="border-gray-800 my-3">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 mb-2">Contenu</p>

            <a href="{{ route('admin.posts.index') }}"
               class="flex items-center gap-3 text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2.5 rounded-xl transition
                      {{ request()->routeIs('admin.posts.*') ? 'bg-gray-700 text-white' : '' }}">
                📰 Articles
            </a>

            <a href="{{ route('admin.posts.create') }}"
               class="flex items-center gap-3 text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2.5 rounded-xl transition">
                ✏️ Nouvel article
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2.5 rounded-xl transition
                      {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 text-white' : '' }}">
                🏷️ Catégories
            </a>

            <hr class="border-gray-800 my-3">
        </nav>

        {{-- Utilisateur connecté + déconnexion --}}
        <div class="mt-auto">
            <div class="bg-gray-800 rounded-xl p-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-orange-500 to-yellow-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-white text-sm font-semibold truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-gray-400 text-xs truncate">{{ auth()->user()->email ?? '' }}</div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center gap-3 text-red-400 hover:text-white hover:bg-red-700 px-4 py-2.5 rounded-xl transition w-full text-left">
                    🚪 Déconnexion
                </button>
            </form>
        </div>

    </aside>

    {{-- CONTENU PRINCIPAL --}}
    <main class="ml-64 flex-1 p-8 min-h-screen">

        {{-- Barre du haut --}}
        <div class="flex items-center justify-between mb-8">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                📅 {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
            </div>
            <a href="{{ route('admin.posts.create') }}"
               class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full text-sm font-semibold transition shadow">
                ✏️ Nouvel article
            </a>
        </div>

        {{-- Message succès --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</div>
</body>
</html>