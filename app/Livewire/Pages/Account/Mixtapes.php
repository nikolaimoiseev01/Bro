<?php

namespace App\Livewire\Pages\Account;

use App\Models\MixtapeParticipation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Mixtapes extends Component
{
    public $parts;
    public $chosen_part;

    public function render()
    {
        $this->parts = MixtapeParticipation::where('user_id', Auth::user()->id)->get();
        return view('livewire.pages.account.mixtapes')->layout('layouts.account');
    }

    public function choose_part($part_id)
    {
        if ($this->chosen_part['id'] ?? 0 !== $part_id) {
            $this->chosen_part = $this->parts->where('id', $part_id)->first();
        }
    }
}
