<?php

namespace App\Filament\Resources\DistributionStatusResource\Pages;

use App\Filament\Resources\DistributionStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDistributionStatuses extends ManageRecords
{
    protected static string $resource = DistributionStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
