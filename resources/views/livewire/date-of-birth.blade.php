<div class="relative bg-white rounded-lg shadow">
    <div class="p-6 grid grid-cols-12 gap-2">
        <div class="flex flex-col gap-2 col-span-5">
            @if($this->list)
                @foreach($this->list->content as $i => $content)
                    <button
                        wire:click="removeList({{ $i }})"
                        class="flex flex-col items-center p-3 text-base font-bold text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-100 group hover:shadow">
                        <strong>{{ $content['name'] }}</strong>
                        <small>{{ now()->parse($content['date'])->format('d F Y') }}</small>
                    </button>
                @endforeach
            @endif
        </div>

        <div class="flex flex-col gap-2 col-span-7">
            @if($this->has_list)
                <div class="flex flex-col gap-2">
                    <label for="people" class="block text-sm font-medium text-gray-900">People Database</label>
                    <select
                        wire:model="selectedPerson"
                        id="people"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                        <option value="">Select from database</option>
                        @foreach($people as $id => $person)
                            <option value="{{ $id }}">{{ $person }}</option>
                        @endforeach
                    </select>

                    <button
                        type="submit"
                        wire:click="addFromList"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Save</button>
                </div>
            @endif

            <div class="flex flex-col gap-2">
                <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                <input
                    wire:model="personName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                    type="text">
            </div>

            <div class="w-full grid grid-cols-4 gap-2">
                <div class="flex flex-col gap-2">
                    <label class="block text-sm font-medium text-gray-900">Date</label>
                    <select
                        wire:model="selectedDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                        @foreach($this->date as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full col-span-2 flex flex-col gap-2">
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
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Save</button>
            </div>
        </div>
    </div>

    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
        <a
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center"
            href="{{ route('dashboard.index') }}">
            Recalculate
        </a>
    </div>
</div>
