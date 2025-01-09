<?php

namespace App\Filament\Resources\RuteResource\Pages;

use App\Filament\Resources\RuteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRute extends CreateRecord
{
    protected static string $resource = RuteResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
     }
}
