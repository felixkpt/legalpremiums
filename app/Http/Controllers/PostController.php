<?php

namespace App\Http\Controllers;

use App\Models\MediaLibrary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Review;
use App\Models\PostContent;
use Illuminate\Http\Request;

class PostController extends Controller
{
     /**
     * @param string $image_rules
     */
    private $image_rules = 'mimes:jpg,png,jpeg,gif|min:2|max:2024|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000';
    protected $route = 'write-a-review';
    private $post_type = 'post';
    private $perPage = 20;
    private $reviewsPerPage = 10;
    /**
     * Showing all posts
     */
    public function index() {
        $perPage = $this->perPage;
        $posts = Post::where('post_type', 'post')->orderby('updated_at', 'desc')->with('authors')->paginate($perPage);
        // dd($posts[0]->authors[0]->pivot->created_at);
        if (!$posts) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $title = 'All reviews';
        $description = 'All reviews';
        $data = ['title' => $title, 'description' => $description, 'posts' => $posts];
        return view('posts/index', $data);
    }
    /**
     * Showing all posts with their managers only
     */
    public function managers() {
        $perPage = $this->perPage;
        $posts = Post::where('post_type', 'post')->orderby('updated_at', 'desc')->with('managers')->paginate($perPage);

        if (!$posts) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        $title = 'All posts';
        $description = 'Post managers';
        $data = ['title' => $title, 'description' => $description, 'posts' => $posts];
        return view('posts/managers', $data);
    }

    /**
     * Showing specified posts
     */
    public function show($slug) {

        $post = Post::where('post_type', 'post')->where('slug', '=', $slug)->first();
        if (!$post) {
            return redirect()->back()->with('warning', 'Whoops! Not found.');
        }
        
        // user can view their post while it awaits moderation
        if (Auth::user() && in_array(Auth::user()->id, array_column($post->authors->toArray(), 'id')) ) {
            $post = Post::where('post_type', 'post')->where('slug', '=', $slug)->first();
        }else{
            $post = Post::where('post_type', 'post')->where('slug', '=', $slug)->where('published', 'published')->first();
            if (!$post) {
                return redirect()->back()->with('warning', 'Whoops! Not found.');
            }
        }

        // user can view their review while it awaits moderation
        if ($user = Auth::user()) {
            $reviews = Review::where([['published', 'published'], ['post_id', $post->id]])->orWhere([['post_id', $post->id], ['user_id', $user->id]])->whereHas('post', function($q) use($post) {
                $q->where([['reviews.post_id', $post->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->reviewsPerPage);
        }else {
            $reviews = Review::where('published', 'published')->whereHas('post', function($q) use($post) {
                $q->where([['reviews.post_id', $post->id]]);
            })->orderBy('updated_at', 'desc')->paginate($this->reviewsPerPage);
        }
        $reviews->fragment('reviews');
        
        $title = $post->title;
        $description = $post->description;
        
        $this->updateRating($post);
        
        $related = $this->related($post);
        $trending = Review::orderby('updated_at', 'desc')->limit(5)->get();
        // dd($trending);
        $data = ['title' => $title, 'description' => $description, 'post' => $post, 'post_type' => $this->post_type, 'reviews' => $reviews, 'related' => $related, 'trending' => $trending];
        return view('posts/show', $data);

    }

    private function updateRating(&$post) {
        
        $post_id = $post->id;
        $reviews = Review::where('published', 'published')->whereHas('post', function($q) use($post) {
            $q->where([['reviews.post_id', $post->id]]);
        })->orderBy('updated_at', 'desc')->get();

        $ct = count($reviews);
        $rating = 0;
        if ($ct > 0) {

            $totals = 0;
            foreach($reviews as $review) {
                $totals += $review->rating;
            }
            $rating = $totals / $ct;
            $parts = explode('.', $rating);
            $decimal = isset($parts[1]) ? '.'.substr($parts[1], 0, 1) : null;
            $rating = $parts[0].$decimal;
        }

        if ($post->reviews != $ct && $post->rating != $rating) {
            $post = Post::find($post_id);
            $post->update(['reviews' => $ct, 'rating' => $rating,]);
        }

        return $post;

    }

    /** 
     * Related posts
     */

    public function related($post) {
        $categories = $post->categories->toArray();
        if (count($categories) > 0) {
            $categories = array_column($categories, 'id');
            $posts = Post::where([['post_type', '=', 'post'], ['published', '=', 'published']])->whereHas('category', function($q) use($categories) {
                $q->where('post_category.category_id','>', $categories);
            })->orderBy('updated_at', 'desc')->paginate($this->perPage);
            return $posts;
        }
        return [];

    }

    /**
     * Public user writing a new post
     */
    public function writePost() {
        $title = 'Write a review';
        return view('posts/create', ['route' => $this->route.'.store', 'method' => 'post', 'title' => $title]);
    }

    /**
     * Public user edit his existing that hasn't been approved yet post
     */
    public function editPost($post_id) {
        $post = Post::findOrFail($post_id);
        $title = 'Edit a review';
        
        return view('posts/edit', ['route' => $this->route.'.update', 'method' => 'patch', 'post' => $post, 'title' => $title]);
    }

    /**
     * Public user store a new post
     */
    public function storePost(Request $request) {
            $author = Auth::user();
            $user_id = $author->id;
            $post_id = $request->get('id');
         
            $post = Post::where('id', $post_id)->where('post_type', 'post')->whereHas('author', function($q) use($author) {
                $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
            })->first();
            
            if ($post_id) {
                if (!$post) {
                    // someone trying to edit his fellow's review ovcoz this' a skilled person/hacker
                    return \redirect()->back()->with('danger', 'Cannot find your review, this could mean that you are not logged in.');
                }elseif ($post->published == 'published') {
                    return \redirect()->back()->with('danger', 'Cannot edit approved review.');
                }
            }

             $rules = ['company_name' => 'required|string|min:3|max:150|unique:posts,company_name'.($post_id ? ','.$post_id : ''),
                'content' => 'required|string|min:3|max:2000000',
                ];
           
             $request->validate($rules);
             
             $company_name = ucfirst(trim($request->get('company_name')));
             $company_url = $request->get('company_url');
             $slug = Str::of($company_name)->slug('-')->value();
             $title = ucfirst(trim($request->post('title')));
             $content = ucfirst($request->get('content'));
             $data = ['company_name' => $company_name, 'company_url' => $company_url, 'title' => $title, 'slug' => $slug, 'description' => Str::limit(strip_tags($content), 150), 'post_type' => $this->post_type];
            //  Post not pubished until approved by admin
             if (!Auth::user()->can('role-list')) {
                $data['published'] = 'unapproved';
             }

            if ($request->hasFile('image')) {
                $rules = array_merge($rules, ['image' => $this->image_rules]);
                $request->validate($rules);
                
                $file = $request->file('image');
                
                $dir = 'public/'.date('Y').'/'.date('m');
                
                $path = $file->store($dir);
                chmod(storage_path('app/public/'.date('Y')),0775);
                chmod(storage_path('app/'.$dir),0775);
                $path = preg_replace('#public/#', 'uploads/', $path);

                $url = asset($path);
                
                // Getting image dimensions
                $imagesize = getimagesize($url);
                $width = $imagesize[0];
                $height = $imagesize[1];
                // Getting image size
                $image = get_headers($url, 1);
                $bytes = $image["Content-Length"] ?? $image["content-length"];
                $kb = round($bytes/(1024));
                $mb = round($bytes/(1024 * 1024));
                $size = $kb.' KB';
                if ($mb >= 1) {
                    $size = $mb.' MB';
                }
                
                $type = $file->getType();
                $mime = $file->getMimeType();
                $dat = ['user_id' => Auth::user()->id, 'url' => $url, 'type' => $type, 'mime' => $mime, 'size' => $size, 'width' => $width, 'height' => $height];

                $media = MediaLibrary::create($dat);
                if ($media) {
                    $media = MediaLibrary::where('id', $media->id)->with('author')->first();
                }
                
                $data['image'] = $media->url;
            }

             try {
                 DB::beginTransaction();
             
                 if (!$post) {
                    $post = Post::create($data);
                 
                    PostContent::create(['post_id' => $post->id, 'content' => $content]);
                    // Attaching author
                    $post->authors()->attach($user_id, ['manager_id' => $user_id]);
                 }else {
                    Post::where('id', $post_id)->update($data);
                 
                    PostContent::where('post_id', $post_id)->update(['content' => $content]);
                    // Attaching author
                    $authors = json_decode(json_encode($post->mainAuthors), true);
                    if (!in_array($user_id, array_column($authors, 'id'))) {
                        $post->authors()->attach($user_id, ['manager_id' => $user_id]);
                    }
                 }
             
                 DB::commit();
             
             } catch (Throwable $e) {
                 DB::rollback();
             }
     
             return redirect()->to('companies/'.$post->slug)->with('success', 'Company review was '.($post_id ? 'updated.' : 'created'));
                
    }

}
