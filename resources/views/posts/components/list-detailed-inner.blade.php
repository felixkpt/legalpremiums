<div class="bg-white mb-4 p-3">
    <div class="flex flex-wrap text-center lg:text-left justify-center space-y-2">
        <div class="md:w-3/12 overflow-hidden">
            <div class="flex flex-wrap justify-center">
                <a href="{{ url('companies/'.$post->slug) }}">
                <div class="bg-light" style="max-width: 150px;height:140px">
                    <?php $image = @getimagesize($post->image) ? $post->image : asset('images/default-company.png') ?>
                    <img style="height: 100%;width:100%;" class="mx-auto rounded-lg" src="{{ $image }}" alt="{{ $post->company_name }} logo">
                </div>
                </a>
            </div>
        </div>
        <div class="md:w-6/12 bg-white text-center md:text-left">
            <h4>{{ $post->company_name }}</h4>
            <h6>{{ Str::limit($post->title, 50) }}</h6>
            <hr />
            @include('/posts/components/rating')
        </div>
        <div class="md:w-3/12 border-left">
            <div class="flex flex-wrap w-full justify-center">
                <a href="{{ url('companies/'.$post->slug) }}" class="btn main-btn btn-block mr-1"> Visit site <i class="ti-new-window ml-2"></i></a>
                <a href="{{ url('companies/'.$post->slug) }}#reviews" class="btn secondary-btn btn-block"> Read Reviews <i class="ti-comments-smiley ml-2"></i></a>
            </div>
        </div>
    </div>
</div>