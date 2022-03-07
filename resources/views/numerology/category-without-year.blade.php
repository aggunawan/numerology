<div class="p-2 w-full sm:max-w-md md:max-w-full mx-auto bg-gray-800 rounded-lg border shadow-md text-white">
    <div class="flex justify-center mb-2">
        <h3 class="font-bold text-2xl uppercase px-4" style="color: #98FF47;">
            {{ $numerology->getName() }}
        </h3>
    </div>

    <ul class="w-full grid gap-2">
        @foreach($numerology->getTraitCodes() as $i => $trait)
            @php
                $palace = isset($palaces[$trait]) ? $palaces[$trait][0] : $numerology->getTraits()[$trait];
            @endphp
            <li>
                @include('numerology.category.trait', [
                    'trait' => $palace,
                    'modalName' => \Illuminate\Support\Str::camel($numerology->getName() . $palace . ($i + 1)),
                    'color' => isset($palaces[$trait]) ? $palaces[$trait][2] : null,
                    'backgroundColor' => isset($palaces[$trait]) ? $palaces[$trait][1] : null,
                    'buttonClass' => 'p-2'
                ])
            </li>
        @endforeach
    </ul>
</div>
