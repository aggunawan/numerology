<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-2">
            <div class="w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <div class="w-full flex flex-row-reverse hidden md:flex">
                <form action="{{ route('dashboard.index') }}" method="GET">
                    <div class="max-w-sm grid grid-cols-3 gap-4">
                        <div class="col-span-2">
                            <input
                                name="birth_date"
                                datepicker=""
                                type="text"
                                value="{{ $birth_date }}"
                                placeholder="Birth Date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-4 p-2.5 datepicker-input">
                        </div>
                        <button
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto md:hidden">
        <div class="py-4">
            <div class="flex justify-center px-4">
                <div class="p-6 w-full sm:max-w-md bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <form>
                        <div class="w-full">
                            <label
                                for="birth_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Birth Date</label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="w-full md:col-span-2">
                                <input
                                    name="birth_date"
                                    datepicker=""
                                    type="text"
                                    value="{{ $birth_date }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input">
                            </div>
                            <div class="w-full">
                                <button
                                    type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="flex flex-row py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 active" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                        <svg class="mr-2 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                        Summary
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="flex flex-row py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                        <svg class="mr-2 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Year
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="mx-auto">
        <div id="myTabContent">
            <div class="flex flex-col xl:flex-row justify-center md:pt-4 px-4 gap-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="flex flex-col justify-center md:grid md:grid-cols-2 gap-4 col-span-5 xl:w-4.5/12">
                    @include('numerology.category', ['numerology' => $numerology->getDayMaster()])
                    @include('numerology.category', ['numerology' => $numerology->getMindset()])
                    @include('numerology.category', ['numerology' => $numerology->getSpiritual()])
                    @include('numerology.category', ['numerology' => $numerology->getBelief()])
                    @include('numerology.category', ['numerology' => $numerology->getPartner()])
                    @include('numerology.category', ['numerology' => $numerology->getEmotional()])
                    @include('numerology.category', ['numerology' => $numerology->getTalent()])
                    @include('numerology.category', ['numerology' => $numerology->getRelationship()])
                    @include('numerology.category', ['numerology' => $numerology->getSon()])
                    @include('numerology.category', ['numerology' => $numerology->getCharacter()])
                </div>
                <div class="flex flex-col flex-auto justify-center gap-4 col-span-3 center">
                    @include('numerology.category', ['numerology' => $numerology->getPhysical()])
                    @include('numerology.dark-category', ['numerology' => $numerology->getGoal()])
                </div>
                <div class="flex flex-col justify-center md:grid md:grid-cols-2 gap-4 col-span-5 xl:w-4.5/12">
                    @include('numerology.category', ['numerology' => $numerology->getEducation()])
                    @include('numerology.category', ['numerology' => $numerology->getCulture()])
                    @include('numerology.category', ['numerology' => $numerology->getIntellectual()])
                    @include('numerology.category', ['numerology' => $numerology->getCareer()])
                    @include('numerology.category', ['numerology' => $numerology->getAmbition()])
                    @include('numerology.category', ['numerology' => $numerology->getSocial()])
                    @include('numerology.category', ['numerology' => $numerology->getBusiness()])
                    @include('numerology.category', ['numerology' => $numerology->getFinancial()])
                    @include('numerology.category', ['numerology' => $numerology->getDaughter()])
                    @include('numerology.category', ['numerology' => $numerology->getHealth()])
                </div>
            </div>
            <div class="flex flex-col xl:flex-row justify-center md:pt-4 px-4 gap-4" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="p-4 w-full sm:max-w-md md:max-w-full mx-auto bg-white rounded-lg border shadow-md">
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
                                            <th scope="col" class="p-1 text-sm font-bold tracking-wider text-left text-gray-700 uppercase">
                                                {{ $date }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td class="text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            January
                                        </td>
                                        <td
                                            colspan="10"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getDayMaster()->getTraits()[$year_numerology->getDayMaster()->getTraitCodes()[0]]])
                                        </td>
                                        <td
                                            colspan="5"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getDayMaster()->getTraits()[$year_numerology->getDayMaster()->getTraitCodes()[1]]])
                                        </td>
                                        <td
                                            colspan="8"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getCulture()->getTraits()[$year_numerology->getCulture()->getTraitCodes()[0]]])
                                        </td>
                                        <td
                                            colspan="8"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getCulture()->getTraits()[$year_numerology->getCulture()->getTraitCodes()[1]]])
                                        </td>
                                    </tr>
                                    <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td class="text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            February
                                        </td>
                                        <td
                                            colspan="9"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getEducation()->getTraits()[$year_numerology->getEducation()->getTraitCodes()[0]]])
                                        </td>
                                        <td
                                            colspan="5"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getEducation()->getTraits()[$year_numerology->getEducation()->getTraitCodes()[1]]])
                                        </td>
                                        <td
                                            colspan="8"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getMindset()->getTraits()[$year_numerology->getMindset()->getTraitCodes()[0]]])
                                        </td>
                                        <td
                                            colspan="6"
                                            class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @include('numerology.category.trait', ['trait' => $year_numerology->getMindset()->getTraits()[$year_numerology->getMindset()->getTraitCodes()[1]]])
                                        </td>
                                    </tr>
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
