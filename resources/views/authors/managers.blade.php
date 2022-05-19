@include('/templates/header')
<div class="col">
    <div class="card mb-4 p-1 p-lg-3">
        <div class="row">
            <div class="col-12">
                <h1>{{ $title }}</h1>
                <div class="mt-2 p-1 bg-gray-100">
                    @include('/posts/components/list')
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')