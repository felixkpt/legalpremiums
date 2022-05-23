@include('/admin/templates/header')    
<div class="flex flex-col items-center px-3">
    <?php $media_item = $media; ?>
    @include('/admin/media/components/show')
</div>
@include('/admin/templates/footer')