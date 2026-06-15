@extends('blog.layout')
@section('title', $post->title)
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-400 mb-6 flex items-center gap-2 flex-wrap">
        <a href="{{ route('blog.index') }}" class="hover:text-orange-500 transition">Accueil</a>
        <span>›</span>
        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
           class="hover:text-orange-500 transition">{{ $post->category->name }}</a>
        <span>›</span>
        <span class="text-gray-600 dark:text-gray-300">{{ Str::limit($post->title, 50) }}</span>
    </nav>

    {{-- En-tête article --}}
    <header class="mb-8">
        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-white mb-4"
              style="background: {{ $post->category->color ?? '#F97316' }}">
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
            <span>💬 {{ $post->comments->count() }} commentaire(s)</span>
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
                prose-a:text-orange-600 prose-img:rounded-xl">
        {!! nl2br(e($post->content)) !!}
    </div>

    {{-- Partage réseaux sociaux --}}
    <div class="bg-orange-50 dark:bg-gray-800 border border-orange-100 dark:border-gray-700 rounded-2xl p-6 mb-10">
        <p class="font-semibold text-gray-700 dark:text-gray-200 mb-4">🔗 Partager cet article</p>
        <div class="flex flex-wrap gap-3">
            @php
                $url   = urlencode(request()->url());
                $title = urlencode($post->title);
            @endphp

            {{-- Twitter / X --}}
            <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-black text-white px-4 py-2 rounded-full text-sm hover:bg-gray-800 transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
                X (Twitter)
            </a>

            {{-- Facebook --}}
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-[#1877F2] text-white px-4 py-2 rounded-full text-sm hover:bg-[#166FE5] transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </a>

            {{-- LinkedIn --}}
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-[#0A66C2] text-white px-4 py-2 rounded-full text-sm hover:bg-[#0958A8] transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
                LinkedIn
            </a>

            {{-- WhatsApp --}}
            <a href="https://wa.me/?text={{ $title }}%20{{ $url }}"
               target="_blank"
               class="flex items-center gap-2 bg-[#25D366] text-white px-4 py-2 rounded-full text-sm hover:bg-[#20BD5C] transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                </svg>
                WhatsApp
            </a>

            {{-- Copier le lien --}}
            <button onclick="copyLink(this)"
                    data-url="{{ request()->url() }}"
                    class="flex items-center gap-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-full text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
                <span>Copier le lien</span>
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
               class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden group border border-gray-100 dark:border-gray-700">
                @if($r->cover_image)
                    <img src="{{ Storage::url($r->cover_image) }}"
                         class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-32 flex items-center justify-center text-4xl"
                         style="background: {{ $r->category->color ?? '#F97316' }}20">☀️</div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-sm text-gray-800 dark:text-white group-hover:text-orange-500 transition">
                        {{ Str::limit($r->title, 60) }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $r->created_at->format('d/m/Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- CTA Liste d'attente --}}
    @include('partials.waitlist-cta')

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION COMMENTAIRES                                    --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <section id="comments" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8">

        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">
            💬 Commentaires ({{ $post->comments->count() }})
        </h2>

        {{-- Liste des commentaires --}}
        @forelse($post->comments as $comment)
        <div class="mb-6" id="comment-{{ $comment->id }}">
            <div class="flex gap-4">

                {{-- Avatar --}}
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400
                            flex items-center justify-center text-white font-bold flex-shrink-0 text-sm shadow">
                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </div>

                <div class="flex-1">

                    {{-- Bulle commentaire --}}
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl rounded-tl-none px-4 py-3">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-semibold text-gray-800 dark:text-white text-sm">
                                {{ $comment->user->name }}
                            </span>
                            <span class="text-xs text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                            {{ $comment->content }}
                        </p>
                    </div>

                    {{-- Bouton Répondre --}}
                    @auth
                    @if(auth()->user()->is_verified)
                    <button onclick="toggleReply('reply-form-{{ $comment->id }}')"
                            class="text-xs text-orange-500 hover:text-orange-600 font-semibold mt-2 ml-2 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        Répondre
                    </button>
                    @endif
                    @endauth

                    {{-- Formulaire de réponse --}}
                    @auth
                    @if(auth()->user()->is_verified)
                    <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                        <form method="POST" action="{{ route('blog.comment', $post) }}">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400
                                            flex items-center justify-center text-white font-bold flex-shrink-0 text-xs shadow">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <textarea name="content" rows="2" required
                                              class="w-full border border-gray-200 dark:border-gray-600 dark:bg-gray-600
                                                     rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-orange-400 resize-none"
                                              placeholder="Répondre à {{ $comment->user->name }}..."></textarea>
                                    <div class="flex gap-2 mt-2">
                                        <button type="submit"
                                                class="bg-orange-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold hover:bg-orange-600 transition">
                                            Envoyer
                                        </button>
                                        <button type="button"
                                                onclick="toggleReply('reply-form-{{ $comment->id }}')"
                                                class="bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300 px-4 py-1.5 rounded-full text-xs font-semibold hover:bg-gray-300 transition">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                    @endauth

                    {{-- Réponses --}}
                    @if($comment->replies->isNotEmpty())
                    <div class="mt-4 ml-4 space-y-4 border-l-2 border-orange-100 dark:border-orange-900 pl-4">
                        @foreach($comment->replies as $reply)
                        <div class="flex gap-3" id="comment-{{ $reply->id }}">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-blue-400
                                        flex items-center justify-center text-white font-bold flex-shrink-0 text-xs shadow">
                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="bg-orange-50 dark:bg-gray-600 rounded-2xl rounded-tl-none px-4 py-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold text-gray-800 dark:text-white text-xs">
                                            {{ $reply->user->name }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                        {{ $reply->content }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <div class="text-5xl mb-3">💬</div>
            <p class="text-gray-400 text-sm">Aucun commentaire pour l'instant. Soyez le premier !</p>
        </div>
        @endforelse

        {{-- Formulaire commentaire principal --}}
        <div class="border-t border-gray-100 dark:border-gray-700 pt-6 mt-6">
            @auth
                @if(auth()->user()->is_verified)
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="font-semibold text-gray-700 dark:text-gray-200 mb-4">
                        ✍️ Laisser un commentaire
                    </h3>
                    <form method="POST" action="{{ route('blog.comment', $post) }}">
                        @csrf
                        <div class="flex gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400
                                        flex items-center justify-center text-white font-bold flex-shrink-0 shadow">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <textarea name="content" rows="3" required
                                          class="w-full border border-gray-200 dark:border-gray-600 dark:bg-gray-700
                                                 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-orange-400
                                                 focus:ring-2 focus:ring-orange-100 resize-none transition"
                                          placeholder="Partagez votre avis sur cet article..."></textarea>
                                @error('content')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <button type="submit"
                                        class="mt-3 bg-orange-500 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-orange-600 transition shadow">
                                    ✉️ Publier le commentaire
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800
                                text-yellow-700 dark:text-yellow-400 px-4 py-3 rounded-xl text-sm">
                        ⚠️ Veuillez
                        <a href="{{ route('verify.email.form') }}" class="underline font-semibold">
                            vérifier votre email
                        </a>
                        pour commenter.
                    </div>
                @endif
            @else
                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl px-6 py-5 text-center">
                    <div class="text-3xl mb-2">💬</div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">
                        Connectez-vous pour laisser un commentaire ou répondre
                    </p>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('login') }}"
                           class="bg-orange-500 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-orange-600 transition">
                            🔐 Se connecter
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500
                                  text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full text-sm font-semibold
                                  hover:border-orange-400 transition">
                            Créer un compte
                        </a>
                    </div>
                </div>
            @endauth
        </div>

    </section>
</div>

{{-- Scripts --}}
<script>
function toggleReply(id) {
    const form = document.getElementById(id);
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        form.querySelector('textarea').focus();
    } else {
        form.classList.add('hidden');
    }
}

function copyLink(btn) {
    navigator.clipboard.writeText(btn.dataset.url).then(() => {
        const span = btn.querySelector('span');
        span.textContent = 'Lien copié !';
        btn.classList.add('bg-green-200', 'text-green-700');
        setTimeout(() => {
            span.textContent = 'Copier le lien';
            btn.classList.remove('bg-green-200', 'text-green-700');
        }, 2000);
    });
}
</script>

@endsection