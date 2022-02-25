<button
    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 text-center"
    type="button"
    data-modal-toggle="dateOfBirthModal">
    Input DOB
</button>

<div id="dateOfBirthModal" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full max-w-2xl h-full md:h-auto">
        @livewire('date-of-birth', ['people' => $people])
    </div>
</div>
