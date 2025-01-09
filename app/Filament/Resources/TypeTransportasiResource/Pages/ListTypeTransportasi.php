<?php

namespace App\Filament\Resources\TypeTransportasiResource\Pages;

use App\Filament\Resources\TypeTransportasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeTransportasi extends ListRecords
{
    protected static string $resource = TypeTransportasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Daftar Type Transportasi';
    }
}
