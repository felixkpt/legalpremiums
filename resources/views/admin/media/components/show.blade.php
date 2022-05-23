<?php use Illuminate\Support\Facades\Request; ?>
<div class="my-2 w-full flex justify-center">
    <div class="flex flex-col w-full">
        <div class="flex">
            <label class="text-gray-50 mx-2 border-2 border-gray-100 p-1 rounded" for="text" id="copy">Copy</label>
            <input class="w-full mr-2 rounded" type="readonly" id="text" value="{{ isset($media_item) ? asset($media_item->url) : '' }}">
        </div>
        <div class="flex justify-center mt-2">
            <div class="flex flex-col justify-center md:w-2/3">
                <div class="flex w-full justify-center" style="min-height: 80px ;">
                    <img style="width: auto;" src="{{ isset($media_item) ? asset($media_item->url) : '' }}" alt="" id="image">
                </div>
                <div class="flex flex-col justify-center w-full bg-gray-200 rounded mt-2">
                    <div class="flex w-full justify-center">
                        <p class="text-gray-600 font-normal">Image type: <span id="type">{{ isset($media_item) ? $media_item->type : '' }}</span></p>
                    </div>
                    <div class="flex w-full justify-center">
                        <p class="text-gray-500 font-normal">Uploaded <span id="uploaded">{{ isset($media_item) ? $media->created_at->diffForHumans() : '' }}</span> by <span class="text-sky-500" id="author">{{ isset($media_item) ? $media->author->name : '' }}</span></p>
                    </div>
                </div>
                <div class="flex w-full justify-between mt-2">
                    <a href="{{ isset($media_item) ? asset($media_item->url) : '#' }}" id="link" class="bg-blue-500 text-gray-100 font-bold hover:bg-blue-700 pointer rounded-lg p-1 mr-1" target="_blank">View full image</a>
                    <form action="{{ isset($media_item) ? route('admin.media.destroy', $media_item->id) : '' }}" method="post" class="flex">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="redirect" value="" id="redirect">
                        <button class="bg-red-600 text-gray-100 font-bold hover:bg-red-800 pointer rounded-lg p-1">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function singleImage(item) {
    item = JSON.parse(item)
    var url = <?php echo json_encode(url('')) ?>;
    var currentUri = <?php echo json_encode(Request::url()) ?>;

    document.getElementById('currentMediaSectionModal').classList.remove('hidden')

    document.querySelectorAll('#currentMediaSectionModal #text')[0].value = item.url
    document.querySelectorAll('#currentMediaSectionModal #text')[0].select()
    copy.style = 'border-color:#ccc'
    copy.innerHTML = 'Copy'

    document.querySelectorAll('#currentMediaSectionModal #link')[0].setAttribute('href', item.url)
    document.querySelectorAll('#currentMediaSectionModal #image')[0].setAttribute('src', item.url)
    document.querySelectorAll('#currentMediaSectionModal #type')[0].innerHTML = item.type;
    let date = new Date(item.created_at)
    let time = date.toLocaleTimeString();
    date = date.toLocaleDateString();
    document.querySelectorAll('#currentMediaSectionModal #uploaded')[0].innerHTML = ' on '+date+' at '+time;
    document.querySelectorAll('#currentMediaSectionModal #author')[0].innerHTML = item.author.name;
    document.querySelectorAll('#currentMediaSectionModal form')[0].setAttribute('action', `${url}/admin/media/${item.id}`)
    document.querySelectorAll('#currentMediaSectionModal #redirect')[0].value = currentUri;
    
}

const copy = document.querySelectorAll('#currentMediaSectionModal #copy')[0];

copy.addEventListener('click', function () { 
let source = document.querySelectorAll('#currentMediaSectionModal #text')[0]
source.select()
navigator.clipboard.writeText(source.value)
copy.innerHTML = 'Copied!'
copy.style = 'border-color:green'
if (imageUrlSection = document.getElementById('image_url')) {
    imageUrlSection.value = source.value
    document.getElementById('image_url_label').style.backgroundImage = `url(${source.value})`
    document.getElementById('currentMediaSectionModal').classList.add('hidden')
    document.getElementsByClassName('media-modal-wrapper')[0].classList.add('hidden')
}
})

var wrapperItem = document.getElementsByClassName('media-modal-wrapper-item')[0]
wrapperItem.addEventListener('click', function (event) {
    var self = event.target.closest('.media-modal-item')
    if (!self) {
        wrapperItem.classList.add('hidden')
    }
})

</script>
<style>
    .media-modal-wrapper-item {
        position: fixed;
        z-index: 130;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: #000000a6;
    }
    .media-modal-item {
        opacity: 1;
        overflow: auto;
    }
</style>
