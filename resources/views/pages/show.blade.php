@include('/templates/header')
<div class="flex flex-col w-full px-1 rounded-lg">
    <div class="card mb-4 p-4">
        <div class="flex flex-wrap w-full">
        <h1 class="flex w-full">{{ $post->title }}</h1>
        </div>
        <div class="flex justify-start w-full mt-4 p-1 bg-gray-50 rounded">
            <div>
            {!! $post->content->content !!}
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')