<div class="flex w-full flex-wrap justify-between">
    <div class="mx-auto md:w-2/12">
        <div class="overflow-hidden">
            <img class="rounded-lg" src="{{ $post->image }}" alt="{{ $post->company_name }} logo" width="100%">
        </div>
    </div>
    <div class="w-full md:w-7/12 text-center">
        <h4 class="mb-1">{{ $post->company_name }}</h4>
        @include('/posts/components/rating')
    </div>
    <div class="w-full md:w-3/12 text-center">
        <a href="{{ $post->company_url }}" target="_blank" class="main-btn"> Visit site <i class="ti-new-window ml-2"></i></a>
    </div>
</div>