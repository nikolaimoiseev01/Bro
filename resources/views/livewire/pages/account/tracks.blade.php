<div class="relative">
    @if(count($tracks) > 0)
    <h2 class="mb-8">Мои треки</h2>
    <div class="flex flex-wrap gap-4">
        @foreach($tracks as $track)
{{--            <livewire:components.account.track :track="$track"></livewire:components.account.track>--}}
            <div class="flex gap-4 items-center bg-black-light border border-grey-main rounded p-2 min-w-80 max-w-min">

                <i id="initial_play_pause_{{$track['id']}}" onclick="play_or_create({{json_encode($track)}})" class="initial_play_pause cursor-pointer ph ph-play-circle"></i>
                <h2 class="!text-xl">{{$track['title']}}</h2>
                <x-heroicon-m-ellipsis-horizontal wire:click="edit_track({{$track['id']}})"
                                                  @click="$store.data.toggle()"
                                                  class="ml-auto cursor-pointer w-8 h-8"/>
            </div>
        @endforeach
    </div>

    @else
        <h2 class="mb-8 text-black-light">В аккаунте еще нет треков</h2> <br>
    @endif

    <x-link @click="$store.data.toggle()" wire:click="create_track()" class="mt-8 button">Добавить трек</x-link>

</div>
