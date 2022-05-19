<?php 
use App\Models\Post;
$posts = Post::latest()->limit(8)->get();
?>
<h2 class="mt-4 bg-white block w-full">Latest posts</h2>
<div class="flex w-full flex-wrap justify-center">
    @foreach($posts as $post)
    <div class="flex flex-col p-1">
        <div class="h-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="w-56 h-36 shadow rounded m-1">
                <a class="block overflow-hidden" href="{{ url('posts/'.$post->slug) }}">
                    <img class="img-fadein w-48 h-36 mx-auto" src="{{ asset($post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}">
                </a>
            </div>
            <div class="p-1 w-56">
                <a class="link-dark mb-3 font-medium hover:underline" href="{{ url('posts/'.$post->slug) }}">
                    {{ Str::limit($post->title, 45) }}
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>