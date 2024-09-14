<?php

namespace App\Filament\Resources\MixtapeParticipationResource\Pages;

use App\Filament\Resources\MixtapeParticipationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMixtapeParticipation extends EditRecord
{
    protected static string $resource = MixtapeParticipationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
