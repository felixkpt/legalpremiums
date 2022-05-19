<?php 
$items = $categories;
foreach($items as $key =>  $category): ?>
<div class="row shadow p-1 mt-2">
    <div class="col-12 col-md-2 overflow-hidden">
        <a href="{{ url('categories/'.$category->slug) }}">
            <img class="rounded" src="{{ asset('').$category->image }}" alt="{{ $category->name }} logo" style="height: 120px;width:auto;">
        </a>
    </div>
    <div class="col-12 col-md-10">
        <h4><a href="{{ url('categories/'.$category->slug) }}">{{ $category->name }}</a></h4>
        <a style="font-size:24px" class="" href="{{ url('categories/'.$category->slug) }}">{{ $category->title }}</a>
        {!! Str::limit($category->description, 100) !!}
    </div>
</div>
<?php endforeach; ?>
@if(count($items) < 1)
<div class="h3 text-muted">
    No categories
</div>
@endif
@include('/components/pagination')