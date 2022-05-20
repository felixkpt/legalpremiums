<div class="shadow pb-3 mt-3 pt-5 px-3" id="reviews">
    <div class="flex flex-wrap w-full">
        @foreach($reviews as $review)
        <div class="w-full">
            <hr>
        </div>
        <div class="w-full md:w-2/12 mt-3 md:pr-2">
            <div class="w-32 h-32 md:w-4/5 md:h-4/5 mb-2 mx-auto rounded-full">
                <img class="rounded-full" src="{{ asset(App\Models\User::where('id', $review->user_id)->first()->avatar) }}" alt="" class="user-img rounded-circle border p-1" width="100%">
            </div>
        </div>
        <div class="w-full md:w-10/12 mt-3">
            <h4 class="mb-1 text-xl font-medium text-center sm:text-left">{{ $review->title }}</h4>
            <p class="text-center sm:text-left">
                @if($review->rating > 0)
                <small>
                <?php $ratings = range(1,5); ?>
                @foreach($ratings as $rat)
                <svg class="w-6 h-6 inline <?php if ($rat <= $review->rating) echo 'text-lc-warning' ?>" fill="{{ $rat <= $review->rating ? 'skyblue' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                @endforeach
                </small>  {{ $review->rating }}/{{ count($ratings) }}
                @else
                <small class="text-lc-warning">No rating</small>
                @endif 
                <span class="ml-3 text-muted"> Reviewed {{ $review->updated_at->diffForHumans() }}, by <a href="">{{ App\Models\User::where('id', $review->user_id)->first()->name }}</a></span>
            </p>
            <p class="mb-0 text-center sm:text-left">{!! $review->content !!}</p>
        </div>
        @if(Auth::user() && $review->user_id == Auth::user()->id)
            @if($review->published == 'unapproved')
            <div class="w-full mt-3">
                <div class="flex flex-wrap w-full">
                    <div class="w-full md:w-9/12">
                        <div class="alert alert-info"><strong>Info: </strong>Your review is awaiting moderation. In the mean time you can edit where necessary.</div>
                    </div>
                    <div class="w-full md:w-3/12">
                    <a class="btn btn-sm main-outline-btn" href="{{ url('add-a-review/'.$review->post_id) }}">Edit my review</a>
                    </div>
                </div>
            </div>
            @endif
        @endif
        @endforeach
        @if(count($reviews) < 1)
        <div class="w-full text-muted">
            No reviews yet @if(!Auth::user() || !in_array(Auth::user()->id, array_column(json_decode(json_encode($post->authors), true), 'id')) )<a href="{{ url('add-a-review/'.$post->id) }}">Review {{ $post->company_name }} now</a>@endif
        </div>
        @endif
        
    </div>
    <?php $items = $reviews; ?>
    @include('/components/pagination')
</div>

