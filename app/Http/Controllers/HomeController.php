<?php

namespace App\Http\Controllers;

use \Site;
use App\Models\Category;
use App\Models\Option;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** 
     * Our homepage method
     * @return Response
     */
    public function index() {
        $option = Option::where('name', 'show_in_homepage')->first();
        
        $title = Site::title();
        $post = null;
        if ($option) {
            $post = Post::where('id', $option->id)->first();
            if (!$post) {
                Option::find($option->id)->delete();
            }   
            $title = $post->title ?? $title;
        }

        $categories = Category::latest()->limit(8)->get();
        $posts = Post::latest()->limit(5)->get();
        $reviews = Review::latest()->limit(4)->get();

        $slider_title = 'Search To Know If A Website Is Safe';
        $description = $slider_description = Site::description();
        $slides = [
            ['image' => 'http://localhost/lancercommunity/public/uploads/images/2022/05/categories/b8LF12Y4vrwzoFsz.jpg',
            'title' => 'Giving you best protection online',
            'link' => '#1',
            'label' => 'Explore',
            ],
            ['image' => 'http://localhost/lancercommunity/public/uploads/images/2022/05/posts/MVhK6smjCNbWOODt.jpg',
            'title' => 'Realize the sites you can trust',
            'link' => url('company'),
            'label' => 'View Sites',
        ],
            ['image' => 'http://localhost/lancercommunity/public/uploads/images/2022/05/posts/ZsAK5sgmnGZuXvF7.jpg',
            'title' => 'Review statistics',
            'link' => '#3', 
            'label' => 'View Stats',
            ],

        ];

        $data = ['title' => $title, 'description' => $description, 'post' => $post, 'hide_sidebar' => true,
                    'categories' => $categories, 'posts' => $posts, 'reviews' => $reviews, 
                    'slider_title' => $slider_title, 'slider_description' => $slider_description, 'slides' => $slides];
        return view('home/index', $data);
    }
}
