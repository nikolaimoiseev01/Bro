<div x-data="{ showDetailed: false }">
    @if(count($parts) > 0)
        <div class="mt-8 flex gap-8">
            @foreach($parts as $part)
                <div class="flex flex-col w-fit">
                    <div class="relative">
                        <img src="{{$part->mixtape->getFirstMediaUrl('cover')}}" class="max-w-64" alt="">
                        <div
                            class="absolute left-1/2 -z-10 -top-2 -translate-x-1/2 border border-grey-main w-60 h-60 rounded-xl"></div>
                        <div
                            class="absolute left-1/2 -z-10 -top-4 -translate-x-1/2 border border-grey-light w-52 h-52 rounded-xl"></div>
                    </div>
                    <div class="px-4 py-1 border rounded flex justify-between items-center">
                        <h2 class="text-2xl">{{$part->mixtape['title']}}</h2>
                        <x-heroicon-m-ellipsis-horizontal wire:click="choose_part({{$part['id']}})"
                                                          @click="showDetailed = true"
                                                          class="cursor-pointer w-8 h-8"/>
                    </div>
                </div>
            @endforeach

            <div x-show="showDetailed"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 @click.outside="showDetailed = false"
                 class="fixed mt-20 right-0 top-0 z-10 h-screen bg-black-light border-l min-w-128">
                <div wire:loading class="absolute w-full h-full z-30">
                    <div class="w-full h-full bg-black-main/75 flex justify-center items-center">
                        <x-preloader></x-preloader>
                    </div>
                </div>
                <div class="relative py-4 px-8">
                    <h2 class="mb-8">Подробнее</h2>
                    @if($chosen_part)
                        <div class="flex flex-col gap-2">
                            <span><b>Артист: </b> {{$chosen_part['artist_name']}}</span>
                            <span><b>Трек: </b> {{$chosen_part->track['title']}}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <h2 class="text-black-light">Еще нет микстейпов, в которых я участвую</h2>
    @endif
</div>
