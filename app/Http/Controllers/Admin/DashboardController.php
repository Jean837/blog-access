<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Waitlist;

class DashboardController extends Controller
{
    public function index() {
        $stats = [
            'total_posts'      => Post::count(),
            'published_posts'  => Post::where('status', 'published')->count(),
            'draft_posts'      => Post::where('status', 'draft')->count(),
            'total_views'      => Post::sum('views'),
            'total_comments'   => Comment::count(),
            'pending_comments' => Comment::where('is_approved', false)->count(),
            'total_users'      => User::count(),
            'total_categories' => Category::count(),
            'waitlist_count'   => Waitlist::count(),
        ];

        $topPosts        = Post::where('status', 'published')->orderBy('views', 'desc')->limit(5)->get();
        $pendingComments = Comment::with('post', 'user')->where('is_approved', false)->latest()->limit(5)->get();
        $postsByCategory = Category::withCount('posts')->get();
        $latestWaitlist  = Waitlist::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'topPosts', 'pendingComments', 'postsByCategory', 'latestWaitlist'
        ));
    }
}