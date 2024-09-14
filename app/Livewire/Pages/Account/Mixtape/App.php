<?php

namespace App\Livewire\Pages\Account\Mixtape;

use App\Models\Mixtape;
use App\Models\MixtapeParticipation;
use App\Models\Participation;
use App\Models\Participation_work;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class App extends Component
{
    public $mixtape;
    public $tracks;

    public $chosen_track;

    public function render()
    {
        return view('livewire.pages.account.mixtape.app')->layout('layouts.account');
    }

    public function mount($mixtape_id)
    {
        $this->tracks = Auth::user()->track->pluck('title', 'id');
        $this->mixtape = Mixtape::where('id', $mixtape_id)->first();
    }

    public function create_track()
    {
        $this->dispatch('initTrackForm',
            form_type: 'create',
            track_id: null
        );
    }

    public function check_app() // Одна общая проверка на данные
    {

        $this->error_texts = [];
        $this->error_fields = [];

        $is_same_participation = MixtapeParticipation::where('user_id', Auth::user()->id)->where('mixtape_id', $this->mixtape['id'])->first();

        if (!$this->chosen_track) {
            array_push($this->error_texts, 'Нужно выбрать трек для участия!');
        }

        if ($is_same_participation) {
            array_push($this->error_texts, 'Ты уже участвуешь в этом микстейпе!');
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

    public function save()
    {

        if ($this->check_app()) {
            DB::transaction(function () { // Чтобы не записать ненужного

                MixtapeParticipation::create([
                    'mixtape_id' => $this->mixtape['id'],
                    'track_id' => $this->chosen_track,
                    'mixtape_part_status_id' => 1,
                    'user_id' => Auth::user()->id
                ]);

                session()->flash('toast', [
                    'type' => 'success',
                    'message' => 'Участие успешно создано!'
                ]);

                $this->redirect(route('account.mixtapes'), navigate: true);

                $title = 'Новая заявка на микстейп!';
                $text = "*Имя:*";

                // Посылаем Telegram уведомление нам
                Notification::route('telegram', config('cons.telegram_chat_id'))
                    ->notify(new TelegramNotification($title, $text));

            });
        }


    }
}
