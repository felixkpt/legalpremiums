<?php 
$functions = str_split($personality->name);
$map = ['I' => 'Introverted', 'E' => 'Extroverted', 'S' => 'Sensing', 'N' => 'iNtuition', 'F' => 'Feeling', 'T' => 'Thinking', 'J' => 'Judging', 'P' => 'Perceiving'];
?>
<div class="flex flex-wrap w-full sm:w-2/4 md:w-1/3 lg:w-1/4 rounded drop-shadow-lg mb-3">
    <div class="flex w-full justify-center p-1">
        <div class="w-56 h-44 md:w-64 md:h-48 bg-gray-200 overflow-hidden postition-relative">
            <a href="{{ url('typologies/'.$personality->slug) }}">
                <img class="rounded img-fadein" style="height: 100%;width:100%" src="{{ asset($personality->image) }}" alt="ISFP">
                <div style="position: absolute;bottom:3px;">
                    <div class="flex flex-wrap w-full overflow-hidden">
                        <blockquote class="flex w-64">
                            <div class="flex w-full text-lg lg:text-xl">
                                <div class="flex">
                                    <div class="flex flex-nowrap bg-green-300 text-red-600">
                                        <div class="flex bg-gray-200 w-1/2 justify-around pl-1">
                                            <div class="flex flex-wrap">
                                                <div class="font-bold text-left w-full shadow-sm">
                                                    {{ $functions[0] }}
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap">
                                                <div class="font-bold text-center w-full shadow-sm">{{ $functions[1] }}</div>
                                            </div>
                                        </div>
                                        <div class="flex bg-gray-200 w-1/2 justify-around pr-1">
                                            <div class="flex flex-wrap">
                                                <div class="font-bold w-full text-center shadow-sm">{{ $functions[2] }}</div>
                                            </div>
                                            <div class="flex flex-wrap">
                                                <div class="font-bold text-right w-full shadow-sm">{{ $functions[3] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="flex w-full">
                                        <p class="text-white px-1 bg-gray-600">The {{ $personality->strength }}</p>
                                    </div>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>