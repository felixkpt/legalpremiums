@include('/templates/header')
<div class="flex flex-col px-3">
    <div class="w-full">
        <div class="w-full">
            @include('posts/components/post-heading')
        </div>
        <div class="flex justify-start w-full mt-4 p-1 rounded">
            <div>
            {!! $post->content->content !!}
            </div>
        </div>
        <hr>
        @include('/posts/components/leave-a-review')
    </div>
    @include('/posts/components/reviews')
    @include('/posts/components/share')
    @include('/posts/components/related')
</div>
@include('/templates/footer')
