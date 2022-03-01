<x-app-layout>
    <div class="container mx-auto pt-2 flex flex-col flex-col-reverse md:flex-row justify-between p-2">
        <ul class="flex flex-wrap justify-between" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="w-1/2 md:w-auto" role="presentation">
                <button
                    class="{{ $tab == 'summary' ? 'active' : null }} flex flex-row py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg hover:text-blue-600 hover:shadow-md hover:bg-white hover:rounded font-bold"
                    id="profile-tab"
                    data-tabs-target="#profile"
                    type="button"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="{{ $tab == 'summary' ? 'true' : null }}">
                    <svg
                        data-tabs-target="#profile"
                        type="button"
                        aria-controls="profile"
                        aria-selected="{{ $tab == 'summary' ? 'true' : null }}"
                        class="mr-2 w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                    Summary
                </button>
            </li>
            <li class="w-1/2 md:w-auto" role="presentation">
                <button
                    class="{{ $tab == 'year' ? 'active' : null }} flex flex-row py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg hover:text-blue-600 hover:shadow-md hover:bg-white hover:rounded font-bold"
                    id="dashboard-tab"
                    data-tabs-target="#dashboard"
                    type="button"
                    role="tab"
                    aria-controls="dashboard"
                    aria-selected="{{ $tab == 'year' ? 'true' : null }}">
                    <svg
                        data-tabs-target="#dashboard"
                        aria-controls="dashboard"
                        aria-selected="{{ $tab == 'year' ? 'true' : null }}"
                        class="mr-2 w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Year
                </button>
            </li>
        </ul>
        <div class="flex flex-row gap-2">
            <div class="flex justify-between bg-white shadow rounded-lg px-4 py-2 items-center w-full">
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

            <div class="bg-white shadow rounded-lg flex items-center px-2 hover:bg-blue-600 cursor-pointer text-blue-600 hover:text-white">
                <x-dropdown>
                    <x-slot name="trigger">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </x-slot>

                    <x-slot name="content">
                        @if(auth()->user()->hasAccess('platform.index'))
                            <x-dropdown-link :href="route('platform.main')">
                                {{ __('Admin Panel') }}
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <div class="mx-auto container pb-16">
        <div id="myTabContent">
            <div
                class="{{ $tab == 'summary' ? null : 'hidden' }} flex flex-col justify-center md:pt-4 px-4 gap-2"
                id="profile"
                role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="grid grid-cols-6 gap-2">
                    <div class="col-start-2">
                        @include('numerology.dark-category', ['numerology' => $numerology->getDayMaster(), 'palaces' => $palaces])
                    </div>
                    @include('numerology.category', ['numerology' => $numerology->getMindset(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getEducation(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getCulture(), 'palaces' => $palaces])
                </div>
                <div class="grid grid-cols-6 gap-2">
                    @include('numerology.category', ['numerology' => $numerology->getTalent(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getPartner(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getBelief(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getCareer(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getAmbition(), 'palaces' => $palaces])
                    @include('numerology.category', ['numerology' => $numerology->getBusiness(), 'palaces' => $palaces])
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div class="grid grid-cols-2 gap-2">
                        @include('numerology.category', ['numerology' => $numerology->getSpiritual(), 'palaces' => $palaces])
                        @include('numerology.category', ['numerology' => $numerology->getEmotional(), 'palaces' => $palaces])
                        @include('numerology.category', ['numerology' => $numerology->getRelationship(), 'palaces' => $palaces])
                        @include('numerology.category', ['numerology' => $numerology->getSon(), 'palaces' => $palaces])
                        <div class="col-span-2">
                            @include('numerology.category-with-hidden', ['numerology' => $numerology->getCharacter(), 'palaces' => $palaces])
                        </div>
                    </div>
                    <div class="flex flex-col justify-between px-20 gap-2">
                        @include('numerology.category-bigger', ['numerology' => $numerology->getPhysical(), 'palaces' => $palaces])
                        @include('numerology.category-without-year', ['numerology' => $numerology->getGoal(), 'palaces' => $palaces])
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        @include('numerology.category', ['numerology' => $numerology->getSocial(), 'palaces' => $palaces])
                        @include('numerology.category', ['numerology' => $numerology->getIntellectual(), 'palaces' => $palaces])
                        @include('numerology.category', ['numerology' => $numerology->getDaughter(), 'palaces' => $palaces])
                        @include('numerology.category', ['numerology' => $numerology->getFinancial(), 'palaces' => $palaces])
                        <div class="col-span-2">
                            @include('numerology.category-with-hidden', ['numerology' => $numerology->getHealth(), 'palaces' => $palaces, 'swap' => true])
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="{{ $tab == 'year' ? null : 'hidden' }} flex flex-col xl:flex-row justify-center md:pt-4 px-4 gap-4"
                id="dashboard"
                role="tabpanel"
                aria-labelledby="dashboard-tab">
                <div class="p-4 w-full sm:max-w-md md:max-w-full mx-auto bg-white rounded-lg border shadow-md">
                    <div class="flex justify-between">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Monthly Insights</h5>
                        <form action="{{ route('dashboard.index') }}" method="GET">
                            <div class="max-w-sm grid grid-cols-3 gap-4">
                                <input type="hidden" name="tab" value="year">
                                <div class="col-span-2">
                                    <input
                                        name="year"
                                        type="number"
                                        value="{{ $currentYear }}"
                                        placeholder="Year"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-4 p-2.5 datepicker-input">
                                </div>
                                <button
                                    type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-col">
                        <div class="inline-block py-2 min-w-full">
                            <div class="overflow-hidden shadow-md sm:rounded-lg">
                                <table class="min-w-full">
                                    <thead class="bg-gray-200 border-gray-200 font-bold">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-sm font-bold tracking-wider text-left text-gray-700 uppercase text-center">
                                            Year
                                        </th>
                                        @foreach(range(1, 31) as $date)
                                            <th
                                                scope="col"
                                                class="text-center p-1 text-sm font-bold tracking-wider text-left text-gray-700 uppercase {{ $date % 2 == 0 ? 'bg-gray-200' : 'bg-gray-300' }}">
                                                {{ $date }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($months as $month => $cells)
                                        <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                            <td class="text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                                {{ $month }}
                                            </td>
                                            @foreach($cells as $cell)
                                                @foreach($cell[0] as $i => $item)
                                                    <td
                                                        colspan="{{ $item }}"
                                                        class="text-sm font-medium text-gray-900 whitespace-nowrap py-0.5">
                                                        @php
                                                            $traitCode = $year_numerology->{$cell[1]}()->getTraitCodes()[$i];
                                                            $trait = $year_numerology->{$cell[1]}()->getTraits()[$traitCode];
                                                        @endphp
                                                        @include('numerology.category.trait', [
                                                            'trait' => $palaces[$traitCode][0] ?? $trait,
                                                            'backgroundColor' => $palaces[$traitCode][1] ?? '#e5e7eb',
                                                            'color' => $palaces[$traitCode][2] ?? null,
                                                            'buttonClass' => 'p-0.5 rounded-sm'
                                                        ])
                                                    </td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
