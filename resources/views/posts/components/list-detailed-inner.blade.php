<div class="bg-white mb-4 p-3">
    <div class="flex flex-wrap text-center lg:text-left justify-center space-y-2">
        <div class="md:w-3/12 overflow-hidden">
            <div class="flex flex-wrap justify-center">
                <a class="block shadow mx-auto" style="width:200px;height:200px" href="{{ url('companies/'.$post->slug) }}">
                    <?php $image = $post->image ? $post->image : asset('images/default-company.png') ?>
                    <img class="rounded-lg w-full" src="{{ $post->image }}" alt="{{ $post->company_name }} logo">
                </a>
            </div>
        </div>
        <div class="md:w-6/12 bg-white text-center md:text-left">
            <h4>{{ $post->company_name }}</h4>
            <h6>{{ Str::limit($post->title, 50) }}</h6>
            <hr />
            @include('/posts/components/rating')
        </div>
        <div class="md:w-3/12 border-l pl-1">
            <div class="flex flex-wrap w-full justify-center flex-col">
                <a href="{{ url('companies/'.$post->slug) }}" class="btn btn-primary mb-1"> Visit site <i class="ti-new-window ml-2"></i></a>
                <a href="{{ url('companies/'.$post->slug) }}#reviews" class="btn btn-secondary"> Read Reviews <i class="ti-comments-smiley ml-2"></i></a>
            </div>
        </div>
    </div>
</div>