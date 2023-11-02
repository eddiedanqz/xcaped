<?php

namespace App\Filament\Resources\EventStatusResource\Pages;

use App\Filament\Resources\EventStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventStatus extends EditRecord
{
    protected static string $resource = EventStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
