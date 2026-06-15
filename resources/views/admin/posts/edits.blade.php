@extends('admin.layout')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Modifier l'article</h1>

<form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow p-8 space-y-6">
    @csrf @method('PUT')

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}"
               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Extrait</label>
        <textarea name="excerpt" rows="2"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3">{{ old('excerpt', $post->excerpt) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Contenu *</label>
        <textarea name="content" id="content" rows="12"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3">{{ old('content', $post->content) }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-xl px-4 py-3" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
            <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-3">
                <option value="draft"     {{ $post->status == 'draft'     ? 'selected' : '' }}>✏️ Brouillon</option>
                <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>✅ Publié</option>
            </select>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">🖼️ Nouvelle image de couverture</label>
        @if($post->cover_image)
            <img src="{{ Storage::url($post->cover_image) }}" class="h-32 rounded-lg mb-2 object-cover">
        @endif
        <input type="file" name="cover_image" accept="image/*"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">
    </div>

    <div class="border border-gray-200 rounded-xl p-4 space-y-4">
        <p class="font-medium text-gray-700">🎬 Vidéo</p>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Lien YouTube / Vimeo</label>
            <input type="url" name="video_url" value="{{ old('video_url', $post->video_url) }}"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2"
                   placeholder="https://www.youtube.com/watch?v=...">
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Upload vidéo</label>
            @if($post->video_file)
                <p class="text-green-600 text-sm mb-1">✅ Vidéo actuelle : {{ basename($post->video_file) }}</p>
            @endif
            <input type="file" name="video_file" accept="video/mp4,video/webm"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2">
        </div>
    </div>

    <button type="submit"
            class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition text-lg">
        💾 Enregistrer les modifications
    </button>
</form>
@endsection