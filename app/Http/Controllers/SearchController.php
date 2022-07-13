<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $results = null;

        if ($query = $request->get('query')) {
            $results = Post::search($query)->where('post_type', 'post')->where('published', 'published')->paginate(5);
        }
        $title = 'Search results';
        $description = '';

        return view('search', ['results' => $results, 'title' => $title, 'description' => $description]);
    }
}
