@extends('admin.layout')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Nouvel article</h1>

<form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow p-8 space-y-6">
    @csrf

    {{-- Titre --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Titre *</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500"
               placeholder="Ex: La 5G en Afrique : état des lieux" required>
        @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Extrait --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Extrait (résumé court)</label>
        <textarea name="excerpt" rows="2"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500"
                  placeholder="Un résumé de 1-2 phrases...">{{ old('excerpt') }}</textarea>
    </div>

    {{-- Contenu --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Contenu *</label>
        <textarea name="content" id="content" rows="12"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">{{ old('content') }}</textarea>
        @error('content')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-2 gap-6">
        {{-- Catégorie --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
            <select name="category_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500" required>
                <option value="">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Statut --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
            <select name="status"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>✏️ Brouillon</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>✅ Publié</option>
            </select>
        </div>
    </div>

    {{-- Image de couverture --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">🖼️ Image de couverture</label>
        <input type="file" name="cover_image" accept="image/*"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">
        <p class="text-gray-400 text-xs mt-1">JPG, PNG, WebP — max 4 Mo</p>
        @error('cover_image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Vidéo --}}
    <div class="border border-gray-200 rounded-xl p-4 space-y-4">
        <p class="font-medium text-gray-700">🎬 Vidéo (choisir une option)</p>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Option 1 — Lien YouTube / Vimeo</label>
            <input type="url" name="video_url" value="{{ old('video_url') }}"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:border-blue-500"
                   placeholder="https://www.youtube.com/watch?v=...">
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Option 2 — Upload un fichier vidéo</label>
            <input type="file" name="video_file" accept="video/mp4,video/webm"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2">
            <p class="text-gray-400 text-xs mt-1">MP4, WebM — max 50 Mo</p>
        </div>
    </div>

    <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition text-lg">
        ✅ Publier l'article
    </button>
</form>
@endsection