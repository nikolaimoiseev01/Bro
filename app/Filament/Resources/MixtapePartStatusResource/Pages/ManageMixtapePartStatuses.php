<?php

namespace App\Filament\Resources\MixtapePartStatusResource\Pages;

use App\Filament\Resources\MixtapePartStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMixtapePartStatuses extends ManageRecords
{
    protected static string $resource = MixtapePartStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
