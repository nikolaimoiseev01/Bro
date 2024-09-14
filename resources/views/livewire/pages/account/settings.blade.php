<div class="flex flex-col">
    <form wire:submit="updatePassword" class="max-w-xl flex flex-col gap-4 p-4 sm:p-8 bg-black-light shadow sm:rounded-lg">
        <h2 class="text-lg">Сменить пароль</h2>
        <x-input-text text="" wire:model="cur_pass" type="password" required placeholder="Текущий пароль"/>
        <x-input-text text="" wire:model="new_pass_1" type="password" required placeholder="Новый пароль"/>
        <x-input-text text="" wire:model="new_pass_2" type="password" required placeholder="Повторить"/>
        <button class="link simple ml-auto">Изменить</button>
    </form>

    <x-link class="button loader mt-8" wire:click.prevent="logout">Выйти</x-link>

</div>
