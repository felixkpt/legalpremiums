@include('/templates/header')
<div class="flex flex-col px-3">
    <div class="card p-1">
        <h1 class="px-1 w-full">{{ $title }}</h1>
        <div class="flex flex-col px-3">
            @include('/posts/components/list')
        </div>
    </div>
</div>
@include('/templates/footer')