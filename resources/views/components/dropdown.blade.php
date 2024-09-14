@props(['options' => [], 'model' => null, 'default' => 'Выберите вариант'])

<div x-data="{ open: false, selected_text: '{{$default}}' }" class="relative inline-block text-left">
    <div>
        <button @click="open = ! open" @click.outside="open = false" type="button"
                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-black-main bg-grey-main border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span x-text="selected_text || '{{ $default }}'"></span>
            <x-heroicon-o-chevron-down class="-mr-1 ml-2 h-5 w-5"/>
        </button>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute left-1/2 -translate-x-1/2 z-50 mt-2 w-56 origin-top-right bg-grey-main border border-gray-300 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            @foreach($options as $key => $option)
                <a @click="selected_text = '{{ $option }}'; open = false" wire:click="$set('{{ $model }}', {{$key}})" href="#" class="text-black-main block px-4 py-2 text-sm hover:bg-blue hover:text-grey-main" role="menuitem" tabindex="-1" id="menu-item-0">
                    {{ $option }}
                </a>
            @endforeach
        </div>
    </div>
</div>
