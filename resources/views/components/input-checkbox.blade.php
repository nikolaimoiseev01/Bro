<div class="cursor-pointer min-w-max">
    <input id="{{$model}}" wire:model="{{$model}}" {{ $attributes->merge(['class' => 'cursor-pointer rounded dark:bg-gray-900 dark:border-gray-700 text-indigo-600 border-transparent focus:ring-0 ring-offset-0 ring-0']) }}>
    <label for="{{$model}}" class="cursor-pointer ms-2">{{$text}}</label>
</div>
