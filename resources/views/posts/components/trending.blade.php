<style>
    .

</style>
<div class="mb-1">
    
    <div class="space-y-2 md:px-2">
        @foreach($trending as $trend)
        <?php $post = method_exists($trend, 'post') ? $trend->post()->first() : $trend;
        ?>
        <div class="post-box">
            <div class="post-img trending">
                <a href="{{ url('companies/'.$post->slug) }}">
                    <img width="100%" height="100" src="{{ asset($post->image) }}" alt="">
                    <div class="post-format-icons">
                        <svg class="bg-yellow-800 rounded-full w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                    </div>
                </a>
            </div>
            <div class="post-data">
                <h4 class="text-lg font-bold text-gray-600 hover:text-yellow-700">
                    <a href="{{ url('companies/'.$post->slug) }}">{{ Str::limit($post->title, 100) }}</a>
                </h4>
            </div>
            @include('/posts/components/reviews-info')
        </div>
        @endforeach
    </div>
    
</div>