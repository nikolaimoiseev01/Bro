<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.account')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="bg-black-light rounded max-w-2xl p-4">

    <p>
        Чтобы начать пользоваться аккаунтом, пожалуйста, подтвердите Email. Для этого нужно перейти по ссылке из письма.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Новое письмо успешно выслано') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <x-link class="button loader" wire:click="sendVerification">Отправить новое письмо</x-link>
        <x-link class="simple" wire:click="logout">Выйти</x-link>
    </div>
</div>
