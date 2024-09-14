@props(['default' => 'Выберите вариант', 'model' => null])
<div x-data="{ fileName: '{{$default}}' }" class="relative inline-block text-left">
    <div>
        <input {{$attributes}} type="file" wire:model="{{$model}}" id="file-upload" class="hidden" @change="fileName = $refs.file.files[0].name" x-ref="file">
        <button @click.prevent="$refs.file.click()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue">
            <span x-text="fileName || 'Выберите файл'"></span>
        </button>
    </div>

{{--    <div x-show="fileName" class="mt-2 text-sm text-gray-700">--}}
{{--        <span>Выбран файл: </span>--}}
{{--        <span x-text="fileName"></span>--}}
{{--    </div>--}}
</div>
