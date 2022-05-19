<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
        'company_name',
        'company_url',
        'title',
        'content',
        'rating',
        'published',
    ];

    /**
     * A review belongs to user
     */
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * A Review belongs to a post too
     */
    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
