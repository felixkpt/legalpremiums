<div class="w-full mt-3">
    <div class="flex flex-wrap w-full">
        <div class="w-full">
            <div class="alert alert-info flex flex-wrap w-full justify-between">
                <div class="my-auto">
                    <strong>Info: </strong>Your review is awaiting moderation. In the mean time you can edit where necessary.
                </div>
                <a class="btn btn-sm main-outline-btn pt-2" href="{{ url('add-a-review/'.$review->post_id) }}">Edit my review</a>
            </div>
        </div>
    </div>
</div>