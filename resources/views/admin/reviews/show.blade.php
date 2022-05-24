@include('/admin/templates/header')    
<div class="flex flex-col px-3">
    <div class="flex flex-wrap justify-center shadow rounded-lg">
        <div class="bg-gray-50 w-2/3 p-1">
            <div class="w-full mb-1">
                @if($review->published == 'unapproved')
                <form action="{{ route('admin.reviews.approve') }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <button class="inline bg-gray-500 hover:bg-gray-800 rounded-lg font-thin text-center px-8 text-white">Approve</a>
                </form>
                @endif
            </div>

            <h2 class="text-2xl">{{ $review->title }}</h2>
            <p>{!! $review->content !!}</p>
            <div class="w-full flex flex-wrap lg:justify-between">
                <div class="flex w-full md:w-2/3 font-thin text-sm">
                    <a class="pl-1 link-default hover:underline w-full" href="{{ url('admin/reviews?author='.Str::slug($review->author->slug)) }}" class="link-yellow pl-1">{{ $review->author->name }}</a>
                </div>
                <div class="flex justify-between w-auto text-slate-700 dark:text-slate-500 h-max">
                    <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg font-thin text-center px-8 mr-1 text-white" href="{{ url('company/'.App\Models\Post::where('id', $review->post_id)->first()->slug) }}">View post</a>
                    <form action="{{ route('admin.reviews.destroy') }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{ $review->id }}">
                        <button class="flex bg-red-500 hover:bg-red-800 rounded-lg font-thin text-center px-8 text-white">Delete</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/admin/templates/footer')
