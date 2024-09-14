<?php

namespace App\Livewire\Components\Account;

use App\Models\Genre;
use App\Models\Track;
use App\Models\TrackCopyrightVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddTrack extends Component
{
    use WithFileUploads;

    public $form_type;

    public $open_form = false;

    public $genres;
    public $genre;

    public $artist_name;

    public $copyright_vars;
    public $copyright_var;


    public $title;
    public $language;
    public $feats;
    public $composer;
    public $text;
    public $flg_adult = false;
    public $isrc;

    public $file;

    public $track;

    protected $listeners = ['initTrackForm' => 'initTrackForm'];

    public function render()
    {
        return view('livewire.components.account.add-track');
    }

    public function mount()
    {

        $this->genres = Genre::all()->pluck('title', 'id');
        $this->copyright_vars = TrackCopyrightVariant::all()->pluck('title', 'id');

    }

    public function initTrackForm($form_type, $track_id)
    {
        $this->form_type = $form_type;
        if ($form_type == 'edit') {
            $this->track = Track::where('id', $track_id)->first();
            $this->artist_name = $this->track['artist_name'];
            $this->title = $this->track['title'];
            $this->language = $this->track['language'];
            $this->composer = $this->track['composer'];
            $this->text = $this->track['text'];
            $this->isrc = $this->track['isrc'];
            $this->flg_adult = $this->track['flg_adult'];
            $this->copyright_var = $this->track['track_copyright_variant_id'];
            $this->genre = $this->track['genre_id'];
        } else {
            $this->artist_name = Auth::user()->artist_name;
            $this->title = null;
            $this->language = null;
            $this->composer = null;
            $this->text = null;
            $this->isrc = null;
            $this->flg_adult = null;
            $this->copyright_var = null;
            $this->genre = null;
        }
        $this->open_form = true;
    }

    public function hide_form()
    {
        $this->open_form = false;
    }

    public function check_app() // Одна общая проверка на данные
    {

        $this->error_texts = [];
        $this->error_fields = [];

        if ($this->form_type == 'create' && !$this->file) {
            array_push($this->error_texts, 'Добавь файл трека!');
        }

        if (!$this->copyright_var) {
            array_push($this->error_texts, 'Выбери доказательство прав!');
        }

        if (!$this->genre) {
            array_push($this->error_texts, 'Выбери жанр!');
        }

        if (!empty($this->error_texts)) {
            $this->dispatch('toast',
                type: 'error',
                message: implode("<br>", $this->error_texts)
            );
            return false;
        } else {
            return true;
        }
    }

    public function add()
    {

        if ($this->check_app()) {

            DB::transaction(function () { // Чтобы не записать ненужного
                $track = Track::create([
                    'title' => $this->title,
                    'user_id' => Auth::user()->id,
                    'language' => $this->language,
//                'feats' => $this->feats,
                    'isrc' => $this->isrc,
                    'composer' => $this->composer,
                    'text' => $this->text,
                    'flg_adult' => $this->flg_adult,
                    'genre_id' => $this->genre,
                    'track_copyright_variant_id' => $this->copyright_var
                ]);
                $track->addMedia($this->file->path())->usingFileName($track['id'] . '.mp3')->toMediaCollection('mp3');


                $this->dispatch('toast',
                    type: 'success',
                    message: 'Трек добавлен!'
                );


                $this->dispatch('toggle_showAddTrack');

                $this->dispatch('tracksRefresh');

            });
        }
    }

    public function save()
    {

        if ($this->check_app()) {

            DB::transaction(function () { // Чтобы не записать ненужного

                $this->track->update([
                    'title' => $this->title,
                    'user_id' => Auth::user()->id,
                    'language' => $this->language,
//                'feats' => $this->feats,
                    'isrc' => $this->isrc,
                    'composer' => $this->composer,
                    'text' => $this->text,
                    'flg_adult' => $this->flg_adult,
                    'genre_id' => $this->genre,
                    'track_copyright_variant_id' => $this->copyright_var
                ]);

                $this->dispatch('toast',
                    type: 'success',
                    message: 'Трек сохранен!'
                );

                $this->dispatch('toggle_showAddTrack');

                $this->dispatch('tracksRefresh');

            });
        }
    }
}
