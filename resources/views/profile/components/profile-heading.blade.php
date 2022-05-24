<div class="flex flex-wrap justify-center bg-gray-100 space-y-3 px-1 pb-4 rounded">
    <div class="w-full md:w-1/2">
        <div class="flex flex-wrap justify-center">
            <div class="p-2">
                <div class="w-36 h-36 mx-auto rounded-full border-1 border-gray-100">
                    <img class="w-36 h-36 mx-auto rounded-full border-1 border-gray-100" src="{{ $user->avatar ?? asset('images/default-user.png') }}">
                </div>
                <p class="md:text-xl font-medium text-gray-700 text-center">{{ $user->name }}</p>
            </div>
        </div>
    </div>
</div>