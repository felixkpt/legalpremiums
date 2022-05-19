<?php

namespace App\Http\Controllers;

use App\Models\PostContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Post;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    protected $route = 'add-a-review';
    public function writeReview($post_id) {
        $post = Post::findOrFail($post_id);
        $user_id = Auth::user()->id;
        $review = Review::where('post_id', $post_id)->where('user_id', $user_id)->first();
        
        $title = 'You are writing a review on '.$post->company_name;
        $description = 'Write a review on an insurance company';
        $data = ['title' => $title, 'description' => $description, 'post' => $post, 'review' => $review, 'route' => $this->route.'.store', 'method' => 'post', 'hide_notification' => true];
        return view('posts/write-a-review', $data);
    }
    public function store(Request $request) {
        $author = Auth::user();
        $user_id = $author->id;
        $post_id = $request->get('post_id');
        
        $post = Post::where('id', $post_id)->where('post_type', 'post')->whereHas('author', function($q) use($author) {
            $q->where([['post_user.user_id', $author->id], ['post_user.manager_id', $author->id]]);
        })->first();
        if ($post) {
            return \redirect()->back()->with('danger', 'Cannot add review to your post, let others review.');
        }
        $post = Post::findOrFail($post_id);
        
        $rules = [ 
            'title' => 'required|string|max:50',
            'content' => 'required|string|min:5|max:500',
            'rating' => 'nullable|integer',
            'certified' => 'required|string'
        ];
        // 'Please confirm that you have worked with this company before.'
        $fields = $request->validate($rules);
        $fields['content'] = trim($fields['content']);
        $fields = array_merge(['post_id' => $post_id,
        'user_id' => $user_id,
        ], $fields);
        //  Review not pubished until approved by admin
        if (!Auth::user()->can('role-list')) {
            $fields['published'] = 'unapproved';
         }

         $review = Review::where('post_id', $post_id)->where('user_id', $user_id)->first();
        $msg = 'Review has been added.';
        if (!$review) {
            Review::create($fields);
        } else {
        // someone trying to edit his fellow's review ovcoz this' a skilled person/hacker
            
        if (!$review) {
                return \redirect()->back()->with('danger', 'Cannot edit someone else\'s review');
            }elseif ($review->published == 'published') {
                return \redirect()->to('companies/'.$post->slug)->with('danger', 'Cannot edit approved review.');
            }
        
            Review::find($review->id)->update($fields);
            $msg = 'Review has been updated.';
        }
        return \redirect()->to('companies/'.$post->slug)->with('info', $msg);
    }

}
