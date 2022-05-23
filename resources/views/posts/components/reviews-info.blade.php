<div class="text-sm font-medium text-gray-500">
    <span class="thetime updated"><svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $post->reviews()->orderby('updated_at', 'desc')->first() ? $post->reviews()->orderby('updated_at', 'desc')->first()->updated_at->diffForHumans() : $post->updated_at->diffForHumans() }}</span>
    <span class="thecomment"><svg class="w-6 h-6 dark:text-white inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg> {{ $post->reviews }}</span>
</div>