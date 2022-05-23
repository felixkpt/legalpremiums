<label id="image_url_label" class="flex flex-col w-full border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300"
                    style="height:inherit;background-image: url('{{ $image }}');background-repeat: no-repeat;background-size: cover;">
    <span class="w-full text-center bg-gray-300 text-gray-700 font-medium py-2 px-3 rounded mr-2" >{{ isset($label) ? $label : 'Choose logo' }}</span>
</label>
<input type="hidden" id="image_url" name="image_url">
@include('/admin/media/components/upload-and-media')
<script>
    var wrapper = document.querySelector('.media-modal-wrapper')
    wrapper.classList.add('hidden')
    const showMedia = document.getElementById('image_url_label')
    showMedia.addEventListener('click', function () {
        wrapper.classList.toggle('hidden')
    })
</script>
