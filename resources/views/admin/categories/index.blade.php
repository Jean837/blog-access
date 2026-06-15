@extends('admin.layout')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">🏷️ Catégories</h1>

<div class="grid grid-cols-2 gap-8">
    {{-- Formulaire création --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="font-semibold text-gray-700 mb-4">Nouvelle catégorie</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded-xl px-4 py-2" placeholder="Ex: 5G" required>
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Couleur</label>
                <input type="color" name="color" value="{{ old('color', '#3B82F6') }}"
                       class="h-10 w-20 rounded border">
            </div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700">
                ➕ Créer
            </button>
        </form>
    </div>

    {{-- Liste des catégories --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="font-semibold text-gray-700 mb-4">Catégories existantes</h2>
        <div class="space-y-3">
            @forelse($categories as $cat)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-4 h-4 rounded-full" style="background:{{ $cat->color }}"></div>
                    <span class="font-medium">{{ $cat->name }}</span>
                    <span class="text-gray-400 text-sm">{{ $cat->posts_count }} article(s)</span>
                </div>
                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                      onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:text-red-700 text-sm">🗑️</button>
                </form>
            </div>
            @empty
            <p class="text-gray-400 text-center py-4">Aucune catégorie.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection