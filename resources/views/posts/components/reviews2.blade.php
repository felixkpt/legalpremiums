<div class="row">
    @foreach($reviews as $review)
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12">
                <hr>
                <a class="text-left" href="{{ url('companies/'.$review->post->slug) }}"><h5>Reviewing {{ $review->post->company_name }}</h5></a>
            </div>
            <div class="col-md-2 mt-3">
                <div class="w-16 h-16">
                    <img src="{{ App\Models\User::where('id', $review->user_id)->first()->avatar }}" alt="" class="user-img rounded-circle border p-1" width="100%">
                </div>
            </div>
            <div class="col-md-10 mt-3">
                <h4 class="mb-1">{{ $review->title }}</h4>
                <p>
                    @if($review->rating > 0)
                    <small>
                    <?php $ratings = range(1,10); ?>
                    @foreach($ratings as $rating)
                    <i class="ti-star <?php if ($rating <= $review->rating) echo 'text-lc-warning' ?>"></i>
                    @endforeach
                    </small>  {{ $review->rating }}/10
                    @else
                    <small class="text-lc-warning">No rating</small>
                    @endif 
                    <span class="ml-3 text-muted"> Reviewed {{ $review->updated_at->diffForHumans() }}, by <a href="">{{ App\Models\User::where('id', $review->user_id)->first()->name }}</a></span>
                </p>
                <p class="mb-0">{!! $review->content !!}</p>
            </div>
            @if(Auth::user() && $review->user_id == Auth::user()->id)
            @if($review->published == 'unapproved')
            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="alert alert-info"><strong>Info: </strong>Your review is awaiting moderation. In the mean time you can edit where necessary.</div>
                    </div>
                    <div class="col-12 col-md-3">
                    <a class="btn btn-sm main-outline-btn" href="{{ url('add-a-review/'.$review->post_id) }}">Edit my review</a>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
    @endforeach
    @if(count($reviews) < 1)
    <div class="col-12 text-muted">
        No reviews yet @if(!Auth::user() || !in_array(Auth::user()->id, array_column(json_decode(json_encode($post->authors), true), 'id')) )<a href="{{ url('add-a-review/'.$post->id) }}">Review {{ $post->company_name }} now</a>@endif
    </div>
    @endif
</div>