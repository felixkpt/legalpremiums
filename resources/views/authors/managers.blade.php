@include('/templates/header')
<div class="flex flex-col px-3">
    <div class="card mb-4 p-1 p-lg-3">
        <div class="flex flex-wrap w-full">
            <div class="w-full">
                <?php $user = $author; ?>
                @include('/profile/components/profile-heading')
                <div class="mt-2 p-1 bg-gray-100">
                    @include('/posts/components/list')
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')