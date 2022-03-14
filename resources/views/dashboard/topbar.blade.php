<div class="container mx-auto pt-2 flex flex-col flex-col-reverse lg:grid lg:grid-cols-6 p-2">
    @include('dashboard.tab', ['hideYear' => $hideYear])

    <div class="flex flex-row col-span-4 justify-center gap-2">
        @include('dashboard.dob')
        <div class="grid lg:hidden">
            @include('dashboard.profile')
        </div>
    </div>

    <div class="hidden lg:flex lg:flex-row justify-end">
        @include('dashboard.profile')
    </div>
</div>
