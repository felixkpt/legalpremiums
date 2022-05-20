<footer>
	<div class="wrapper flex flex-wrap w-full">
		<div class="top flex flex-wrap w-full">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-1">
			<div class="flex flex-wrap">
				<h3 class="text-2xl text-gray-50 font-medium w-full">{{ \Site::name() }}</h3>
				<p class="text-gray-400 font-medium">
				{{ \Site::description() }}
				</p>
			</div>
			<div class="flex flex-wrap">
				<h3 class="text-2xl text-gray-50 font-medium w-full">Important pages</h3>
				<ul class="space-y-2 text-gray-400">
					<li><a class="hover:text-gray-100 hover:underline" href="{{ url('pages/about-us') }}">About us</a></li>
					<li><a class="hover:text-gray-100 hover:underline" href="{{ url('pages/privacy-policy') }}">Privacy policy</a></li>
					<li><a class="hover:text-gray-100 hover:underline" href="{{ url('pages/terms-and-conditions') }}">Terms & Conditions</a></li>
				</ul>
			</div>
			<div class="flex flex-wrap">
				<h3 class="text-2xl text-gray-50 font-medium w-full">External links</h3>
				<p class="text-gray-400 font-medium">
					<div class="flex flex-wrap w-full h-min">
						@include('/components/social-media-links')
					</div>
				</p>
			</div>
		</div>
		</div>
		<div class="flex w-full bg-yellow-900">
			<div class="bottom py-4">
				<small class="text-yellow-500">Copyright @ {{ date('Y') }} <a href="{{ url('') }}">{{ \Site::name() }}</a></small>
			</div> 	
		</div>
	</div>
</footer>