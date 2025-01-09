<?php

namespace App\Filament\Resources\TypeTransportasiResource\Pages;

use App\Filament\Resources\TypeTransportasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeTransportasi extends CreateRecord
{
    protected static string $resource = TypeTransportasiResource::class;

    public function getTitle(): string
    {
        return 'Buat Type Transportasi';
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
