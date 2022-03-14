<x-app-layout>
    @include('dashboard.topbar', ['hideYear' => is_null($year_numerology)])

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

            @if(!is_null($year_numerology))
            <div
                class="{{ $tab == 'year' ? null : 'hidden' }} flex flex-col xl:flex-row justify-center md:pt-4 px-4 gap-4"
                id="dashboard"
                role="tabpanel"
                aria-labelledby="dashboard-tab">
                @include('numerology.yearly')
            </div>
            @endif
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
