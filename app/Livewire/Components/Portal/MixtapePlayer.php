<?php

namespace App\Livewire\Components\Portal;

use Livewire\Component;

class MixtapePlayer extends Component
{
    public $mixtape;

    public function render()
    {
        return view('livewire.components.portal.mixtape-player');
    }
}
