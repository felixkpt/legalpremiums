@include('/templates/header')
    <div class="flex w-full bg-slate-100 mb-2 rounded-lg">
        <div class="w-full text-2xl bg-white shadown-lg m-4 rounded-lg">
            <div class="flex w-full p-2">
                <img class="flex w-16 h-16 rounded-full pr-2" height="40px" width="40px" src="{{ asset('images/countries/flags/'.(strtolower($country->code) ?? 'default').'.png') }}" alt="Country Flag">    
                <h1 class="flex items-center">People from {{ $country->name }}</h1>
            </div>
        </div>
    </div>
    @include('/people/components/people-header')
@include('/templates/footer')