<div class="p-4 w-full sm:max-w-md md:max-w-full mx-auto bg-gray-600 rounded-lg border shadow-md sm:p-6">
    <div class="flex justify-between">
        <h3 class="mb-3 text-base font-semibold text-white lg:text-xl">
            {{ $numerology->getName() }}
        </h3>
    </div>

    <ul class="my-4 space-y-3">
        @foreach($numerology->getTraits() as $trait)
            <li>
                <button
                    type="button"
                    class="w-full text-left flex items-center p-3 text-base font-bold text-gray-900 bg-white rounded-lg hover:bg-gray-100 group hover:shadow">
                <span class="bg-gray-400 text-white text-sm font-semibold inline-flex items-center p-1.5 rounded-full mr-2">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                </span>
                    <span class="flex-1 ml-3 whitespace-nowrap">{{ $trait }}</span>
                </button>
            </li>
        @endforeach
    </ul>
</div>
