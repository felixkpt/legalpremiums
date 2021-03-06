<p class="mb-0">
    <?php 
    $ratings = range(1,5);
    ?>
    <div class="flex flex-wrap">
        <div class="w-full sm:w-1/2">
            <small>
            @foreach($ratings as $rat)
            <svg class="w-6 h-6 inline {{ $rat <= $post->rating ? 'text-lc-warning' : '' }}" fill="{{ $rat <= $post->rating ? 'skyblue' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>

            @endforeach
        </small>{{ $post->rating }}/{{ count($ratings) }}    
        </div>
        <div class="w-full sm:w-1/2">
            <span class="ml-3"> ( {{ $post->reviews }} Customer Review{{ $post->reviews > 1 ? "s" : "" }} ) </span>
        </div>
    </div>
</p>