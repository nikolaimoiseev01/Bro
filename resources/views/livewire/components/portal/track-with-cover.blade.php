<div class="flex flex-col group">
    <div class="relative">
        <img src="{{$track->getFirstMediaUrl('cover')}}" class="w-64" alt="">
        <div class="absolute top-0 left-0 w-full h-full bg-black-light bg-opacity-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible flex justify-center items-center transition-all duration-100 ease-in-out">
            <i id="initial_play_pause_{{$track['id']}}" onclick="play_or_create({{json_encode($track)}})" class="initial_play_pause cursor-pointer  !text-7xl ph ph-play-circle"></i>
        </div>
    </div>

    <div class="flex flex-col bg-black-light gap-1 p-2 rounded-b">
        <h2 class="text-base">{{$track['artist_name']}}</h2>
        <p>{{mb_strimwidth($track['title'], 0, 16, "...")}}</p>
        <a href="" class="link siple" wire:click.prevent="make_sale({{$track['id']}})">Купить</a>
    </div>
</div>
