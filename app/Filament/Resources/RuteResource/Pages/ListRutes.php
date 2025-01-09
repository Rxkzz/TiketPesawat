<?php

namespace App\Filament\Resources\RuteResource\Pages;

use App\Filament\Resources\RuteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRutes extends ListRecords
{
    protected static string $resource = RuteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
