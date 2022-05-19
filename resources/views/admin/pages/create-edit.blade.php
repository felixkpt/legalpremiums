@include('/components/Trumbowyg-editor')
<div class="flex flex-wrap w-full justify-center m-1">
    <?php 
    use App\Models\Option;
    $show_in_homepage = false;
    if (isset($post)) {
        $option = Option::where('name', 'show_in_homepage')->first();
        if ($option && isset($post) && $post->id == $option->value) {
            $show_in_homepage = true;
        }
    }
    ?>
    <div class="flex flex-col w-4/5 bg-white shadow-lg p-1">
        <form action="{{ route($route, ['id' => isset($post) ? $post->id : 0]) }}" method="post" class="w-full">
            @csrf
            <input type="hidden" name="_method" value="{{ $method }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">
            <input type="hidden" name="id" value="{{ isset($post) ? $post->id : 0 }}">
            <div class="w-full mb-4">
                <input type="checkbox" <?php if($show_in_homepage) echo 'checked'; ?> class="m-1" name="show_in_homepage" id="use"><label for="use">Show in homepage</label>
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
                <button class="p-2 rounded-lg bg-blue-500  text-white hover:bg-blue-700 hover:text-slate-200">Publish</button>
            </div>
        </form>
    </div>
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
