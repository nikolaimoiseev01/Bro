<div x-data="{ showTracks: false, showCart: false }" class="w-full max-w-md rounded overflow-hidden">
    <div class="relative overflow-hidden">
        <img src="{{$mixtape->getFirstMediaUrl('cover')}}" class="" alt="">
        <div x-show="showTracks" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="absolute top-0 left-0 w-full h-full bg-black-light flex flex-col gap-2 overflow-auto p-6">

            @foreach($mixtape->MixtapeParticipation as $part)
                @php
                    $track = $part->track;
                    $track->mp3 = $track->getFirstMediaUrl('mp3');
                    $jsonTrack = json_encode($track);
                @endphp
                <div class="cursor-pointer text-lg border-b border-grey-light pb-1 flex gap-1 items-center"
                     onclick="play_or_create({{$jsonTrack}})">
                    <i id="initial_play_pause_{{$track['id']}}" data-track-id="{{$track['id']}}" class="initial_play_pause ph ph-play !text-lg "></i>
                    <span>{{$track['title']}}: {{$track['artist_name']}}</span>
                </div>
            @endforeach
        </div>

        <div x-show="showCart" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full" class="absolute top-0 left-0 w-full h-full bg-black-light flex flex-col gap-2 overflow-auto p-3">

            @foreach($mixtape['streamings'] as $straming)
                <div> {{$straming['service']}}</div>
            @endforeach
        </div>

    </div>

    <div class="flex justify-between bg-grey-main px-4 py-1">
        <i @click="showTracks = !showTracks; showCart = false" class='cursor-pointer ph ph-list !text-black-main cursor-pointer'></i>
        <i class='bx bxl-play-store !text-black-main'></i>
        <i @click="showCart = !showCart; showTracks = false;" class='cursor-pointer ph ph-shopping-cart-simple !text-black-main'></i>
    </div>
</div>
