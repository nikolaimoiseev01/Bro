<?php

namespace App\Filament\Resources\TrackCopyrightVariantResource\Pages;

use App\Filament\Resources\TrackCopyrightVariantResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTrackCopyrightVariants extends ManageRecords
{
    protected static string $resource = TrackCopyrightVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
