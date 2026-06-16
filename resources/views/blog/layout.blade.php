<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EDL') — Énergie Pour le Bénin</title>
    <meta name="description" content="@yield('description', 'Solutions énergétiques accessibles pour le Bénin : solaire, kits, guides et actualités.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">

@include('partials.scroll-features')

{{-- NAVBAR --}}
<nav class="sticky top-0 z-40 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-orange-100 dark:border-gray-700 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">

        {{-- Logo --}}
        <a href="{{ route('blog.index') }}" class="flex items-center gap-2 shrink-0">
            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-yellow-400 rounded-xl flex items-center justify-center shadow">
                <span class="text-xl">☀️</span>
            </div>
            <div>
                <div class="text-lg font-extrabold text-orange-600 leading-none">EDL</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 leading-none">Énergie Pour le Bénin</div>
            </div>
        </a>

        {{-- Lien plateforme --}}
        <a href="{{ route('blog.about') }}"
           class="hidden md:block text-sm text-gray-600 dark:text-gray-300 hover:text-orange-500 font-medium transition whitespace-nowrap">
            🚀 La plateforme
        </a>

        {{-- Recherche --}}
        <form method="GET" action="{{ route('blog.index') }}" class="hidden md:flex flex-1 max-w-sm">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher un article..."
                       class="w-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 rounded-full px-4 py-2 text-sm focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-300">
                <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-orange-500">🔍</button>
            </div>
        </form>

        {{-- Menu droit --}}
        <div class="flex items-center gap-3">

            <button onclick="toggleDarkMode()" id="dark-mode-btn"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-orange-100 transition text-lg"
                    title="Changer le thème">🌙</button>

            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition font-semibold shadow">
                        ⚙️ Admin
                    </a>
                @else
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-full flex items-center justify-center text-white font-bold text-xs shadow">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden md:block text-sm text-gray-700 dark:text-gray-300 font-medium">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="text-xs text-red-400 hover:text-red-600 transition font-medium">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 dark:text-gray-300 hover:text-orange-500 font-medium transition">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="text-sm bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition font-semibold shadow">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- CONTENU --}}
<main>
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 mt-4" id="flash-message">
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl border border-green-200 flex items-center justify-between">
                <span>✅ {{ session('success') }}</span>
                <button onclick="document.getElementById('flash-message').remove()"
                        class="text-green-500 hover:text-green-700 ml-4 text-lg font-bold">×</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl border border-red-200">
                ❌ {{ session('error') }}
            </div>
        </div>
    @endif
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-gray-900 text-gray-400">
    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-8">

            {{-- À propos --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-yellow-400 rounded-xl flex items-center justify-center">
                        <span class="text-xl">☀️</span>
                    </div>
                    <div>
                        <div class="text-white font-bold text-lg leading-none">EDL</div>
                        <div class="text-xs text-gray-500 leading-none">Énergie Pour le Bénin</div>
                    </div>
                </div>
                <p class="text-sm leading-relaxed">
                    Votre source d'information sur les solutions énergétiques accessibles
                    pour les ménages et entreprises du Bénin.
                </p>
                <div class="flex gap-3 mt-4 flex-wrap">
                    <span class="text-xs bg-orange-900/40 text-orange-400 px-3 py-1 rounded-full">☀️ Solaire</span>
                    <span class="text-xs bg-green-900/40 text-green-400 px-3 py-1 rounded-full">🌍 Bénin</span>
                    <span class="text-xs bg-yellow-900/40 text-yellow-400 px-3 py-1 rounded-full">⚡ PAYG</span>
                </div>
                <a href="{{ route('blog.about') }}"
                   class="inline-block mt-4 text-sm text-orange-400 hover:text-orange-300 transition">
                    En savoir plus sur la plateforme →
                </a>
            </div>

            {{-- Thématiques --}}
            <div>
                <h3 class="text-white font-semibold mb-4">🏷️ Thématiques</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(\App\Models\Category::withCount('posts')->get() as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                       class="text-xs px-3 py-1 rounded-full text-white hover:opacity-80 transition font-medium"
                       style="background: {{ $cat->color }}">
                        {{ $cat->name }} ({{ $cat->posts_count }})
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center gap-2 text-sm">
            <span>© {{ date('Y') }} EDL — Plateforme de Solutions Énergétiques pour le Bénin</span>
            <span>Fait avec ❤️ — EPAC / GIT 2025-2026</span>
        </div>
    </div>
</footer>

</body>
</html>