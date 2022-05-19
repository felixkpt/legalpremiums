@include('/templates/header')
        <h1>All countries</h1>
        @foreach($countries as $country)
            <div class="flex w-1/2 md:w-1/3 bg-slate-200">
                <div class="w-full text-2xl bg-white shadown-lg m-4 rounded-lg">
                    <a class="block w-full p-2 truncate" href="{{ url('countries/'.$country->slug) }}">
                    <img class="w-16 h-16 rounded-full" height="40px" width="40px" src="{{ asset('images/countries/flags/'.(strtolower($country->code) ?? 'default').'.png') }}" alt="Country Flag">    
                    {{ $country->name }}</a>
                </div>
            </div>        
        @endforeach

    @include('/components/pagination')
@include('/templates/footer')