<div class="p-2 w-full sm:max-w-md md:max-w-full mx-auto bg-gray-200 rounded-lg border shadow-md">
    <div class="flex justify-between">
        <p class="text-sm font-extrabold uppercase px-2 mb-0">
            {{ $numerology->getName() }}
        </p>
        <div class="w-auto">
            <strong>{{ $numerology->getYear() }}</strong>
        </div>
    </div>

    <ul class="w-full grid gap-1">
        @foreach($numerology->getTraitCodes() as $trait)
            <li>
                @include('numerology.category.trait', [
                    'trait' => isset($palaces[$trait]) ? $palaces[$trait][0] : $numerology->getTraits()[$trait],
                    'color' => isset($palaces[$trait]) ? $palaces[$trait][2] : null,
                    'backgroundColor' => isset($palaces[$trait]) ? $palaces[$trait][1] : null,
                ])
            </li>
        @endforeach
    </ul>
</div>
