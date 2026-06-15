@extends('admin.layout')
@section('content')

<h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-8">📊 Tableau de bord</h1>

{{-- Cartes de stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border-l-4 border-blue-500">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Articles publiés</p>
        <p class="text-3xl font-bold text-blue-600">{{ $stats['published_posts'] }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $stats['draft_posts'] }} brouillon(s)</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border-l-4 border-green-500">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Vues totales</p>
        <p class="text-3xl font-bold text-green-600">{{ number_format($stats['total_views']) }}</p>
        <p class="text-xs text-gray-400 mt-1">Tous articles confondus</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border-l-4 border-yellow-500">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Commentaires</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $stats['total_comments'] }}</p>
        <p class="text-xs text-red-400 mt-1">{{ $stats['pending_comments'] }} en attente</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border-l-4 border-purple-500">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Utilisateurs</p>
        <p class="text-3xl font-bold text-purple-600">{{ $stats['total_users'] }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $stats['total_categories'] }} catégories</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-8 mb-8">
    {{-- Top articles --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
        <h2 class="font-semibold text-gray-700 dark:text-white mb-4">🏆 Top 5 articles</h2>
        <div class="space-y-3">
            @foreach($topPosts as $i => $post)
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-full bg-blue-100 text-blue-700 text-sm font-bold flex items-center justify-center">
                    {{ $i + 1 }}
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">{{ $post->title }}</p>
                    <p class="text-xs text-gray-400">{{ $post->views }} vues</p>
                </div>
                <a href="{{ route('admin.posts.edit', $post) }}"
                   class="text-blue-500 text-xs hover:underline">Éditer</a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Commentaires en attente --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
        <h2 class="font-semibold text-gray-700 dark:text-white mb-4">
            💬 Commentaires en attente
            @if($stats['pending_comments'] > 0)
                <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full ml-1">
                    {{ $stats['pending_comments'] }}
                </span>
            @endif
        </h2>
        <div class="space-y-3">
            @forelse($pendingComments as $comment)
            <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-xl">
                <div class="flex justify-between items-start mb-1">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ $comment->user->name ?? 'Anonyme' }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                    {{ Str::limit($comment->content, 80) }}
                </p>
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                        @csrf
                        <button class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-lg hover:bg-green-200">
                            ✅ Approuver
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}">
                        @csrf @method('DELETE')
                        <button class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-lg hover:bg-red-200">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-sm text-center py-4">✅ Aucun commentaire en attente</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Articles par catégorie --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
    <h2 class="font-semibold text-gray-700 dark:text-white mb-4">📂 Articles par catégorie</h2>
    <div class="space-y-3">
        @foreach($postsByCategory as $cat)
        @php $percent = $stats['total_posts'] > 0 ? ($cat->posts_count / $stats['total_posts']) * 100 : 0; @endphp
        <div class="flex items-center gap-4">
            <span class="w-24 text-sm text-gray-600 dark:text-gray-300">{{ $cat->name }}</span>
            <div class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full h-4">
                <div class="h-4 rounded-full transition-all duration-500"
                     style="width: {{ $percent }}%; background: {{ $cat->color }}"></div>
            </div>
            <span class="text-sm text-gray-500 w-8 text-right">{{ $cat->posts_count }}</span>
        </div>
        @endforeach
    </div>
</div>

@endsection