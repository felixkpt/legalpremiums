@include('/templates/header')
<div class="col">
    <div class="card p-1">
        <h1 class="px-1 w-full">{{ $title }}</h1>
        <div class="col">
            @include('/posts/components/list')
        </div>
    </div>
</div>
@include('/templates/footer')