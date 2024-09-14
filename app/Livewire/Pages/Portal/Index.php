<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Mixtape;
use Livewire\Component;

class Index extends Component
{

    public $example_mixtape;
    public $new_mixtape;

    public function render()
    {
        $this->example_mixtape = Mixtape::where('id', 2)->first();
        $this->new_mixtape = Mixtape::where('mixtape_status_id', 1)->first();

        return view('livewire.pages.portal.index')
            ->layout('layouts.portal');
    }
}
