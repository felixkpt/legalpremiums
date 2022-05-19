@include('/templates/header')
<div class="card mb-4 p-4">
    <div class="row">
        @foreach($authors as $author)
            <div class="col-12">
                <h1>Companies reviewed by {{ $author->name }}</h1>
                <div class="mt-2 p-1 bg-gray-100">
                        @include('/posts/components/list')
                </div>
            </div> 
        @endforeach
        <div class="flex w-full my-8 justify-center">
            <div class="flex">
                {{ $authors->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')