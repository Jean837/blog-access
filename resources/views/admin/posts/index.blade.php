@extends('admin.layout')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">📝 Tous les articles</h1>
    <a href="{{ route('admin.posts.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        ➕ Nouvel article
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-gray-600 text-sm">
            <tr>
                <th class="px-6 py-3 text-left">Titre</th>
                <th class="px-6 py-3 text-left">Catégorie</th>
                <th class="px-6 py-3 text-left">Statut</th>
                <th class="px-6 py-3 text-left">Vues</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($posts as $post)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-800">{{ Str::limit($post->title, 40) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-xs text-white"
                          style="background:{{ $post->category->color ?? '#888' }}">
                        {{ $post->category->name ?? '—' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($post->status === 'published')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">✅ Publié</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">✏️ Brouillon</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $post->views }}</td>
                <td class="px-6 py-4 text-gray-500 text-sm">{{ $post->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('admin.posts.edit', $post) }}"
                       class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-sm hover:bg-yellow-200">
                        ✏️ Éditer
                    </a>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                          onsubmit="return confirm('Supprimer cet article ?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm hover:bg-red-200">
                            🗑️ Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                    Aucun article pour l'instant.
                    <a href="{{ route('admin.posts.create') }}" class="text-blue-500 underline">Créer le premier</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $posts->links() }}</div>
</div>
@endsection