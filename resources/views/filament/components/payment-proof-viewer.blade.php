@php
    $state = $getState();
@endphp

@if ($state)
    <div class="flex flex-col items-center gap-2">
        <img src="{{ Storage::disk('public')->url($state) }}" 
             alt="Bukti Pembayaran" 
             class="max-w-md rounded-lg shadow-lg">
        <a href="{{ Storage::disk('public')->url($state) }}" 
           target="_blank"
           class="text-primary-600 hover:text-primary-500">
            Lihat Gambar Lengkap
        </a>
    </div>
@else
    <div class="text-gray-500 italic">
        Belum ada bukti pembayaran
    </div>
@endif 