<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /** 
     * Our admin home
     * @return Response
     */
    public function index() {
        $users = User::orderBy('id','DESC')->paginate(4);
        $page_views = range(50, 1000)[rand(240, 949)];
        $users_this_week = count(User::where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-7 days')))->get());
        $users_news_letter_subscribed = range(100, 1000)[rand(600, 899)];
        $posts = Post::where('post_type', 'post')->count();
        $pages = Post::where('post_type', 'page')->count();

        return view('admin/index', ['users' => $users, 
        'page_views' => $page_views, 'users_this_week' => $users_this_week, 
        'users_news_letter_subscribed' => $users_news_letter_subscribed, 
        'posts' => $posts, 'pages' => $pages]);
    }
}
