<div class="font-bold">
        <div class="flex">
        <div class="flex text-gray-700 text-base">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg><span><a href="https://demo.mythemeshop.com/ad-sense-viral/author/mythemeshop/" title="Posts by MyThemeShop" rel="author">

            <?php 
    $authors = json_decode(json_encode($post->mainAuthors), true);
    
    usort($authors, function($a, $b) {
        if ($a['id'] == $a['pivot']['manager_id']) {
            return 0;
        }
        return 1;
    });
    ?>
    @foreach($authors as $author)
        <a class="link-green pl-1" href="{{ url('authors/'.Str::slug($author['name'])) }}" class="link-yellow pl-1">{{ $author['name'] }}</a>@if(isset($authors[$loop->index+1])),@endif
    @endforeach

            </a></span>
        </div>
        <div class="flex pl-2 text-gray-500 text-base">
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>
</div>