@include('/components/Trumbowyg-editor')
<div class="flex flex-wrap w-full justify-center">
    <form action="{{ route($route, ['id' => isset($post) ? $post->id : 0]) }}" method="post" class="w-full" enctype="multipart/form-data">
        <div class="flex flex-wrap w-full justify-center">
            <div class="flex w-full justify-end">
                <button data-collapse-toggle="cats-nav" type="button" class="mb-4 md:hidden text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex mr-3 items-center justify-center" aria-controls="cats-nav" aria-expanded="false">
                    Category menu
                    <svg width="24" height="24"><path d="M5 6h14M5 12h14M5 18h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                </button>
            </div>
            <div class="flex flex-col w-full md:w-9/12 bg-white shadow-lg p-1 relative">
                @csrf
                <input type="hidden" name="_method" value="{{ $method }}">
                <input type="hidden" name="redirect" value="{{ url()->previous() }}">
                <input type="hidden" name="id" value="{{ isset($post) ? $post->id : 0 }}">
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
                        $url = $scheme.$url;
                    }
                    ?>
                    <input type="url" id="company_url" class="w-full" name="company_url" value="{{ $url }}">
                </div>
                <div class="mb-4 w-full">
                    <label for="title">Title </label>
                    <input type="text" id="title" class="w-full" name="title" value="{{ old('title') ?: @$post->title }}">
                </div>
                <div class="mb-4 w-full">
                    <label for="slug">Slug (optional)</label>
                    <input type="text" id="slug" class="w-full" name="slug" value="{{ old('slug') ?: @$post->slug }}">
                    <small class="text-gray-500">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                </div>
                <div class="mb-4 w-full">
                    <label for="content">Content </label>
                    <div class="w-full">
                        <div id="editor" class="trumbowyg-editor" contenteditable="true" dir="ltr" style="height: 224.922px;">
                        </div>
                    </div>
                </div>
                <div class="my-4">
                    <div class="flex flex-wrap w-full justify-between">
                        <div class="w-full md:w-1/2 h-48">
                            <?php $image = isset($post->image) ? $post->image : ''; $purpose = 'Use' ?>
                            @include('/admin/media/components/quick-uploader')
                        </div>
                        <div class="w-full md:w-1/2 text-right mt-2 md:mt-auto">
                            <button class="px-3 py-2 rounded-lg bg-blue-500  text-white hover:bg-blue-700 hover:text-slate-200">Publish</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cats-nav" class="hidden mt-8 md:mt-0 md:flex absolute md:relative z-50 md:z-0 right-0 md:w-3/12">
                <div class="">
                    @include('admin/categories/components/list')
                </div>
            </div>
        </div>
    </form>
</div>

<script defer>
    jQuery(function() {
        // Open a modal box
        $('#editor').trumbowyg({
            // btns: [['strong', 'em',], ['insertImage']],
            autogrow: true,
        });
        $('.trumbowyg-textarea').attr('name', 'content')

        let content = <?php echo json_encode(old('content') ?: @$post->content->content) ?>;
        $('#editor').trumbowyg('html', content);

    })
</script>
