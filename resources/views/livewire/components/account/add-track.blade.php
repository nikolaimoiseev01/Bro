<div x-data x-show="$store.data.showAddTrack"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
     x-transition:leave-end="translate-x-full"
     @click.outside="$store.data.toggle(); $wire.hide_form()"
     class="fixed mt-20 right-0 top-0 z-10 h-screen bg-black-light border-l min-w-128">

    @if($open_form)

        <div class="relative py-4 px-8">

            <x-heroicon-c-x-circle wire:click="hide_form()"
                                   @click="$store.data.toggle()"
                                   class="cursor-pointer w-6 absolute top-3 -left-3 bg-black-main rounded-full"/>

            <h2 class="mb-4">
                @if($form_type == 'create')
                    Добавить трек
                @else
                    Редактировать трек
                @endif
            </h2>

            <form @if($form_type == 'create')
                      wire:submit="add()"
                  @else
                      wire:submit="save()"
                  @endif
                  class="flex flex-col gap-4">
                <x-input-text required text="" wire:model="artist_name" type="text" placeholder="Артист"/>

                <x-input-text required text="" wire:model="title" type="text" placeholder="Название"/>

                <x-input-text required text="" wire:model="language" type="text" placeholder="Язык" value="Русский"/>

                <x-input-text required text="" wire:model="feats" type="text" placeholder="Это фит с"/>

                <x-input-text required text="" wire:model="composer" type="text" placeholder="Композитор"/>

                <x-input-text required text="" wire:model="text" type="text" placeholder="Текс"/>

                <div class="flex gap-4 items-center">
                    <x-input-checkbox text="18+" model="flg_adult" class="min-w-max" type="checkbox"/>

                    <x-input-text text="" wire:model="isrc" type="text" placeholder="isrc"/>
                </div>

                <select wire:model="copyright_var">
                    <option value="">Доказательство прав</option>
                    @foreach($copyright_vars as $key => $var)
                        <option value="{{$key}}">{{$var}}</option>
                    @endforeach
                </select>

{{--                <x-dropdown default="Доказательство прав" :options="$copyright_vars" model="copyright_var"/>--}}

                <select wire:model="genre">
                    <option value="">Жанр</option>
                    @foreach($genres as $key => $var)
                        <option value="{{$key}}">{{$var}}</option>
                    @endforeach
                </select>

                @if($form_type == 'create')
                    <x-input-file accept=".mp3,audio/*" default="Прикрепить файл" model="file"/>
                @endif


                <button class="link !w-full loader button">
                    @if($form_type == 'create')
                        Добавить
                    @else
                        Сохранить
                    @endif
                </button>

            </form>
        </div>
    @else
        <div wire:loading class="absolute w-full h-full z-30">
            <div class="w-full h-full bg-black-main/75 flex justify-center items-center">
                <x-preloader></x-preloader>
            </div>
        </div>
    @endif
</div>
