@extends('admin.layout')
@section('content')

<h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-8">📊 Tableau de bord</h1>

{{-- Cartes de stats --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 border-l-4 border-blue-500">
        <p class="text-gray-500 dark:text-gray-400 text-xs">Articles publiés</p>
        <p class="text-3xl font-bold text-blue-600">{{ $stats['published_posts'] }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $stats['draft_posts'] }} brouillon(s)</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 border-l-4 border-green-500">
        <p class="text-gray-500 dark:text-gray-400 text-xs">Vues totales</p>
        <p class="text-3xl font-bold text-green-600">{{ number_format($stats['total_views']) }}</p>
        <p class="text-xs text-gray-400 mt-1">Tous articles</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 border-l-4 border-yellow-500">
        <p class="text-gray-500 dark:text-gray-400 text-xs">Commentaires</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $stats['total_comments'] }}</p>
        <p class="text-xs text-red-400 mt-1">{{ $stats['pending_comments'] }} en attente</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 border-l-4 border-purple-500">
        <p class="text-gray-500 dark:text-gray-400 text-xs">Utilisateurs</p>
        <p class="text-3xl font-bold text-purple-600">{{ $stats['total_users'] }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $stats['total_categories'] }} catégories</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 border-l-4 border-orange-500">
        <p class="text-gray-500 dark:text-gray-400 text-xs">Liste d'attente</p>
        <p class="text-3xl font-bold text-orange-600">{{ $stats['waitlist_count'] }}</p>
        <p class="text-xs text-gray-400 mt-1">inscrits plateforme</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-8 mb-8">
    {{-- Top articles --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
        <h2 class="font-semibold text-gray-700 dark:text-white mb-4">🏆 Top 5 articles</h2>
        <div class="space-y-3">
            @foreach($topPosts as $i => $post)
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-full bg-orange-100 text-orange-700 text-sm font-bold flex items-center justify-center flex-shrink-0">
                    {{ $i + 1 }}
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">{{ $post->title }}</p>
                    <p class="text-xs text-gray-400">{{ $post->views }} vues</p>
                </div>
                <a href="{{ route('admin.posts.edit', $post) }}"
                   class="text-orange-500 text-xs hover:underline flex-shrink-0">Éditer</a>
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
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 mb-8">
    <h2 class="font-semibold text-gray-700 dark:text-white mb-4">📂 Articles par catégorie</h2>
    <div class="space-y-3">
        @foreach($postsByCategory as $cat)
        @php $percent = $stats['total_posts'] > 0 ? ($cat->posts_count / $stats['total_posts']) * 100 : 0; @endphp
        <div class="flex items-center gap-4">
            <span class="w-24 text-sm text-gray-600 dark:text-gray-300 truncate">{{ $cat->name }}</span>
            <div class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full h-4">
                <div class="h-4 rounded-full transition-all duration-500"
                     style="width: {{ $percent }}%; background: {{ $cat->color }}"></div>
            </div>
            <span class="text-sm text-gray-500 w-6 text-right">{{ $cat->posts_count }}</span>
        </div>
        @endforeach
    </div>
</div>

{{-- Liste d'attente --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-semibold text-gray-700 dark:text-white">
            🚀 Derniers inscrits — Liste d'attente
            <span class="ml-2 bg-orange-100 text-orange-700 text-xs px-2 py-0.5 rounded-full">
                {{ $stats['waitlist_count'] }} total
            </span>
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-2 text-left rounded-tl-xl">Prénom</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Région</th>
                    <th class="px-4 py-2 text-left rounded-tr-xl">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($latestWaitlist as $w)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                        {{ $w->name ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $w->email }}</td>
                    <td class="px-4 py-3">
                        @if($w->region)
                        <span class="bg-orange-100 text-orange-700 text-xs px-2 py-0.5 rounded-full">
                            {{ $w->region }}
                        </span>
                        @else
                        <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-400 text-xs">
                        {{ $w->created_at->diffForHumans() }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                        Aucune inscription pour l'instant.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection