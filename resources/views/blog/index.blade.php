@extends('blog.layout')
@section('title', 'Accueil')

@section('content')

{{-- HERO PRINCIPAL --}}
<section class="relative bg-gradient-to-br from-orange-600 via-yellow-500 to-green-600 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-yellow-200 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-6xl mx-auto px-4 py-24">
        <div class="max-w-3xl">
            <div class="flex items-center gap-2 mb-6">
                <span class="bg-white/20 backdrop-blur px-4 py-1 rounded-full text-sm font-medium">
                    ☀️ Solutions énergétiques pour le Bénin
                </span>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                L'énergie solaire,<br>
                <span class="text-yellow-200">accessible à tous</span>
            </h1>
            <p class="text-xl text-white/90 mb-8 leading-relaxed max-w-2xl">
                Découvrez les dernières actualités, guides pratiques et innovations
                en solutions énergétiques accessibles pour les ménages et entreprises béninois.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#articles"
                   class="bg-white text-orange-600 px-8 py-3 rounded-full font-bold hover:bg-yellow-50 transition shadow-lg">
                    📰 Lire les articles
                </a>
                @guest
                <a href="{{ route('register') }}"
                   class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white/10 transition">
                    🚀 Rejoindre la communauté
                </a>
                @endguest
            </div>
        </div>
    </div>

   {{-- Statistiques --}}
<div class="relative bg-black/20 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center">
            <div>
                <div class="text-3xl font-extrabold text-yellow-200">5.5</div>
                <div class="text-sm text-white/80">kWh/m²/jour</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-yellow-200">&lt;40%</div>
                <div class="text-sm text-white/80">Électrification rurale</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-yellow-200">-80%</div>
                <div class="text-sm text-white/80">Coût solaire en 10 ans</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-yellow-200">60%</div>
                <div class="text-sm text-white/80">Couverture mobile money</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-yellow-200" id="hero-waitlist-count">
                    {{ \App\Models\Waitlist::count() }}
                </div>
                <div class="text-sm text-white/80">en liste d'attente 🚀</div>
            </div>
        </div>
    </div>
</div>

{{-- Script compteur live --}}
<script>
function refreshHeroCounter() {
    fetch('/waitlist/count')
        .then(r => r.json())
        .then(data => {
            const el = document.getElementById('hero-waitlist-count');
            if (el && data.count !== undefined) {
                el.textContent = data.count;
            }
        })
        .catch(() => {});
}
setInterval(refreshHeroCounter, 30000);
</script>

{{-- ARTICLE À LA UNE --}}
@if($featured)
<section class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-orange-500 rounded-full"></div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">⭐ À la une</h2>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300">
        <div class="md:flex">
            <div class="md:w-1/2">
                @if($featured->cover_image)
                    <img src="{{ Storage::url($featured->cover_image) }}"
                         class="w-full h-72 md:h-full object-cover" alt="{{ $featured->title }}">
                @else
                    <div class="w-full h-72 bg-gradient-to-br from-orange-400 to-yellow-400 flex items-center justify-center text-8xl">
                        ☀️
                    </div>
                @endif
            </div>
            <div class="md:w-1/2 p-8 flex flex-col justify-center">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-white mb-4"
                      style="background: {{ $featured->category->color ?? '#F97316' }}">
                    {{ $featured->category->name ?? 'Énergie' }}
                </span>
                <h3 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-3 leading-tight">
                    {{ $featured->title }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 leading-relaxed">
                    {{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 180) }}
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-400 mb-6">
                    <span>✍️ {{ $featured->user->name }}</span>
                    <span>📅 {{ $featured->created_at->format('d/m/Y') }}</span>
                    <span>⏱️ {{ $featured->reading_time }} min</span>
                    <span>👁️ {{ $featured->views }}</span>
                </div>
                <a href="{{ route('blog.show', $featured->slug) }}"
                   class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full font-bold transition w-fit">
                    Lire l'article <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- FILTRES CATÉGORIES --}}
<section id="articles" class="max-w-6xl mx-auto px-4 pb-4">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-orange-500 rounded-full"></div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">📰 Tous les articles</h2>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('blog.index') }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition
                  {{ !request('category') ? 'bg-orange-500 text-white shadow-md' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-orange-400' }}">
            🌍 Tous
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold text-white transition hover:opacity-80
                  {{ request('category') === $cat->slug ? 'ring-2 ring-offset-2 ring-orange-400' : '' }}"
           style="background: {{ $cat->color }}">
            {{ $cat->name }} ({{ $cat->posts_count }})
        </a>
        @endforeach
    </div>
</section>

{{-- RECHERCHE ACTIVE --}}
@if(request('search'))
<div class="max-w-6xl mx-auto px-4 mb-4">
    <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 rounded-xl px-4 py-3 text-sm">
        🔍 Résultats pour : <strong>"{{ request('search') }}"</strong>
        — {{ $posts->total() }} article(s)
        <a href="{{ route('blog.index') }}" class="text-orange-600 hover:underline ml-3 font-medium">✕ Effacer</a>
    </div>
</div>
@endif

{{-- GRILLE ARTICLES --}}
<section class="max-w-6xl mx-auto px-4 pb-16">
    @if($posts->isEmpty())
    <div class="text-center py-20">
        <div class="text-7xl mb-4">☀️</div>
        <p class="text-gray-500 text-xl font-medium">Aucun article trouvé.</p>
        <a href="{{ route('blog.index') }}" class="text-orange-500 hover:underline mt-2 inline-block">
            Voir tous les articles
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
        @foreach($posts as $post)
        <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700">
            <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden h-48">
                @if($post->cover_image)
                    <img src="{{ Storage::url($post->cover_image) }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl"
                         style="background: linear-gradient(135deg, {{ $post->category->color ?? '#F97316' }}33, {{ $post->category->color ?? '#F97316' }}11)">
                        ☀️
                    </div>
                @endif
            </a>
            <div class="p-6">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-white mb-3"
                      style="background: {{ $post->category->color ?? '#F97316' }}">
                    {{ $post->category->name ?? 'Non classé' }}
                </span>
                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-2 group-hover:text-orange-500 transition-colors leading-snug">
                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 leading-relaxed">
                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                </p>
                <div class="flex items-center justify-between text-xs text-gray-400 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <span>📅 {{ $post->created_at->format('d/m/Y') }}</span>
                        <span>⏱️ {{ $post->reading_time }} min</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span>👁️ {{ $post->views }}</span>
                        <span>💬 {{ $post->comments->where('is_approved', true)->count() }}</span>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    <div class="mt-12 flex justify-center">{{ $posts->links() }}</div>
    @endif
</section>

{{-- BLOC CTA --}}
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16 mb-0">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <div class="text-5xl mb-4">⚡</div>
        <h2 class="text-3xl font-extrabold mb-4">Rejoignez notre communauté</h2>
        <p class="text-white/90 text-lg mb-8">
            Recevez les derniers articles sur l'énergie solaire, les subventions disponibles
            et les solutions adaptées au contexte béninois.
        </p>
        @guest
        <a href="{{ route('register') }}"
           class="bg-white text-orange-600 font-bold px-8 py-4 rounded-full hover:bg-yellow-50 transition shadow-lg text-lg">
            Créer mon compte gratuitement →
        </a>
        @endguest
    </div>
</section>

@endsection