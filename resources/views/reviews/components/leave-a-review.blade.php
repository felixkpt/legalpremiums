<div class="flex flex-col mt-2">
    <div class="flex w-full">
        @if (Auth::user() && in_array(Auth::user()->id, array_column($post->authors->toArray(), 'id')))
            @if($post->published == 'unapproved')
            @include('/posts/components/notify-unapproved')
            @endif
        @elseif(!Auth::user() || !App\Models\Review::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first())
        <a href="{{ url('add-a-review/'.$post->id) }}" class="main-outline-btn"><small><i class="ti-comment-alt mr-2"></i></small> Leave a Review </a>
        @endif
    </div>
</div>