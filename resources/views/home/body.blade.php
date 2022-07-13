<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
	@foreach($posts as $post)
	<div class="flex flex-col h-full justify-between">
			<div class="post-img p-2">
				<a href="{{ url('companies/'.$post->slug) }}" title="{{ $post->title }}" class="flex justify-center">
					<div style="width:100%;max-width:200px;height:200px">
						<img class="img" src="{{ asset($post->image) }}" alt="">
					</div>
					<div class="post-format-icons">
						<svg class="bg-yellow-800 rounded-full w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
					</div>
				</a>
			</div>
			<div class="flex">
				@include('/posts/components/authors-section')
			</div>
			<h2 class="text-xl font-bold text-yellow-900 hover:text-yellow-700">
				<a href="{{ url('companies/'.$post->slug) }}">{{ $post->title }}</a>
			</h2>
			<p>{{ Str::limit(strip_tags($post->content->content), 355) }}</p>
			<div class="flex w-full space-x-2 my-1">
				<a href="{{ url('companies/'.$post->slug) }}" class="btn btn-primary">
					Full article
				</a>
				<a href="{{ url('companies/'.$post->slug) }}#reviews" class="btn btn-secondary">
					{{ $post->reviews }} Reviews
				</a>
			</div>
	</div> 
	@endforeach
</div>