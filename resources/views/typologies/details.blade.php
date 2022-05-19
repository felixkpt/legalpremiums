@include('/templates/header')
<?php 
$functions = str_split($personality->name);
$map = ['I' => 'Introverted', 'E' => 'Extroverted', 'S' => 'Sensing', 'N' => 'iNtuition', 'F' => 'Feeling', 'T' => 'Thinking', 'J' => 'Judging', 'P' => 'Perceiving'];
?>
<div class="flex flex-col w-full">
    <figure style="background: radial-gradient(#00000029, transparent);" class="w-full h-full lg:flex bg-slate-50 rounded-xl overflow-hidden">
        <div class="md:h-4/5 md:w-1/4 overflow-hidden mx-auto">
            <div class="w-52 h-44 mx-auto md:mx-0">
                <img style="min-height: 100px!important" class="h-full mx-auto rounded-lg md:rounded-none" src="{{ asset($personality->image) }}" alt="">
            </div>
            <div class="w-full pt-1">
                @include('/components/social-media-links')
            </div>
        </div>
        <div class="pt-6 md:p-4 md:w-3/4 text-center md:text-left space-y-4">
            <blockquote>
                <div class="flex flex-nowrap">
                    <div class="flex bg-gray-200 w-1/2 justify-around pl-1 rounded-tl rounded-bl">
                        <div class="flex flex-wrap">
                            <div class="font-bold text-left w-full text-6xl text-red-600 shadow-sm">
                                {{ $functions[0] }}
                            </div>
                            <div class="text-sky-500 hidden sm:block">
                            {{ $map[$functions[0]] }}
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="font-bold text-center w-full text-6xl text-red-600 shadow-sm">{{ $functions[1] }}</div>
                            <div class="w-full text-sky-500 text-center hidden sm:block">{{ $map[$functions[1]] }}</div>
                        </div>
                    </div>
                    <div class="flex bg-gray-200 w-1/2 justify-around pr-1 rounded-tr rounded-br">
                        <div class="flex flex-wrap">
                            <div class="font-bold w-full text-center text-6xl text-red-600 shadow-sm">{{ $functions[2] }}</div>
                            <div class="w-full text-sky-500 text-center hidden sm:block">{{ $map[$functions[2]] }}</div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="font-bold text-right w-full text-6xl text-red-600 shadow-sm">{{ $functions[3] }}</div>
                            <div class="w-full text-sky-500 text-right hidden sm:block">{{ $map[$functions[3]] }}</div>
                        </div>
                    </div>
                </div>
                <p class="text-lg font-medium overflow-hidden">
                        <?php echo substr(strip_tags( $personality->description), 0, 200) ?>
                </p>
            </blockquote>
            <figcaption class="font-medium">
                <div class="text-yellow-400 text-xl dark:text-slate-500">
                    <span class="border-l-4 pl-1 border-yellow-400 text-sky-400">{{  $personality->name }}s</span>
                    are known to be {{  $personality->strength }}s, this group comprises  {{  $personality->prevalence }}% of the total population
                </div>
            </figcaption>
        </div>
    </figure>

    <div class="w-full bg-teal-50 rounded-lg">
        @include('/people/components/people-header')
        <div class="flex w-full my-8 justify-center">
            <div class="flex">
                <a class="text-2xl bg-white rounded-lg py-2 transition ease-in-out duration-1000 px-8 text-sky-400 hover:bg-gray-700 hover:text-white" href="{{ url('people/typologies/'.$personality->slug.'s') }}">More {{ $personality->name }}s</a>
            </div>
        </div>
    </div>
</div>@include('/templates/footer')
