<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show user profile
     */
    public function show(Request $request) {
        $slug = $request->slug;
        $user = User::where('slug', $slug)->first();
        if (!$user) {
            return redirect()->back()->with('danger', 'User not found');
        }
        $description = 'Profile details & Reviews by '.$user->name;
        $reviews = Review::where('user_id', $user->id)->whereHas('post', function($q) use($user) {
            $q->where('reviews.user_id', $user->id);
        })->orderBy('updated_at', 'desc')->paginate(10);

        // user can view their review while it awaits moderation
        if (Auth::user() && Auth::user()->id == $user->id) {
            $reviews = Review::where([['user_id', $user->id]])->whereHas('post', function($q) use($user) {
                $q->where('reviews.user_id', $user->id);
            })->orderBy('updated_at', 'desc')->paginate(10);
        }else {
            $reviews = Review::where([['published', 'published'], ['user_id', $user->id]])->whereHas('post', function($q) use($user) {
                $q->where('reviews.user_id', $user->id);
            })->orderBy('updated_at', 'desc')->paginate(10);
    
        }
        
        $title = 'Reviews by '.$user->name.' ('.$reviews->total().')';
        return view('profile.show', ['title' => $title, 'description' => $description, 'user' => $user, 'reviews' => $reviews]);
    }

    }
