<x-app-layout>
    @include('dashboard.topbar')

    <div class="mx-auto container pb-16">
        <div id="myTabContent">
            <div
                class="{{ $tab == 'summary' ? null : 'hidden' }} flex flex-col justify-center md:pt-4 px-4 gap-2"
                id="profile"
                role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="lg:grid lg:grid-cols-6 gap-2 hidden">
                    <div class="col-start-2">
                        @include('numerology.dark-category', ['numerology' => $numerology->getDayMaster(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    </div>
                    @include('numerology.category', ['numerology' => $numerology->getMindset(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getEducation(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getCulture(), 'palaces' => $palaces, 'year' => $highlightedYear])
                </div>
                <div class="lg:grid lg:grid-cols-6 gap-2 hidden">
                    @include('numerology.category', ['numerology' => $numerology->getTalent(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getPartner(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getBelief(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getCareer(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getAmbition(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    @include('numerology.category', ['numerology' => $numerology->getBusiness(), 'palaces' => $palaces, 'year' => $highlightedYear])
                </div>
                <div class="lg:grid lg:grid-cols-3 gap-2 hidden">
                    <div class="grid grid-cols-2 gap-2">
                        @include('numerology.category', ['numerology' => $numerology->getSpiritual(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getEmotional(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getRelationship(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getSon(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        <div class="col-span-2">
                            @include('numerology.category-with-hidden', ['numerology' => $numerology->getCharacter(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        </div>
                    </div>
                    <div class="flex flex-col justify-between px-20 gap-2">
                        @include('numerology.category-bigger', ['numerology' => $numerology->getPhysical(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category-without-year', ['numerology' => $numerology->getGoal(), 'palaces' => $palaces])
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        @include('numerology.category', ['numerology' => $numerology->getSocial(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getIntellectual(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getDaughter(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getFinancial(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        <div class="col-span-2">
                            @include('numerology.category-with-hidden', ['numerology' => $numerology->getHealth(), 'palaces' => $palaces, 'swap' => true, 'year' => $highlightedYear])
                        </div>
                    </div>
                </div>
                <div class="flex lg:hidden justify-center">
                    <div class="grid grid-cols-2 gap-2 grow max-w-md">
                        @include('numerology.dark-category', ['numerology' => $numerology->getDayMaster(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getCulture(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getMindset(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getEducation(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getBelief(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getCareer(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getPartner(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getAmbition(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getTalent(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getBusiness(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getSpiritual(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getIntellectual(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getEmotional(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getSocial(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getRelationship(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getFinancial(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getSon(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category', ['numerology' => $numerology->getDaughter(), 'palaces' => $palaces, 'year' => $highlightedYear])
                    </div>
                </div>
                <div class="flex lg:hidden justify-center">
                    <div class="grid gap-2 grow max-w-md">
                        @include('numerology.category-with-hidden', ['numerology' => $numerology->getCharacter(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category-with-hidden', ['numerology' => $numerology->getHealth(), 'palaces' => $palaces, 'swap' => true, 'year' => $highlightedYear])
                        @include('numerology.category-bigger', ['numerology' => $numerology->getPhysical(), 'palaces' => $palaces, 'year' => $highlightedYear])
                        @include('numerology.category-without-year', ['numerology' => $numerology->getGoal(), 'palaces' => $palaces])
                    </div>
                </div>
            </div>
            <div
                class="{{ $tab == 'year' ? null : 'hidden' }} flex flex-col xl:flex-row justify-center md:pt-4 px-4 gap-4"
                id="dashboard"
                role="tabpanel"
                aria-labelledby="dashboard-tab">
                <div class="p-4 w-full sm:max-w-md md:max-w-full mx-auto bg-white rounded-lg border shadow-md">
                    <div class="flex flex-col md:flex-row justify-between">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Monthly Insights</h5>
                        <form action="{{ route('dashboard.index') }}" method="GET">
                            <div class="max-w-sm grid grid-cols-3 gap-4">
                                <input type="hidden" name="tab" value="year">
                                <div class="col-span-2">
                                    <input
                                        name="year"
                                        type="number"
                                        value="{{ $currentYear }}"
                                        placeholder="Year"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-4 p-2 datepicker-input">
                                </div>
                                <button
                                    type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2 text-center">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-col">
                        <div class="inline-block py-2 min-w-full">
                            <div class="overflow-x-auto shadow-md rounded-lg">
                                <table class="min-w-full">
                                    <thead class="bg-gray-200 border-gray-200 font-bold">
                                    <tr>
                                        <th scope="col" class="py-2 text-sm font-bolder tracking-wider text-left text-gray-700 uppercase text-center">
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

    @foreach($descriptions as $palace => $items)
        @foreach($items as $i => $item)
            @if(!empty($item))
                @include('numerology.palace-modal', [
                    'name' => \Illuminate\Support\Str::camel($palace . $item['title'] . ($i + 1)),
                    'title' => $item['title'],
                    'description' => $item['description']
                ])
            @endif
        @endforeach
    @endforeach
</x-app-layout>
