<?php

namespace App\Livewire\Pages\Account\Distribution;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class App extends Component
{
    public $tracks;

    public function render()
    {
        return view('livewire.pages.account.distribution.app')->layout('layouts.account');
    }

    public function mount() {
        $this->tracks = Auth::user()->track->pluck('title', 'id');
    }
}
