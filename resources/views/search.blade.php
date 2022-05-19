@include('/templates/header')
<div class="w-full">
    <div class="bg-white mb-4 p-1 p-lg-3">
        <div class="w-full bg-gray-100 rounded mb-5 relative">
            @include('/components/search')
        </div>
        <div class="flex flex-wrap">
            
            <div class="w-full">
                <?php $posts = $results; ?>
                @if($posts && $posts->count())
                <div class="space-y-4">
                    <div class="mb-2">
                        <em class="">Found {{ $posts->total() }} results</em>
                    </div>
                    <?php $items = $posts ?>
                    @include('/posts/components/list-detailed')
                    @include('components/pagination')
                </div>
                @else
                <p style="font-size: large;">No results found</p>
                @endif
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')