<?php

namespace App\Filament\Resources\AttendeeResource\Pages;

use App\Filament\Resources\AttendeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendees extends ListRecords
{
    protected static string $resource = AttendeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
