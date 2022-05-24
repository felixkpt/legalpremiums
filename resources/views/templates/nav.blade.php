<?php $nav_items = [ ['link' => 'companies', 'label' => 'Companies'], ['link' => 'write-a-review', 'label' => 'Write a review'], ['link' => 'pages/about-us', 'label' => 'About us']] ?>
<nav class="bg-yellow-400 text-lg text-yellow-700 font-bold md:px-3 py-3 shadow">
	<div class="container flex flex-wrap justify-between items-center mx-auto px-1">
		<div class="w-full mb-2">
			@guest
			<div class="flex justify-end space-x-2">
				<a class="w-auto px-2 bg-yellow-900 hover:bg-yellow-700 text-gray-200 hover:text-gray-100 border border-transparent hover:border-gray-100 transition-ease duration-1000 rounded" href="{{ route('register') }}">Register</a>
				<a class="w-auto px-2 hover:bg-yellow-500 text-gray-100 hover:text-gray-100 border border-yellow-900 hover:border-gray-100 transition-ease duration-1000 rounded" href="{{ route('login') }}">Login</a>
			</div>
			@else 
			<div class="flex justify-end">
				<button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="rounded px-1 text-gray-100 md:hover:bg-yellow-500 md:focus:bg-yellow-500 border border-transparent md:focus:border-gray-100 font-medium">
					Account <svg class="inline w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
				</button>
				<div id="dropdownNavbar" class="hidden bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow my-4 w-44" data-popper-placement="bottom" data-popper-reference-hidden="" data-popper-escaped="" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);">
					<ul class="py-1" aria-labelledby="dropdownLargeButton">
						<li>
							<a href="{{ url('profile/'.Auth::user()->slug) }}" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">My Profile</a>
						</li>
						@if (Auth::user()->role('Admin'))
						<li>
							<a href="{{ route('admin.index') }}" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Dashboard</a>
						</li>
						@endif
					</ul>
					<div class="py-1 w-full">
						<form class="block" action="{{ route('logout') }}" method="post">
							<button class="w-full text-left text-sm bg-gray-200 font-medium hover:bg-gray-300 text-gray-700 hover:text-gray-500 block px-4 py-2">Logout</buttion>
							@csrf
						</form>
					</div>
				</div>
			</div>
			@endguest
		</div>
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
