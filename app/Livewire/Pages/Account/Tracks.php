<?php

namespace App\Livewire\Pages\Account;

use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tracks extends Component
{
    public $tracks;

    protected $listeners = ['tracksRefresh' => '$refresh'];

    public function render()
    {
        $this->tracks = Auth::user()->track;
        return view('livewire.pages.account.tracks')->layout('layouts.account');
    }

    public function create_track()
    {
        $this->dispatch('initTrackForm',
            form_type: 'create',
            track_id: null
        );
    }

    public function edit_track($track_id)
    {
        $this->dispatch('initTrackForm',
            form_type: 'edit',
            track_id: $track_id
        );
    }
}
