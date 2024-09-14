<?php

namespace App\Livewire\Components\Portal;

use Livewire\Component;
use Unetway\LaravelRobokassa\Robokassa;

class TrackWithCover extends Component
{
    public $track;

    public function render()
    {
        return view('livewire.components.portal.track-with-cover');
    }

    public function mount($track)
    {
        $this->track = $track;
        $this->track->mp3 = $track->getFirstMediaUrl('mp3');
    }

    public function make_sale($track_id) {
        $robokassa = new Robokassa();
        $link = $robokassa->generateLink([
            'OutSum' => 123.45,
            'Description' => 'Описание',
            'InvoiceID' => 7,
            'IsTest' => 1
        ]);

        $this->redirect($link);

    }
}
