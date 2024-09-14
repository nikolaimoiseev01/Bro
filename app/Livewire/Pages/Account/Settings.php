<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Actions\Logout;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Settings extends Component
{
    public $cur_pass;
    public $new_pass_1;
    public $new_pass_2;

    public function render()
    {
        return view('livewire.pages.account.settings')->layout('layouts.account');
    }

    public function logout(Logout $logout)
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);

//        return redirect()->route('login'); // или любая другая страница, куда вы хотите перенаправить пользователя
    }


    public function updatePassword(): void
    {
        $this->error_texts = [];
        $this->error_fields = [];

        $passwordValid = Hash::check($this->cur_pass, Auth::user()->password);

        if (!$passwordValid) {
            array_push($this->error_texts, 'Оригинальный пароль неверный!');
        }

        if ($this->new_pass_1 != $this->new_pass_2) {
            array_push($this->error_texts, 'Пароли не совпадают!');
        }

        if (!empty($this->error_texts)) {
            $this->dispatch('toast',
                type: 'error',
                message: implode("<br>", $this->error_texts)
            );
        } else {
            Auth::user()->update([
                'password' => Hash::make($this->new_pass_1),
            ]);

            $this->dispatch('toast',
                type: 'success',
                message: 'Пароль успешно изменен!'
            );
        }

    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}
