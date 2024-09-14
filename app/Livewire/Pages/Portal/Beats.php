<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Track;
use Livewire\Component;

class Beats extends Component
{
    public $beats;

    public function render()
    {
        $this->beats = Track::all()->take(10);

        return view('livewire.pages.portal.beats');
    }
}
