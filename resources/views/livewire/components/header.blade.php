<header
    x-data="{ showHeader: false, currentUrl: window.location.href }"
    x-init="if (window.location.pathname === '/') { window.addEventListener('scroll', () => { showHeader = window.scrollY > window.innerHeight; }); } else { showHeader = true; }"
    :class="{ 'show': showHeader, 'hide': !showHeader }"
    class="h-20"
>
    <div class="content">
        <a href="/" wire:navigate>
            <x-application-logo class="white"/>
        </a>
        <div class="menu">
            <a :class="{ 'active': currentUrl.startsWith($el.href) }" class="link simple" href="{{route('portal.beats')}}" wire:navigate>Биты</a>
            <a :class="{ 'active': currentUrl.startsWith($el.href) }" class="link simple" href="/#about" wire:navigate>О нас</a>
            <a :class="{ 'active': currentUrl.startsWith($el.href) }" class="link simple" href="/#about" wire:navigate>Как это работает</a>
            @auth()
                <x-link class="button shadow" href="{{route('account.mixtapes')}}" wire:navigate>Личный кабинет</x-link>
            @else
                <x-link class="button shadow" href="{{route('account.settings')}}">Войти</x-link>
            @endauth
        </div>
    </div>
</header>

{{--<div>--}}
{{--    <nav x-data="{ open: false }" class="bg-black dark:bg-gray-800 border-b border-grey-main dark:border-gray-700">--}}
{{--        <!-- Primary Navigation Menu -->--}}
{{--        <div class="content">--}}
{{--            <div class="flex justify-between h-20">--}}
{{--                <!-- Logo -->--}}
{{--                <div class="shrink-0 flex items-center">--}}
{{--                    <a href="/" wire:navigate>--}}
{{--                        <x-application-logo class="white"/>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="flex">--}}
{{--                    <!-- Navigation Links -->--}}
{{--                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">--}}
{{--                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>--}}
{{--                            {{ __('Dashboard') }}--}}
{{--                        </x-nav-link>--}}
{{--                    </div>--}}

{{--                    <!-- Settings Dropdown -->--}}

{{--                    <div class="hidden sm:flex sm:items-center sm:ms-6">--}}
{{--                        <x-dropdown align="right" width="48">--}}
{{--                            <x-slot name="trigger">--}}
{{--                                @auth()--}}
{{--                                    <x-link href="/login" class="test">Личный кабинет</x-link>--}}
{{--                                @else--}}
{{--                                    <x-link href="{{route('account.settings')}}" class="shadow">Войти</x-link>--}}
{{--                                @endauth--}}
{{--                            </x-slot>--}}

{{--                            <x-slot name="content">--}}
{{--                                <x-dropdown-link :href="route('profile')" wire:navigate>--}}
{{--                                    {{ __('Profile') }}--}}
{{--                                </x-dropdown-link>--}}

{{--                                <!-- Authentication -->--}}
{{--                                <button wire:click="logout" class="w-full text-start">--}}
{{--                                    <x-dropdown-link>--}}
{{--                                        {{ __('Log Out') }}--}}
{{--                                    </x-dropdown-link>--}}
{{--                                </button>--}}
{{--                            </x-slot>--}}
{{--                        </x-dropdown>--}}
{{--                    </div>--}}

{{--                    <!-- Hamburger -->--}}
{{--                    <div class="-me-2 flex items-center sm:hidden">--}}
{{--                        <button @click="open = ! open"--}}
{{--                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">--}}
{{--                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"--}}
{{--                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                      d="M4 6h16M4 12h16M4 18h16"/>--}}
{{--                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"--}}
{{--                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                      d="M6 18L18 6M6 6l12 12"/>--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Responsive Navigation Menu -->--}}
{{--        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--            <div class="pt-2 pb-3 space-y-1">--}}
{{--                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"--}}
{{--                                       wire:navigate>--}}
{{--                    {{ __('Dashboard') }}--}}
{{--                </x-responsive-nav-link>--}}
{{--            </div>--}}

{{--            <!-- Responsive Settings Options -->--}}
{{--            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">--}}
{{--                <div class="px-4">--}}
{{--                    <div class="font-medium text-base text-gray-800 dark:text-gray-200"--}}
{{--                         x-data="{{ json_encode(['name' => auth()->user()->name ?? 'test']) }}" x-text="name"--}}
{{--                         x-on:profile-updated.window="name = $event.detail.name"></div>--}}
{{--                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email ?? 'test' }}</div>--}}
{{--                </div>--}}

{{--                <div class="mt-3 space-y-1">--}}
{{--                    <x-responsive-nav-link :href="route('profile')" wire:navigate>--}}
{{--                        {{ __('Profile') }}--}}
{{--                    </x-responsive-nav-link>--}}

{{--                    <!-- Authentication -->--}}
{{--                    <button wire:click="logout" class="w-full text-start">--}}
{{--                        <x-responsive-nav-link>--}}
{{--                            {{ __('Log Out') }}--}}
{{--                        </x-responsive-nav-link>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--</div>--}}
