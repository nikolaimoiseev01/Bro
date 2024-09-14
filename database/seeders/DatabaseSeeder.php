<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public');

        $this->call(MixtapeSeeder::class);
        $this->call(TrackSeeder::class);
        $this->call(DictsSeeder::class);

        $user = User::create([
            'name' => 'admin',
            'artist_name' => 'Мияги',
            'email' => 'admin@mail.ru',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        $track = Track::create([
            'title' => 'Мой первый трек',
            'user_id' => 1,
        ]);
        $track->addMedia('D:\Work\Projects\BRO Label\Загружаем треки\Safty - 3am.mp3')->preservingOriginal()->usingFileName($track['id'] . '.mp3')->toMediaCollection('mp3');

        $track = Track::create([
            'title' => 'Мой второй трек',
            'user_id' => 1,
        ]);
        $track->addMedia('D:\Work\Projects\BRO Label\Загружаем треки\Yung Ghoty feat. AUTOGUN - Лавина.mp3')->preservingOriginal()->usingFileName($track['id'] . '.mp3')->toMediaCollection('mp3');



        \App\Models\User::factory(10)->create();

    }
}
