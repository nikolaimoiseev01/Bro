<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.portal')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $artist_name = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {

        $validated = $this->validate([
            'artist_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

//        $user = User::create([
//            'artist_name' =>
//        ])

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

{{--<div>--}}
{{--    <form wire:submit="register">--}}
{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</div>--}}

<div class="content flex items-center flex-col gap-8">
    <!-- Session Status -->
    {{--    <x-auth-session-status class="mb-4" :status="session('status')"/>--}}

    <div class="flex justify-center gap-8">
        <x-link class="not-active" href="{{route('login')}}"><h1>ВОЙТИ</h1></x-link>
        <h1>РЕГИСТРАЦИЯ</h1>
    </div>

    <form wire:submit="register" class="w-full max-w-xl flex flex-col gap-6">

        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>

        {{--        <x-input-text text="Имя" class="w-full" wire:model="form.name" id="name"--}}
        {{--                      type="text" name="name" placeholder="Имя"--}}
        {{--                      required autofocus/>--}}
        {{--        <x-input-text text="Фамилия" class="w-full" wire:model="form.surname" id="surname"--}}
        {{--                      type="text" name="surname" placeholder="Фамилия"--}}
        {{--                      required autofocus autocomplete="username"/>--}}
        <x-input-text text="Имя артиста" class="w-full" wire:model="artist_name" id="artist_name"
                      type="text" name="artist_name" placeholder="Имя артиста"
                      required autofocus autocomplete="username"/>

        <x-input-text text="Email" class="w-full" wire:model="email" id="email"
                      type="email" name="email" placeholder="email"
                      required autofocus autocomplete="username"/>

        <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>

        <x-input-text text="Пароль" class="w-full" wire:model="password" id="password"
                      type="password" name="password" placeholder="Пароль"
                      required autofocus autocomplete="current-password"/>

        <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>

        <x-input-text text="Подтверждение пароля" wire:model="password_confirmation" id="password_confirmation"
                      type="password"
                      name="password_confirmation" required autocomplete="new-password" />


        <div class="flex items-center justify-end gap-4">
            <button type="submit" class="link button loader">Отправить</button>
        </div>

    </form>
</div>
