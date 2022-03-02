<div class="flex justify-between bg-white shadow rounded-lg px-4 py-2 items-center grow sm:grow-0">
    <div class="w-full flex flex-row items-center basis-1/4">
        <div class="px-4 font-bold">
            DOB
        </div>
    </div>

    <div class="flex flex-row flex-none px-4 gap-2 hidden sm:block">
        {{ $name }}
    </div>

    <div class="shrink-0">
        @include('numerology.date-of-birth-modal')
    </div>
</div>
