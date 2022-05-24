@if (method_exists($items, 'links'))
<div class="row my-8 justify-center">
    <div class="flex flex-col px-3">
        {{ $items->links('pagination::tailwind') }}
    </div>
</div>
@endif