<?php

namespace App\Filament\Resources\TransportasiResource\Pages;

use App\Filament\Resources\TransportasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransportasi extends CreateRecord
{
    protected static string $resource = TransportasiResource::class;

    public function getTitle(): string
         {
             return 'Buat Transportasi';
        }  
        
        public function getRedirectUrl(): string
        {
            return $this->getResource()::getUrl('index');
         }
}
  