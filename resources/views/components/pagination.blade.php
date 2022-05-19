@if (method_exists($items, 'links'))
<div class="row my-8 justify-center">
    <div class="col">
        {{ $items->links('pagination::tailwind') }}
    </div>
</div>
@endif