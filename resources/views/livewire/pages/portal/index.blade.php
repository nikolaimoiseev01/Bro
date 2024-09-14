<page-content>
    <section style="background-image: url('/assets/fixed/welcome_image.png');" class="bg-cover relative h-dvh">

        @auth()
            <x-link href="{{route('account.settings')}}" class="button !absolute top-8 right-8 brown" wire:nagivate>
                Личный кабинет
            </x-link>
        @else
            <x-link href="{{route('login')}}" class="button !absolute top-8 right-8 brown">Войти</x-link>
        @endauth

        <div class="pt-16 flex gap-8 justify-center items-center flex-col">
            <h3 class="tracking-wider text-brown text-xl font-thin">НЕЗАВИСИМЫЙ ЛЕЙБЛ</h3>
            <x-application-logo class="w-96"/>
            <h3 class="text-brown text-3xl">Мы объединяем комьюнити</h3>
        </div>

        <div class="bg-gradient-to-b from-transparent to-black-main to-85% absolute bottom-0 w-full h-60"></div>

    </section>

    <section id="about" class="my-20 content flex justify-between">

        <div class="flex flex-col gap-4 max-w-2xl">
            <h1>КТО МЫ</h1>
            <p>Мы объединяем музыкальное комьюнити из России и СНГ и даем возможность молодым исполнителям заявить о
                себе. Мы продвигаем, в том числе, и начинающих артистов. Ведь мы знаем, насколько нелегко сегодня
                пробиться в современном интернет пространстве. <br>
                Два раза в месяц мы выпускаем mixtape — альбом, на
                котором собраны молодые талантливые рэперы. Такие микстейпы будут продаваться на популярных стриминговых
                сервисах (Yandex Музыка, Apple music, Boom и т. д.).</p>
        </div>

        <livewire:components.portal.mixtape-player :mixtape="$example_mixtape"/>
    </section>

    <style>
        .marquee {
            /*display: inline-block;*/
            white-space: nowrap;
            animation: marquee 15s linear infinite;
        }

        @keyframes marquee {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(-100%);
            }
        }
    </style>

    <section class="mt-40 mb-40 w-full flex flex-row bg-blue relative">
        <div class="w-full overflow-hidden">
            <div class="marquee flex justify-between flex-1">
                <h1>Safty</h1>
                <h1>Mitrofunk</h1>
                <h1>ГОПА</h1>
                <h1>Атаманша</h1>
            </div>
        </div>
        <div class="absolute left-0 -bottom-3 bg-pink w-full h-full -z-10"></div>
        <div class="absolute left-0 -bottom-6 bg-brown w-full h-full -z-20"></div>
    </section>

    <section class="my-20 pb-20 content flex gap-8 justify-between" x-data="{ step: 1 }">

        <div class="flex flex-col justify-between min-h-96">

            <div class="cursor-pointer flex justify-center items-center rounded bg-grey-light py-4 px-8 text-2xl font-bold
                hover:!bg-black-light hover:shadow-[0px_0px_4px_1px_#fbb6ce]"@click="step = 1"
                 :class="{ '!bg-black-light shadow-[0px_0px_4px_1px_#fbb6ce]': step === 1 }">1. Подай заявку</div>

            <div class="cursor-pointer flex justify-center items-center rounded bg-grey-light py-4 px-8 text-2xl font-bold
                hover:!bg-black-light hover:shadow-[0px_0px_4px_1px_#fbb6ce]"
                 @click="step = 2"
                 :class="{ '!bg-black-light shadow-[0px_0px_4px_1px_#fbb6ce]': step === 2 }">2. Мы послушаем</div>
            <div class="cursor-pointer flex justify-center items-center rounded bg-grey-light py-4 px-8 text-2xl font-bold
                hover:!bg-black-light hover:shadow-[0px_0px_4px_1px_#fbb6ce]"
                 @click="step = 3"
                 :class="{ '!bg-black-light shadow-[0px_0px_4px_1px_#fbb6ce]': step === 3 }">3. Мы подумаем</div>
            <div class="cursor-pointer flex justify-center items-center rounded bg-grey-light py-4 px-8 text-2xl font-bold
                hover:!bg-black-light hover:shadow-[0px_0px_4px_1px_#fbb6ce]"@click="step = 4"
                 :class="{ '!bg-black-light shadow-[0px_0px_4px_1px_#fbb6ce]': step === 4 }">4. 4 шаг</div>

        </div>

        <div class="flex flex-col gap-4">
            <h1>Как это работает</h1>
            <p class="max-w-2xl">
                <span x-show="step === 1">
                    Мы объединяем музыкальное комьюнити из России и СНГ и даем возможность молодым исполнителям заявить о себе.
                    Мы продвигаем, в том числе, и начинающих артистов. Ведь мы знаем, насколько нелегко сегодня пробиться в современном интернет пространстве.
                    Два раза в месяц мы выпускаем mixtape — альбом, на котором собраны молодые талантливые рэперы.
                    Такие микстейпы будут продаваться на популярных стриминговых сервисах (Yandex Музыка, Apple music, Boom и т. д.).
                </span>
                <span x-show="step === 2">
                    Описание 2
                </span>
                <span x-show="step === 3">
                    Описание 3
                </span>
                <span x-show="step === 4">
                    Описание 4
                </span>
            </p>
        </div>

    </section>

    <section class="my-20 mb-40 content flex justify-between">

        <div class="flex flex-col gap-4 max-w-2xl">
            <h1>Сейчас набираем</h1>
            <p class="mb-8">До 21 июня у нас открыт приём заявок на участие в микстейпе лейбла BRO. После того, как
                отправишь заявку,
                нам потребуется 2-3 дня, чтобы ее рассмотреть. О любом решении ты узнаешь через указанные в заявке
                соц.сети</p>
            <x-link class="button shadow !text-2xl !py-2 !w-full" wire:navigate
                    href="{{route('account.mixtape.create_part', $new_mixtape['id'])}}">Подать заявку
            </x-link>
        </div>

        <img class="max-w-md" src="{{$new_mixtape->getFirstMediaUrl('cover')}}" alt="">
    </section>

    <section class="my-20 content flex justify-between">

        <img class="max-w-md" src="{{$new_mixtape->getFirstMediaUrl('cover')}}" alt="">

        <div class="flex flex-col gap-4 max-w-2xl">
            <h1>Еще и дистрибутирем!</h1>
            <p class="mb-8">
                Мы издаем крутые микстейпы, но кроме этого действуем как обычный лейбл тоже. Через нас можно размещаться на яндексе и бла бла бла.
            </p>
            <x-link class="button shadow !text-2xl !py-2 !w-full" wire:navigate
                    href="{{route('account.distribution.create_app')}}">Начать размещение
            </x-link>
        </div>
    </section>

</page-content>

