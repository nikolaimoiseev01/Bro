<div class="flex gap-4 items-center bg-black-light border border-grey-main rounded p-2 min-w-80 max-w-min">

    <i id="initial_play_pause_{{$track['id']}}" onclick="play_or_create({{json_encode($track)}})" class="initial_play_pause cursor-pointer ph ph-play-circle"></i>
    <h2 class="!text-xl">{{$track['title']}}</h2>
    <x-heroicon-m-ellipsis-horizontal wire:click="edit_track({{$track['id']}})"
                                      @click="showDetailed = true"
                                      class="ml-auto cursor-pointer w-8 h-8"/>
</div>
