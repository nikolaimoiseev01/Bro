<?php

namespace App\Livewire\Components\Account;

use Livewire\Component;

class Track extends Component
{
    public $track;

    public function render()
    {
        return view('livewire.components.account.track');
    }

    public function mount($track) {
        $this->track = $track;
        $this->track->mp3 = $track->getFirstMediaUrl('mp3');
    }
}
