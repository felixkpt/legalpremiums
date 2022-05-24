@include('/templates/header')
<div class="flex flex-col px-3">
    <div class="card">
        <h1 class="col">{{ $title }}</h1>
        <div class="flex flex-col px-3">
            @include('/categories/components/list')
        </div>
    </div>
</div>
@include('/templates/footer')