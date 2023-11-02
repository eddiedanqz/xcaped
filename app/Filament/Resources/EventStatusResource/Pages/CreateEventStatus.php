<?php

namespace App\Filament\Resources\EventStatusResource\Pages;

use App\Filament\Resources\EventStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventStatus extends CreateRecord
{
    protected static string $resource = EventStatusResource::class;
}
