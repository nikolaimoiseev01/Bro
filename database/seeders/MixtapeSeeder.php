<?php

namespace Database\Seeders;

use App\Models\Mixtape;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MixtapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $stramings = [
            [
                'service' => 'yandex',
                'link' => '12'
            ],
            [
                'service' => 'spotify',
                'link' => '123'
            ],
            [
                'service' => 'vk',
                'link' => '1234'
            ]
        ];

        for ($i = 1; $i <= 4; $i++) {
            $cover_directory = public_path("/first_migrate/{$i}/cover.png");
            $mixtape = Mixtape::create([
                'title' => 'Mixtape ' . $i,
                'mixtape_status_id' => 99,
                'price' => 300,
                'streamings' => $stramings
            ]);

            $mixtape->addMedia($cover_directory)->preservingOriginal()->toMediaCollection('cover');
        }

        $mixtape = Mixtape::create([
            'title' => 'Mixtape 5',
            'mixtape_status_id' => 1,
            'price' => 300
        ]);

        $mixtape->addMedia(public_path('\first_migrate\Mixtape 5 Cover.png'))->preservingOriginal()->toMediaCollection('cover');
    }
}
