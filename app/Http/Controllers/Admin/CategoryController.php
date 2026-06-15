<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('posts')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'  => 'required|string|max:100|unique:categories',
            'color' => 'required|string',
        ]);
        Category::create($request->only('name', 'color'));
        return back()->with('success', '✅ Catégorie créée !');
    }

    public function destroy(Category $category) {
        $category->delete();
        return back()->with('success', '🗑️ Catégorie supprimée.');
    }
}