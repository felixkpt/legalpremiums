<?php 
    $items = $posts ?? $author->posts;
    foreach($items as $key =>  $post): ?>
    <div class="flex flex-wrap shadow p-1 mt-2">
        <div class="w-full md:w-3/12 lg:w-2/12">
            <a class="block" style="margin: auto;width: max-content;" href="{{ url('companies/'.$post->slug) }}">
                <img class="mx-auto rounded-lg" src="{{ asset('').$post->image }}" alt="{{ $post->company_name }} logo" style="height: 120px;width:auto;">
            </a>
        </div>
        <div class="w-full md:w-9/12 lg:w-10/12">
            <a style="font-size:24px" class="" href="{{ url('companies/'.$post->slug) }}">{{ $post->title }}</a>
            @include('/posts/components/authors-section')
        </div>
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
