<div class="flex flex-row text-left border-b-2 border-gray-300 py-2" id="mediaTop">
    <button type="button" class="bg-gray-400 hover:bg-gray-200 text-gray-700 font-medium py-2 px-3 rounded-sm mr-2" id="uploadSwitch">Upload</button>
    <button type="button" class="bg-gray-400 hover:bg-gray-200 text-gray-700 font-medium py-2 px-3 rounded-sm" id="mediaSwitch">Media</button>
</div>
<div class="flex flex-col mt-2">
    <div id="uploadSection" class="hidden">
        @include('/admin/media/components/upload')
    </div>
    
    <div id="mediaSection">
        <div class="grid gap-2 grid-cols-1 md:grid-cols-3 lg:grid-cols-5" id="content">
            @if (isset($media) && count($media) > 0)
            @foreach ($media as $item)
            <div class="flex justify-center bg-gray-400 single-image-parent" style="height:180px">
                <a class="flex md:w-full single-image" href="{{ url('admin/media/'.$item->id) }}" data="{{ $item }}">
                <img style="height:100%;width:100%" src="{{ url($item->url) }}" alt="">
                </a>
            </div>
            @endforeach
            @else
            <div class="flex justify-center single-image-parent" style="height:180px">
                <span class="text-gray-300 md:text-xl">No uploaded media yet</span>
            </div>
            @endif

        </div>
        <div class="flex w-full bg-gray-200 mt-2 rounded" id="paginationSection">
            <?php $items = isset($media) ? $media : null ?>
            @include('/admin/components/pagination')
        </div>
    </div>
</div>
<div class="media-modal-wrapper-item hidden py-4" id="currentMediaSectionModal">
    <div class="flex flex-col justify-center h-full items-center">
        <div class="flex flex-col media-modal-item bg-gray-500 shadow-lg rounded w-11/12 md:w-6/12">
            @include('/admin/media/components/show')
        </div>
    </div>
</div>
<script>
    const uploadSwitch = document.getElementById('uploadSwitch')
    const uploadSection = document.getElementById('uploadSection')
    const mediaSwitch = document.getElementById('mediaSwitch')
    const mediaSection = document.getElementById('mediaSection')
    const paginationSection = document.querySelector('#paginationSection')
    
    uploadSwitch.addEventListener('click', function () {
        uploadSection.classList.remove('hidden')
        mediaSection.classList.add('hidden')
    })
    mediaSwitch.addEventListener('click', function () {
        mediaSection.classList.remove('hidden')
        uploadSection.classList.add('hidden')
        updateMedia(siteInfo.url+'admin/media')
    })

    paginationSection.addEventListener('click', function (event) {
        event.preventDefault()
        if (url = event.target.getAttribute('href')) {
            updateMedia(url, true)
        }
    })


    function updateMedia(url, scrollToTop = false) {
        const xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (scrollToTop) {
                    var mediaTop = document.querySelector('#mediaTop')
                    mediaTop.scrollIntoView({ behavior: 'smooth'})

                }
                const items = JSON.parse(this.response)
                const mediaData = items.data

                if (mediaData.length < 1) {
                    return
                }

                document.querySelector("#mediaSection").querySelector('#content').innerHTML = '';
                mediaData.forEach(function (data) {

                    let item = document.createElement('div')
                    item.classList.add('flex', 'justify-center', 'bg-gray-400', 'single-image-parent')
                    item.style = "height:180px"
                    item.innerHTML = `<a class="flex md:w-full single-image" href="${url}admin/media/${data.id}" data='${JSON.stringify(data)}'>
                <img style="height:100%;width:100%" src="${data.url}" alt="">
                </a>`
                    document.querySelector("#mediaSection").querySelector('#content').append(item);
                })

                
                if ( items.next_page_url ) {
                    var paginationInner = document.createElement('div')
                    paginationInner.classList.add('flex', 'w-full', 'my-8', 'justify-center')
                    var pagination = getPagination(items)
                    paginationInner.append(pagination)
                    document.getElementById('paginationSection').innerHTML = ''
                    document.getElementById('paginationSection').classList.remove('hidden')
                    document.getElementById('paginationSection').append(paginationInner)
                }else {
                    document.getElementById('paginationSection').classList.add('hidden')
                }

            }
        };
        xhr.open('GET', url, true)
        xhr.setRequestHeader('accept', 'application/json')
        xhr.setRequestHeader('data-type', 'json')
        xhr.send()
    }

    const mediaContent = document.querySelector('#mediaSection').querySelector('#content')
    mediaContent.addEventListener('click', function (event) {
        if (event.target.closest('.single-image')) {
            event.preventDefault()
            let target = event.target.closest('.single-image');
            singleImage(target.getAttribute('data'))
        }
    })

    function getPagination (items) {

        // console.log(items)
        // return;
        var pagination = document.createElement('div')
        pagination.classList.add('flex')
        var nav = document.createElement('nav')
        nav.classList.add('flex', 'items-center', 'justify-between')
        nav.setAttribute('role', 'navigation')
        nav.setAttribute('aria-label', 'Pagination Navigation')
        
        // Lets create mobile nav
        var mobileNav = document.createElement('div')
        mobileNav.classList.add('flex', 'justify-between', 'flex-1', 'sm:hiddenn')
        
        var prev = `<span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">« Previous</span>`
        if (items.prev_page_url) {
            prev = `<a href="${items.first_page_url}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">« Previous</a>`
        }
        
        var next = `<span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">Next »</span>`
        if (items.next_page_url) {
            next = `<a href="${items.next_page_url}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">Next »</a>`
        }

        mobileNav.innerHTML = prev + next
        
        nav.append(mobileNav)
        // End mobile nav create

        // Append the nav to pagination
        pagination.append(nav)

        return pagination
    }

updateMedia(siteInfo.url+'admin/media')
</script>
