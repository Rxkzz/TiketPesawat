<?php

namespace App\Filament\Resources\PenumpangResource\Pages;

use App\Filament\Resources\PenumpangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenumpang extends EditRecord
{
    protected static string $resource = PenumpangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
