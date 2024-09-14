<?php

namespace App\Filament\Resources\MixtapeStatusResource\Pages;

use App\Filament\Resources\MixtapeStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMixtapeStatuses extends ManageRecords
{
    protected static string $resource = MixtapeStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
