<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-2">
            <div class="w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <div class="w-full flex flex-row-reverse hidden md:flex">
                <form>
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

    <div class="mx-auto">
        <div class="flex flex-col xl:flex-row justify-center md:pt-4 px-4 gap-4">
            <div class="flex flex-col justify-center md:grid md:grid-cols-2 gap-4 col-span-5 xl:w-4.5/12">
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
            </div>
            <div class="flex flex-col flex-auto justify-center gap-4 col-span-3 center">
                @include('numerology.category')
                @include('numerology.dark-category')
            </div>
            <div class="flex flex-col justify-center md:grid md:grid-cols-2 gap-4 col-span-5 xl:w-4.5/12">
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
                @include('numerology.category')
            </div>
        </div>
    </div>
</x-app-layout>
