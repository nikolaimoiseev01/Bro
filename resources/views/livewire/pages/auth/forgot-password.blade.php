<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.portal')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            $this->dispatch('toast',
                type: 'error',
                message: $status
            );

            return;
        }

        $this->reset('email');

        $this->dispatch('toast',
            type: 'success',
            message: 'Сообщение с инструкцией отправлено!'
        );
    }
}; ?>

<div class="content">

    <form wire:submit="sendPasswordResetLink" class="max-w-xl m-auto rounded p-4 bg-black-light">
        <!-- Email Address -->
        <div>
            <x-input-text wire:model="email" id="email" text="Email" type="email" name="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="link button">Восстановить</button>
        </div>
    </form>
</div>
