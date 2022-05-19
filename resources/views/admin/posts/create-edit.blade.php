@include('/components/Trumbowyg-editor')
<div class="flex flex-wrap w-full justify-center m-1">
    <form action="{{ route($route, ['id' => isset($post) ? $post->id : 0]) }}" method="post" class="w-full" enctype="multipart/form-data">
        <div class="flex flex-wrap w-full justify-center m-1">
            <div class="flex flex-col w-9/12 bg-white shadow-lg p-1">
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
                    <label for="content">Content </label>
                    <div class="w-full">
                        <div id="editor" class="trumbowyg-editor" contenteditable="true" dir="ltr" style="height: 224.922px;">
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <?php $image_name = 'image'; ?>
                    @include('/admin/components/image_upload')
                </div>
                <div class="mb-4">
                    <button class="p-2 rounded-lg bg-blue-500  text-white hover:bg-blue-700 hover:text-slate-200">Publish</button>
                </div>
            </div>
            <div class="flex w-3/12">
                @include('admin/categories/components/list')
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
