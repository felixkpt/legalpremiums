<div class="font-bold">
        <div class="flex">
        <div class="flex text-gray-700 text-base">
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
        <a class="link-green pl-1" href="{{ url('authors/'.Str::slug($author['name'])) }}">
            <div class="inline w-8 h-8 rounded-full">
                <img class="inline w-8 h-8 rounded-full" src="{{ $author['avatar'] ?? asset('images/default-user.png') }}" alt="">
            </div>
            {{ $author['name'] }}
        </a>@if(isset($authors[$loop->index+1])),@endif
    @endforeach

            </a></span>
        </div>
        <div class="flex pl-2 text-gray-500 text-base">
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>
</div>