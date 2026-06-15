<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Page d'accueil du blog
    public function index(Request $request) {
        $query = Post::with('category', 'user')
                     ->where('status', 'published')
                     ->orderBy('created_at', 'desc');

        // Filtre par catégorie
        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        // Recherche
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        $posts      = $query->paginate(6);
        $categories = Category::withCount('posts')->get();
        $featured   = Post::where('status','published')->orderBy('views','desc')->first();

        return view('blog.index', compact('posts', 'categories', 'featured'));
    }

    // Page d'un article
    public function show(string $slug) {
        $post = Post::with('category','user','comments.user')
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        // Incrémenter les vues
        $post->increment('views');

        $related = Post::where('category_id', $post->category_id)
                       ->where('id', '!=', $post->id)
                       ->where('status', 'published')
                       ->limit(3)->get();

        return view('blog.show', compact('post', 'related'));
    }

    // Poster un commentaire
    public function comment(Request $request, Post $post) {
        $request->validate(['content' => 'required|string|max:1000']);

        Comment::create([
            'content'     => $request->content,
            'post_id'     => $post->id,
            'user_id'     => Auth::id(),
            'is_approved' => false,
        ]);

        return back()->with('success', '💬 Commentaire envoyé, en attente de validation.');
    }
}