<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    private $perPage = 15;
    public function index() {
        $categories = Category::paginate($this->perPage);
        $data = ['title' => 'All categories', 'description' => '', 'categories' => $categories];
        return view('categories/index', $data);
    }

    public function show($slug) {
        $category = Category::where('slug', $slug)->first();
        
        if (!$category) {
            return redirect()->back()->with('danger', 'Whoops! Category not found.');
        }

        $posts = Post::where('post_type', 'post')->whereHas('category', function($q) use($category) {
            $q->where([['post_category.category_id', $category->id]]);
        })->orderBy('updated_at', 'desc')->paginate($this->perPage);

        $title = 'Best '.$category->name.' services';
        if ($category->id == 1) {
            $title = $category->name.' services';
        }
        
        $data = ['title' => $title, 'description' => '', 'category' => $category, 'posts' => $posts];
        return view('categories/show', $data);
    }

}
