<?php

namespace Database\Seeders;

use App\Models\DistributionStatus;
use App\Models\Genre;
use App\Models\MixtapePartStatus;
use App\Models\MixtapeStatus;
use App\Models\TrackCopyrightVariant;
use App\Models\TrackType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vars = [
            'Заявка создана',
            'Ожидается оплата',
            'Участие подтверждено'
        ];
        foreach ($vars as $var) {
            MixtapePartStatus::create([
                'title' => $var
            ]);
        }

        $vars = [
            'Я полностью сделал',
            'Я купил, могу доказать',
            'В аренде'
        ];
        foreach ($vars as $var) {
            TrackCopyrightVariant::create([
                'title' => $var
            ]);
        }

        $vars = [
            [
                'id' => 1,
                'title' => 'Приём заявок'
            ],
            [
                'id' => 2,
                'title' => 'В процессе выкладки'
            ],
            [
                'id' => 99,
                'title' => 'Издан'
            ],
        ];
        foreach ($vars as $var) {
            MixtapeStatus::create([
                'id' => $var['id'],
                'title' => $var['title']
            ]);
        }


        $genres = [
            'RnB',
            'BlackRap',
            'Dick Genre'
        ];
        foreach ($genres as $genre) {
            Genre::create([
                'title' => $genre
            ]);
        }


        $track_types = [
            'Трек',
            'Бит'
        ];
        foreach ($track_types as $track_type) {
            TrackType::create([
                'title' => $track_type
            ]);
        }

        $dist_statuses = [
            'Заявка создана',
            'Нужна оплата',
            'Участие подтверждено'
        ];
        foreach ($dist_statuses as $dist_status) {
            DistributionStatus::create([
                'title' => $dist_status
            ]);
        }
    }
}
