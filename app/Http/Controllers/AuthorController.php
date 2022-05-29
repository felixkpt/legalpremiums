<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $perPage = 15;
    public function index() {
        $authors = User::with('posts')->whereHas('posts', function ($q) {
            $q->where('post_user.post_id', '>', 0);
        })->paginate(5) ;
        // dd($authors);
        $data = ['title' => 'Post Authors', 'description' => 'Post Authors', 'authors' => $authors];
        return view('authors/index', $data);   
    }
    public function show($slug) {
        $author = User::where('slug', $slug)->first();
        if (!$author) {
            return redirect()->back()->with('warning', 'Whoops! Author not found.');
        }
        $posts = Post::where('post_type', 'post')->whereHas('author', function($q) use($author) {
            $q->where([['post_user.user_id', $author->id]]);
        })->orderBy('updated_at', 'desc')->paginate($this->perPage);
        
        // user can view their post while it awaits moderation
        if (Auth::user() && Auth::user()->id == $author->id) {
            $posts = Post::where('post_type', 'post')->whereHas('author', function($q) use($author) {
                $q->where([['post_user.user_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
        }else{
            $posts = Post::where('post_type', 'post')->where('published', 'published')->whereHas('author', function($q) use($author) {
                $q->where([['post_user.user_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
        }

        $title = 'Companies reviewed by '.$author->name.' ('.$posts->total().')';
        $description = $title;
        $data = ['title' => $title, 'description' => $description, 'author' => $author, 'posts' => $posts];
        return view('authors/show', $data);   
    }

    /**
     * Showing all posts where a given user is manager
     */
    public function lead($slug) {
        $author = User::where('slug', $slug)->first();
        if (!$author) {
            return redirect()->back()->with('warning', 'Whoops! Author not found.');
        }
        
        // user can view their post while it awaits moderation
        if (Auth::user() && Auth::user()->id == $author->id) {
            $posts = Post::where('post_type', 'post')->whereHas('author', function($q) use($author) {
                $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
        }else{
            $posts = Post::where('post_type', 'post')->where('published', 'pubished')->whereHas('author', function($q) use($author) {
                $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
    
        }

        $title = 'Companies reviewed & lead by '.$author->name.' ('.$posts->total().')';
        $data = ['title' => $title, 'description' => 'Post lead by Author', 'author' => $author, 'posts' => $posts];
        return view('authors/managers', $data);   
    }
    
}
