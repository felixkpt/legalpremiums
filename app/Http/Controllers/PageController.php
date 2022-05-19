<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Post;
use Illuminate\Http\Request;

class pageController extends Controller
{
    private $perPage =20;
    /**
     * Showing specified pages
     */
    public function show($slug) {
        $post = Post::where('post_type', 'page')->where('slug', '=', $slug)->with('authors')->first();
        if (!$post) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        // reserved home slug for homepage
        $option = Option::where('name', 'show_in_homepage')->first();
        if ($post->id === ($option->value ?? 0)) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }

        $title = $post->title;
        $description = $post->description;
        $data = ['title' => $title, 'description' => $description, 'post' => $post];
        return view('pages/show', $data);
    }

}
