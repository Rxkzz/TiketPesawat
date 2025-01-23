<?php

namespace App\Observers;

use App\Models\Rute;

class RuteObserver
{
    public function creating(Rute $rute)
    {
        $this->calculateTotalHarga($rute);
    }

    public function updating(Rute $rute)
    {
        $this->calculateTotalHarga($rute);
    }

    private function calculateTotalHarga(Rute $rute)
    {
        if ($rute->id_class) {
            $class = \App\Models\ClassModel::find($rute->id_class);
            if ($class) {
                $rute->total_harga = $rute->harga + $class->harga_tambahan;
            }
        } else {
            $rute->total_harga = $rute->harga;
        }
    }
} 