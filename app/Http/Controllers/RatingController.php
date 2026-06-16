<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Post $post) {
        $request->validate(['stars' => 'required|integer|min:1|max:5']);

        Rating::updateOrCreate(
            ['post_id' => $post->id, 'user_id' => auth()->id()],
            ['stars'   => $request->stars]
        );

        return back()->with('rating_success', 'Note enregistrée !');
    }
}