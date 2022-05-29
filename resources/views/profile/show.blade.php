@include('/templates/header')
<div class="flex flex-col w-full">
    @include('/profile/components/profile-heading')
    <div class="flex flex-col">
        <div class="w-full">
            @if(count($reviews) > 0)
            @include('/profile/components/reviews')
            @else 
            <div><span class="text-yellow-500 text-lg md:text-2xl font-medium">No reviews by {{ $user->name }}</span></div>
            @endif
        </div>
        <div class="flex justity-center w-full py-4">
            <div class="flex mx-auto">
                <a class="main-btn" href="{{ url('authors/'.$user->slug) }}">Companies reviewed by {{ $user->name }}</a>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')