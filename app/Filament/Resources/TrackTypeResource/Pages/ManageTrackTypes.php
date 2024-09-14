<?php

namespace App\Filament\Resources\TrackTypeResource\Pages;

use App\Filament\Resources\TrackTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTrackTypes extends ManageRecords
{
    protected static string $resource = TrackTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
