<div class="flex flex-wrap w-full justify-center m-1">
    <div class="flex w-4/5 bg-white shadow-lg p-1">
        <form action="{{ route($route, ['id' => @$post->id]) }}" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="{{ $method }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">
            <input type="hidden" name="id" value="{{ @$post->id }}">
            <div class="mb-4 w-full">
                <label for="company_name">Company name</label>
                <input type="text" id="company_name" class="w-full" name="company_name" value="{{ old('company_name') ?: @$post->company_name }}">
            </div>
            <div class="mb-4 w-full">
                <label for="company_url">Company url</label>
                <?php
                $scheme = "https://";
                $url =  old('company_url') ?: @$post->company_url;
                if (!preg_match('#^http#', $url)) {
                    $url = $scheme . $url;
                }
                ?>
                <input type="url" id="company_url" class="w-full" name="company_url" value="{{ $url }}">
            </div>
            <div class="mb-4 w-full">
                <label for="title">Title </label>
                <input type="text" id="title" class="w-full" name="title" value="{{ old('title') ?: @$post->title }}">
            </div>
            <div class="w-full" id="contentSection">
                <label for="content" class="text-gray-600">Content</label>
                <textarea id="content" name="content" rows="15" class="w-full">
                {{ old('content') ?: @$post->content->content }}
                </textarea>
                <div>
                    <?php
                    $content_count = @str_word_count(old('content') ?: $post->content) ?: 0;
                    ?>
                    <small class="text-gray-500 italic">Words: <span id="contentCount">{{ $content_count }}</span></small>
                </div>
            </div>
            <div class="mb-4">
                <?php $image_name = 'image';
                $image = isset($post) ? asset($post->image) : null ?>
                @include('/components/image_upload')
            </div>
            <div class="mb-4">
                <button class="btn btn-secondary">Publish</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#contentSection #content').summernote({
        placeholder: 'Start typing...',
        tabsize: 2,
        height: 520,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    wordCounter('#contentSection .note-editable', '#contentCount', false)
</script>