@include('/templates/header')
<div class="flex flex-col px-3">
    <div class="w-full">
        <div class="card">
            <div class="w-full">
                @include('/posts/components/list')
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')