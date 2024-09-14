<div>
    <h2 class="mb-8">Создание заявки на размещение</h2>

    <div class="flex max-w-fit gap-4 mb-4 bg-black-light rounded p-6 justify-between">
        <x-dropdown default="Выбери трек для участия" :options="$tracks"
                    model="chosen_track"/>
        <x-link @click="$store.data.toggle()" wire:click="create_track()" class="simple">Добавить трек</x-link>
        {{--        <img src="{{$mixtape->getFirstMediaUrl('cover')}}" class="max-w-60" alt="">--}}
    </div>
    <x-link class="button loader" wire:click="save">Сохранить</x-link>
</div>
