<?php $nav_items = [ ['link' => 'companies', 'label' => 'Companies'], ['link' => 'posts', 'label' => 'Posts'], ['link' => 'pages/about', 'label' => 'About us']] ?>
<nav class="bg-yellow-400 text-lg text-yellow-700 font-bold md:px-3 py-3 shadow">
	<div class="container flex flex-wrap justify-between items-center mx-auto px-1">
		<a class="flex items-center px-2 hover:bg-gray-50 md:hover:bg-transparent hover:text-yellow-900" href="{{ url('') }}"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg> {{ \Site::name() }}</a>
		<div class="flex md:order-2">
			<div class="hidden relative md:block">
				@include('/components/search')
			</div>
			<button data-collapse-toggle="mobile-menu-3" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-3" aria-expanded="false">
				<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
				<svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
			</button>
		</div>
		<div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-3">
			<div class="md:hidden mt-3">
				@include('/components/search')
			</div>
			<ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
				@foreach($nav_items as $item)
				<li>
					<a class="block w-full px-2 md:border-r-2 md:border-yellow-500 hover:bg-gray-50 md:hover:bg-transparent hover:text-yellow-900" href="{{ url($item['link']) }}">{{ $item['label'] }}</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</nav>
