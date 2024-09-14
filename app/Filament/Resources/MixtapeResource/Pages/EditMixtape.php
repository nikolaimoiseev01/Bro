<?php

namespace App\Filament\Resources\MixtapeResource\Pages;

use App\Filament\Resources\MixtapeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMixtape extends EditRecord
{
    protected static string $resource = MixtapeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
