<?php

namespace Database\Seeders;

use App\Models\MixtapeParticipation;
use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () { // Чтобы не записать ненужного

            for ($i = 1; $i <= 4; $i++) {

                $directory = public_path("/first_migrate/{$i}");
                $files = scandir($directory . '/wav');

                // Указываем путь к директории
                $rand_covers_path = public_path('assets/fixed/random_covers');
                $filesAndDirs = scandir($rand_covers_path);
                $rand_cover_count = count($filesAndDirs) - 2;

                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {

                        $parts = explode(' - ', $file, 2); // Разделяем текст на две части
                        $author = $parts[0];
                        $title = str_replace('.wav', '', $parts[1]);

                        $wav_path = $directory . "/" . 'wav' . "/" . $file;
                        $mp3_path = $directory . "/" . 'mp3' . "/" . str_replace('.wav', '.mp3', $file);

                        if (file_exists($mp3_path)) {

                            $track = Track::create([
                                'artist_name' => $author,
                                'title' => $title
                            ]);

                            MixtapeParticipation::create([
                                'mixtape_id' => $i,
                                'track_id' => $track['id'],
                                'mixtape_part_status_id' => 3,
                                'artist_name' => $author
                            ]);

                            $random_cover_id = rand(1, $rand_cover_count);
                            $track->addMedia($wav_path)->usingFileName($track['id'] . '.wav')->preservingOriginal()->toMediaCollection('wav');
                            $track->addMedia($mp3_path)->usingFileName($track['id'] . '.mp3')->preservingOriginal()->toMediaCollection('mp3');
                            $track->addMedia("{$rand_covers_path}/{$random_cover_id}.jpeg")->preservingOriginal()->toMediaCollection('cover');

                        } else {
                            dd('ПРОБЛЕМА: МИКС: ' . $i . ' ТРЕК: ' . $file);
                        }
                    }
                }
            }

            DB::transaction(function () { // Чтобы не записать ненужного
                $directory = public_path('/first_migrate/Рандомные треки');
                $track_names = [
                    'BMW',
                    'Шансон',
                    'Инстасамка'
                ];
                for ($i = 1; $i <= 10; $i++) {
                    for ($j = 1; $j <= rand(1,5); $j++) {
                        $rand = rand(1, 3);
                        $file = $directory . "/{$rand}.mp3";
                        $track = Track::create([
                            'title' => $track_names[$rand - 1],
                            'user_id' => $i,

                        ]);
                        $track->addMedia($file)->usingFileName($track['id'] . '.mp3')->preservingOriginal()->toMediaCollection('mp3');
                    }
                }
            });
        });

    }
}
