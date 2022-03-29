<div class="relative bg-white rounded-lg shadow">
    <div class="flex flex-col-reverse p-4 lg:p-6 sm:grid sm:grid-cols-12 gap-2">
        <div class="w-full flex flex-col {{ $this->has_list ? 'col-span-3' : 'hidden' }} gap-2">
            @if($this->has_list)
                <div class="flex flex-col gap-2">
                    <label for="people" class="block text-sm font-medium text-gray-900">People Database</label>
                    <livewire:person-select
                        name="selectedPerson"
                        placeholder="Select"
                        class="p-2 rounded border w-full appearance-none p-3 hover:bg-gray-100 text-gray-900 cursor-pointer text-sm bg-indigo-600 text-white font-medium bg-white text-gray-600 absolute top-0 left-0 mt-12 w-full z-10 bg-gray-400 font-bolder"
                        :searchable="true"></livewire:person-select>
                    <button
                        type="submit"
                        wire:click="addFromList"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                        Upload
                    </button>
                </div>
            @endif
        </div>

        <div class="w-full flex flex-col {{ $this->has_list ? 'col-span-5' : 'col-span-6' }} gap-2">
            <div class="flex flex-col gap-2">
                <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                <input
                    wire:model="personName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                    type="text">
            </div>

            <div class="w-full grid grid-cols-3 gap-2">
                <div class="w-full flex flex-col gap-2">
                    <label class="block text-sm font-medium text-gray-900">Date</label>
                    <select
                        wire:model="selectedDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                        @foreach($this->date as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label class="block text-sm font-medium text-gray-900">Month</label>
                    <select
                        wire:model="selectedMonth"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                        @foreach($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label class="block text-sm font-medium text-gray-900">Year</label>
                    <input
                        wire:model="selectedYear"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                        type="number">
                </div>
            </div>

            <div class="w-full">
                <button
                    type="submit"
                    wire:click="storeList"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                    Upload
                </button>
            </div>
        </div>

        <div class="w-full flex flex-col {{ $this->has_list ? 'col-span-4' : 'col-span-6' }} gap-2">
            <p class="mb-0">DOB List</p>
            @if($this->list)
                @foreach($this->list->content as $i => $content)
                    <div
                        class="flex flex-col p-3 text-base font-bold text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-100 group hover:shadow">
                        <strong>{{ $content['name'] }}</strong>
                        <div class="w-full flex flex-row justify-between">
                            <small>{{ now()->parse($content['date'])->format('d F Y') }}</small>
                            <button
                                wire:click="removeList({{ $i }})"
                                class="hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
        <button
            data-modal-toggle="dateOfBirthModal"
            type="button"
            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
            Close
        </button>
        <button
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center"
            wire:click="recalculate">
            Recalculate
        </button>
    </div>
</div>
