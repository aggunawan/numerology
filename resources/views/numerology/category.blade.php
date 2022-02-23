<div class="p-4 w-full sm:max-w-md md:max-w-full mx-auto bg-white rounded-lg border shadow-md sm:p-6">
    <div class="flex justify-between">
        <h3 class="mb-3 text-base font-semibold text-gray-900 lg:text-xl">
            {{ $numerology->getName() }}
        </h3>
        <div class="w-auto">
            <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                <strong>{{ $numerology->getYear() }}</strong>
            </span>
        </div>
    </div>

    <ul class="my-4 space-y-3">
        @foreach($numerology->getTraitCodes() as $trait)
            <li>
                @include('numerology.category.trait', [
                    'trait' => isset($palaces[$trait]) ? $palaces[$trait][0] : $numerology->getTraits()[$trait],
                    'color' => isset($palaces[$trait]) ? $palaces[$trait][1] : '#e5e7eb',
                ])
            </li>
        @endforeach
    </ul>
</div>
