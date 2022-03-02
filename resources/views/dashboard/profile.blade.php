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
