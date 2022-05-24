<div class="flex flex-col mt-2">
    <div class="flex w-full">
        @if (Auth::user() && in_array(Auth::user()->id, array_column(json_decode(json_encode($post->authors), true), 'id')))
            @if($post->published == 'unapproved')
            <div class="flex flex-col">
                <div class="w-full md:w-2/3">
                    </div>
                    <div class="alert alert-info"><strong>Info: </strong>Your review is awaiting moderation. In the mean time you can edit when necessary. Once approved, it will be public and therefore you may not edit it.</div>
                <div class="w-full md:w-1/3">
                    <a href="{{ url('write-a-review/'.$post->id) }}" class="main-outline-btn"><small><i class="ti-comment-alt mr-2"></i></small> Edit your review </a>
                </div>
            </div>
            @endif
        @elseif(!Auth::user() || !App\Models\Review::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first())
        <a href="{{ url('add-a-review/'.$post->id) }}" class="main-outline-btn"><small><i class="ti-comment-alt mr-2"></i></small> Leave a Review </a>
        @endif
    </div>
</div>