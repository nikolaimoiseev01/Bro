<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.portal')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="content flex items-center flex-col gap-8">
    <!-- Session Status -->
    {{--    <x-auth-session-status class="mb-4" :status="session('status')"/>--}}

    <div class="flex justify-center gap-8">
        <h1>ВОЙТИ</h1>
        <x-link class="not-active" href="{{route('register')}}"><h1>РЕГИСТРАЦИЯ</h1></x-link>
    </div>

    <form wire:submit="login" class="w-full max-w-xl flex flex-col gap-6">

        <x-input-text text="Email" class="w-full" wire:model="form.email" id="email"
                      type="email" name="email" placeholder="email"
                      required autofocus autocomplete="username"/>

        <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>

        <x-input-text text="Пароль" class="w-full" wire:model="form.password" id="password"
                      type="password" name="password" placeholder="Пароль"
                      required autofocus autocomplete="current-password"/>

        <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>

        <x-input-checkbox text="Запомнить меня" model="form.remember" type="checkbox"
                          name="remember"></x-input-checkbox>

        <div class="flex items-center justify-end gap-4">
            @if (Route::has('password.request'))
                <x-link href="{{ route('password.request') }}" class="small">Забыл пароль?</x-link>
            @endif

            <button type="submit" class="link button loader">Войти</button>
        </div>

    </form>
</div>
