@extends('blog.layout')
@section('title', $post->title)
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('blog.index') }}" class="hover:text-blue-500">Accueil</a>
        <span class="mx-2">›</span>
        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
           class="hover:text-blue-500">{{ $post->category->name }}</a>
        <span class="mx-2">›</span>
        <span class="text-gray-600 dark:text-gray-300">{{ Str::limit($post->title, 50) }}</span>
    </nav>

    {{-- En-tête article --}}
    <header class="mb-8">
        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold text-white mb-4"
              style="background: {{ $post->category->color ?? '#3B82F6' }}">
            {{ $post->category->name }}
        </span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
            {{ $post->title }}
        </h1>
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
            <span>✍️ {{ $post->user->name }}</span>
            <span>📅 {{ $post->created_at->format('d M Y') }}</span>
            <span>👁️ {{ $post->views }} vues</span>
            <span>⏱️ {{ $post->reading_time }} min de lecture</span>
            <span>💬 {{ $post->comments->where('is_approved',true)->count() }} commentaire(s)</span>
        </div>
    </header>

    {{-- Image de couverture --}}
    @if($post->cover_image)
    <div class="mb-8 rounded-2xl overflow-hidden shadow-lg">
        <img src="{{ Storage::url($post->cover_image) }}"
             class="w-full max-h-96 object-cover" alt="{{ $post->title }}">
    </div>
    @endif

    {{-- Vidéo YouTube/Vimeo --}}
    @if($post->getVideoEmbedUrl())
    <div class="mb-8 rounded-2xl overflow-hidden shadow-lg aspect-video">
        <iframe src="{{ $post->getVideoEmbedUrl() }}"
                class="w-full h-full" frameborder="0" allowfullscreen
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
        </iframe>
    </div>
    @endif

    {{-- Vidéo uploadée --}}
    @if($post->video_file)
    <div class="mb-8 rounded-2xl overflow-hidden shadow-lg">
        <video controls class="w-full rounded-2xl">
            <source src="{{ Storage::url($post->video_file) }}" type="video/mp4">
        </video>
    </div>
    @endif

    {{-- Contenu de l'article --}}
    <div class="prose prose-lg dark:prose-invert max-w-none mb-10
                prose-headings:font-bold prose-headings:text-gray-800
                prose-a:text-blue-600 prose-img:rounded-xl">
        {!! nl2br(e($post->content)) !!}
    </div>

    {{-- Partage réseaux sociaux --}}
    <div class="bg-gray-100 dark:bg-gray-800 rounded-2xl p-6 mb-10">
        <p class="font-semibold text-gray-700 dark:text-gray-200 mb-4">🔗 Partager cet article</p>
        <div class="flex flex-wrap gap-3">
            @php
                $url     = urlencode(request()->url());
                $title   = urlencode($post->title);
            @endphp
            <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-sky-500 text-white px-4 py-2 rounded-full text-sm hover:bg-sky-600 transition">
                🐦 Twitter / X
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-blue-700 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-800 transition">
                📘 Facebook
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-600 transition">
                💼 LinkedIn
            </a>
            <button onclick="navigator.clipboard.writeText('{{ request()->url() }}');this.textContent='✅ Copié !'"
                    class="flex items-center gap-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-full text-sm hover:bg-gray-300 transition">
                📋 Copier le lien
            </button>
        </div>
    </div>

    {{-- Articles liés --}}
    @if($related->isNotEmpty())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">📚 Articles similaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($related as $r)
            <a href="{{ route('blog.show', $r->slug) }}"
               class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden group">
                @if($r->cover_image)
                    <img src="{{ Storage::url($r->cover_image) }}"
                         class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-32 flex items-center justify-center text-4xl"
                         style="background: {{ $r->category->color ?? '#3B82F6' }}20">📡</div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-sm text-gray-800 dark:text-white group-hover:text-blue-600 transition">
                        {{ Str::limit($r->title, 60) }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $r->created_at->format('d/m/Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Section commentaires --}}
    <section id="comments" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">
            💬 Commentaires ({{ $post->comments->where('is_approved', true)->count() }})
        </h2>

        {{-- Liste des commentaires approuvés --}}
        @forelse($post->comments->where('is_approved', true) as $comment)
        <div class="flex gap-4 mb-6 pb-6 border-b border-gray-100 dark:border-gray-700 last:border-0">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold flex-shrink-0">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-semibold text-gray-800 dark:text-white text-sm">{{ $comment->user->name }}</span>
                    <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $comment->content }}</p>
            </div>
        </div>
        @empty
        <p class="text-gray-400 text-sm mb-6">Aucun commentaire pour l'instant. Soyez le premier !</p>
        @endforelse

        {{-- Formulaire de commentaire --}}
        @auth
            @if(auth()->user()->is_verified)
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('blog.comment', $post) }}" class="mt-6">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Laisser un commentaire
                    </label>
                    <textarea name="content" rows="4"
                              class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 resize-none"
                              placeholder="Partagez votre avis..." required></textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit"
                            class="mt-3 bg-blue-600 text-white px-6 py-2 rounded-full text-sm hover:bg-blue-700 transition">
                        ✉️ Envoyer
                    </button>
                </form>
            @else
                <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 text-yellow-700 dark:text-yellow-400 px-4 py-3 rounded-xl text-sm">
                    ⚠️ Veuillez <a href="{{ route('verify.email.form') }}" class="underline font-semibold">vérifier votre email</a> pour commenter.
                </div>
            @endif
        @else
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl px-6 py-4 text-sm text-gray-600 dark:text-gray-300 text-center">
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Connectez-vous</a>
                ou
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">créez un compte</a>
                pour commenter.
            </div>
        @endauth
    </section>

</div>
@endsection