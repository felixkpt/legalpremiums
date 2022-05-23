<div class="media-modal-wrapper">
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col p-3 mt-16 overflow-y-auto w-11/12 md:w-10/12 media-modal bg-gray-700 rounded-lg shadow-lg">
            @include('/admin/media/components/upload-and-media-inner')
        </div>
    </div>
</div>
<style>
    .media-modal-wrapper {
        position: fixed;
        overflow-y: auto;
        z-index: 110;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow-y: hidden;
        background-color: #000000a6;
        transition: all .5s ease;
    }
    .media-modal {
        opacity: 1;
        z-index: 120;
        height: 80vh;
    }
</style>
<script>
    var wrapper = document.getElementsByClassName('media-modal-wrapper')[0];
    wrapper.addEventListener('click', function (event) {
        var self = event.target.closest('.media-modal');
        if (!self) {
            wrapper.classList.add('hidden')
        }
    })
</script>