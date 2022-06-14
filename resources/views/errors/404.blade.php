@include('/templates/header')
<div class="flex flex-col w-full">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1 class="text-3xl">404 Not found</h1>
            </div>
            <p class="text-xl font-bold text-gray-600">The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a class="text-yellow-900 hover:text-yellow-700" href="{{ url('') }}">Return to homepage</a></p>
        </div>
    </div>
</div>
@include('/templates/footer')