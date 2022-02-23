<div class="p-4 w-full sm:max-w-md md:max-w-full mx-auto bg-gray-600 rounded-lg border shadow-md sm:p-6">
    <div class="flex justify-between">
        <h3 class="mb-3 text-base font-semibold text-white lg:text-xl">
            {{ $numerology->getName() }}
        </h3>
    </div>

    <ul class="my-4 space-y-3">
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
