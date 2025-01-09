<?php

namespace App\Filament\Resources\TypeTransportasiResource\Pages;

use App\Filament\Resources\TypeTransportasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeTransportasi extends EditRecord
{
    protected static string $resource = TypeTransportasiResource::class;

    public function getTitle(): string
    {
        return 'Edit Type Transportasi';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
