<div class="shadow pb-3 mt-3 pt-5 px-3" id="reviews">
    <div class="w-full">
        @foreach($reviews as $review)
        <div class="flex flex-wrap w-full my-2">
            <div class="w-full">
                <hr>
            </div>
            <h4 class="text-lg font-medium">
                <a class="text-yellow-500 hover:text-yellow-700" href="{{ url('companies/'.$review->post->slug) }}">
                Reviewing {{ $review->post->company_name }}
                </a>
            </h4>
        </div>
        <div class="w-full sm:w-3/12 lg:w-2/12 mt-3 md:pr-2">
            <div class="w-32 h-32 md:w-4/5 md:h-4/5 mb-2 mx-auto rounded">
                <a href="{{ url('companies/'.$review->post->slug) }}">
                    <img class="w-32 h-32 rounded" src="{{ $review->post->image }}" alt="" class="user-img rounded-circle border p-1" width="100%">
                </a>
            </div>
        </div>
        <div class="w-full sm:w-9/12 lg:w-10/12 mt-3">
            <h4 class="mb-1 text-xl text-center sm:text-left">{{ $review->title }}</h4>
            @include('/reviews/components/review-stars')
            <p class="mb-0 text-center sm:text-left">{!! $review->content !!}</p>
        </div>
        @if(Auth::user() && $review->user_id == Auth::user()->id)
            @if($review->published == 'unapproved')
            @include('/reviews/components/notify-unapproved')
            @endif
        @endif
        @endforeach
        @if(count($reviews) < 1)
        <div class="w-full text-muted">
            No reviews yet
        </div>
        @endif
        
    </div>
    <?php $items = $reviews; ?>
    @include('/components/pagination')
</div>
