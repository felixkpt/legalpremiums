@include('/templates/header')
<div class="flex flex-col w-full">
    <?php 
    $functions = str_split($person->typology);
    $map = ['I' => 'Introverted', 'E' => 'Extroverted', 'S' => 'Sensing', 'N' => 'iNtuition', 'F' => 'Feeling', 'T' => 'Thinking', 'J' => 'Judging', 'P' => 'Perceiving'];
    ?>
    @include('/people/components/personal-header')
    <div class="w-full bg-teal-50 p-2 rounded-lg">
        <blockquote class="bg-white my-3 px-1 rounded-lg">
            <div class="text-lg bg-white my-3">
                <h1>About {{ $person->first_name.' '.$person->last_name }}</h1>
                <div>
                    {!! $person->content->content !!}
                </div>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="flex bg-gray-100 w-full md:w-1/2 justify-between md:justify-around pl-1 rounded-tl rounded-bl">
                    <div class="flex flex-wrap">
                        <div class="font-bold text-left w-full text-6xl text-red-600 shadow">
                            {{ $functions[0] }}
                        </div>
                        <div class="text-sky-500">
                        {{ $map[$functions[0]] }}
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="font-bold text-right md:text-left w-full text-6xl text-red-600 shadow">{{ $functions[1] }}</div>
                        <div class="w-full md:w-auto text-right md:text-left text-sky-500">{{ $map[$functions[1]] }}</div>
                    </div>
                </div>
                <div class="flex bg-gray-100 w-full md:w-1/2 justify-between md:justify-around pr-1 rounded-tr rounded-br">
                    <div class="flex flex-wrap">
                        <div class="font-bold w-full text-left text-6xl text-red-600 shadow">{{ $functions[2] }}</div>
                        <div class="text-sky-500">{{ $map[$functions[2]] }}</div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="font-bold text-right md:text-left w-full text-6xl text-red-600 shadow">{{ $functions[3] }}</div>
                        <div class="w-full text-sky-500 text-right md:text-left">{{ $map[$functions[3]] }}</div>
                    </div>
                </div>
            </div>
            @include('/people/components/vote-typology')
            <p class="text-lg">
                <?php echo substr(strip_tags( $person->personality->profession), 0, 200) ?>
            </p>
        </blockquote>
        <div class="flex w-full my-8 justify-center">
            <div class="flex">
                <a class="text-2xl bg-white rounded-lg py-2 transition ease-in-out duration-1000 px-8 text-sky-400 hover:bg-gray-700 hover:text-white" href="{{ url('people/typologies/'.$person->personality->slug.'s') }}">More {{ $person->personality->name }}s</a>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')
