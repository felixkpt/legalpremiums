<style>
    .front-view {
    position: absolute;
    bottom: 0;
    left: 0;
    opacity: 0;
    transition: opacity .40s, transform .40s;
    transform: translate3d(0,-7px,0);
    box-sizing: border-box;
    }
    .featured-thumbnail img{
        object-fit: cover;
        height:180px;
        width: 100%;
    }

    .featured-thumbnail:hover .front-view {
        opacity: 1;
        z-index: 1;
        transform: translate3d(0,-5px,0);
						
    }
    .featured-thumbnail img {
        transition: opacity .40s, transform .40s;
    
    }
    .featured-thumbnail:hover img {
        -webkit-transform: translate3d(0,-60px,0);
        transform: translate3d(0,-60px,0);
    }
</style>
<div class="mt-4">
<h3 class="text-xl font-bold text-gray-700 pb-2 mb-2" style="border-bottom: 2px dotted #d1d1d1">Related Posts</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
    @foreach($related as $post)
    <div class="flex flex-wrap space-y-2 mb-1 justify-center post-box">
        <div class="w-auto">
            <div class="post-img featured-thumbnail w-64 md:w-auto mx-auto">
                <a title="{{ $post->title }}" href="{{ url('companies/'.$post->slug) }}">
                    <img class="mx-auto" style="width:100%" src="{{ $post->image }}" alt="">
                    <div class="post-format-icons">
                        <svg class="bg-yellow-800 rounded-full w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                    </div>
                    <div class="px-2 py-3 text-gray-200 front-view bg-yellow-800">{{ Str::limit(strip_tags($post->content->content), 100) }}</div>
                </a>
            </div>
            <div class="post-data">
                <h4 class="text-lg font-bold text-gray-600 hover:text-yellow-700">
                    <a title="{{ $post->title }}" href="{{ url('companies/'.$post->slug) }}">
                    {{ Str::limit($post->title, 100) }}
                    </a>
                </h4>
                @include('/posts/components/post-info')
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
