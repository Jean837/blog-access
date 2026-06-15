<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function approve(Comment $comment) {
        $comment->update(['is_approved' => true]);
        return back()->with('success', '✅ Commentaire approuvé !');
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return back()->with('success', '🗑️ Commentaire supprimé.');
    }
}