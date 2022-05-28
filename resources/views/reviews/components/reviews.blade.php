<div class="shadow pb-3 mt-3 pt-5 px-3" id="reviews">
    <div class="w-full">
        @foreach($reviews as $review)
        <div class="flex flex-wrap w-full my-2">
            <div class="w-full">
                <hr>
            </div>
            <div class="w-full md:w-2/12 mt-3 md:pr-2 overflow-hidden">
                <div class="md:h-3/5">
                    <?php $user = App\Models\User::where('id', $review->user_id)->first() ?>
                    <div class="w-24 h-24 md:w-4/5 mb-2 mx-auto rounded-full">
                    <a href="{{ url('profile/'.$user->slug) }}">
                        <img class="w-24 h-24 mx-auto rounded-full" src="{{ isset($user->avatar) ? $user->avatar : asset('images/default-user.png') }}" alt="" class="user-img rounded-circle border p-1" width="100%">
                    </a>
                    </div>
                    <div class="w-full text-center pt-2">
                        <a class="text-yellow-500 hover:text-yellow-700" href="{{ url('profile/'.$user->slug) }}">{{ $user->name }}</a>
                    </div>
                </div>    
                
            </div>
            <div class="w-full md:w-10/12 mt-3">
                <h4 class="mb-1 text-xl font-medium text-center md:text-left">{{ $review->title }}</h4>
                @include('/reviews/components/review-stars')
                <p class="mb-0 text-center md:text-left">{!! $review->content !!}</p>
            </div>
            @if(Auth::user() && $review->user_id == Auth::user()->id)
                @if($review->published == 'unapproved')
                @include('/reviews/components/notify-unapproved')
                @endif
            @endif
        </div>
        @endforeach
        @if(count($reviews) < 1 && $post)
        <div class="w-full text-muted">
            No reviews yet @if(!Auth::user() || !in_array(Auth::user()->id, array_column(json_decode(json_encode($post->authors), true), 'id')) )<a href="{{ url('add-a-review/'.$post->id) }}">Review {{ $post->company_name }} now</a>@endif
        </div>
        @endif
        
    </div>
    <?php $items = $reviews; ?>
    @include('/components/pagination')
</div>

