<div class="p-2 w-full sm:max-w-md md:max-w-full mx-auto bg-white rounded-lg shadow-md">
    <div class="flex flex-col px-2">
        <p class="text-lg mb-2">{{ $title }}</p>

        <div class="grid gap-2">
            @foreach($palaceDescription as $description)
                <div class="flex flex-col">
                    <p class="text-sm">{{ $description['title'] }}</p>
                    <p class="text-sm text-gray-600">{{ $description['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
