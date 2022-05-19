@include('/admin/templates/header')    
<div class="flex flex-col px-3">

    <div class="min-h-screen bg-blue-50">
        
        <!-- Grid starts here -->
        <div class="mt-8 grid gap-10 sm:grid-col-2 lg:grid-cols-3">
            
            <div class="flex items-center bg-white rounded shadow-sm justify-between p-5">
                <div>
                    <div class="text-sm rounded text-gray-400">Page views today</div>
                    <div class="text-3xl font-medium text-gray-600">{{ $page_views }}</div>
                </div>
                <div class="text-pink-500">Svg</div>
            </div>

            <div class="flex items-center bg-white shadow-sm justify-between p-5">
                <div>
                <div class="text-sm rounded text-gray-400">Registered users this week</div>
                    <div class="text-3xl font-medium text-gray-600">{{ $users_this_week }}</div>
                </div>
                <div class="text-pink-500">Svg</div>
            </div>
            
            <div class="flex items-center bg-white shadow-sm justify-between p-5">
                <div>
                    <div class="text-sm rounded text-gray-400">News letter subscribed users</div>
                    <div class="text-3xl font-medium text-gray-600">{{ $users_news_letter_subscribed }}</div>
                </div>
                <div class="text-pink-500">Svg</div>
            </div>

            <!-- Grid ends here -->
        </div>

        <!-- Grid starts here -->
        <div class="mt-8 grid gap-10 sm:grid-col-2 lg:grid-cols-2">
            
            <div class="flex items-center bg-white rounded shadow-sm justify-between p-5">
                <div class="w-max">
                    <a class="block w-full" href="{{ route('admin.posts.index') }}">
                        <div class="text-sm rounded text-gray-400">Total posts</div>
                        <div class="text-3xl font-medium text-gray-600">{{ $posts }}</div>
                    </a>
                </div>
                <div class="text-pink-500">
                    <a class="block w-full" href="{{ route('admin.posts.index') }}">
                    Svg
                    </a>
                </div>
            </div>

            <div class="flex items-center bg-white shadow-sm justify-between p-5">
                <div>
                <div class="text-sm rounded text-gray-400">Total pages</div>
                    <div class="text-3xl font-medium text-gray-600">{{ $pages }}</div>
                </div>
                <div class="text-pink-500">Svg</div>
            </div>
            
            <!-- Grid ends here -->
        </div>

        <!-- Grid starts here -->
        <div class="mt-8 grid gap-10 sm:grid-col-2 lg:grid-cols-3">
            <div class="md:col-span-2 flex items-center bg-white rounded shadow-sm justify-between p-5">
                <b class="flex flex-row font-bold text-gray-500">Property Release Today</b>
                <!-- <canvas>
                    Cnavas here
                </canvas> -->
            </div>
            <div class="flex items-center bg-white rounded shadow-sm justify-between p-5">
                <b class="flex flex-row font-bold text-gray-500">Occupancy Percentage</b>
                <!-- <canvas>Another canvas</canvas> -->
            </div>
        </div>
        <!-- Another grid ends here -->
        <!-- Table starts here -->
        <div class="mt-8 border-t-2 border-gray-300 font-bold text-gray-600">
            <div class="flex w-full justify-between py-1">
                <span>Clients</span>
                <a class="bg-white rounded-lg py-1 transition ease-in-out duration-1000 px-8 text-white bg-purple-500 hover:bg-purple-700 hover:text-white" href="{{ route('admin.users.index') }}">View all</a>
            </div>
        </div>
        <div class="grid gap-3 lg:grid-cols-2">
            @foreach($users as $user)
            @include('/admin/users/components/list')
            @endforeach
        </div>
        <!-- Table end here -->
    </div>
</div>
@include('/admin/templates/footer')