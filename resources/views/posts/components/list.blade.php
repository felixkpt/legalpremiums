<?php 
    $items = $posts ?? $author->posts;
    foreach($items as $key =>  $post): ?>
    <div class="flex flex-wrap shadow p-1 mt-2">
        <div class="w-full md:w-4/12 lg:w-3/12 overflow-hidden">
            <a class="block shadow mx-auto" style="width:200px;height:200px" href="{{ url('companies/'.$post->slug) }}">
                <img class="rounded-lg w-full" src="{{ $post->image }}" alt="{{ $post->company_name }} logo">
            </a>
        </div>
        <div class="w-full md:w-8/12 lg:w-9/12">
            <a class="text-lg" href="{{ url('companies/'.$post->slug) }}">{{ $post->title }}</a>
            @include('/posts/components/authors-section')
        </div>
        @if (Auth::user() && in_array(Auth::user()->id, array_column($post->authors->toArray(), 'id')))
            @if($post->published == 'unapproved')
            @include('/posts/components/notify-unapproved')
            @endif
        @endif
    </div>
    <?php endforeach; ?>
@if (count($items) < 1)
<div class="flex shadow p-1 mt-2">
    <div class="w-full md:w-10/12">
        <div class="h3 text-gray-400">
            No reviews under this category
        </div>
    </div>
</div>
@endif

@include('/components/pagination')
