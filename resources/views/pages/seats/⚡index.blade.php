<?php

use Livewire\Component;
use App\Models\Seat;

new class extends Component
{
    // 1. Fungsi untuk mengambil data kursi Studio 1 saat halaman dimuat
    public function with(): array
    {
        return [
            'seats' => Seat::where('studio_id', 1)->get(),
        ];
    }

    // 2. Fungsi Baru: Mengubah status ketersediaan kursi saat diklik
    public function toggleSeat($seatId)
    {
        $seat = Seat::find($seatId);
        
        if ($seat) {
            // Membalikkan status: jika true jadi false, jika false jadi true
            $seat->is_available = !$seat->is_available;
            $seat->save();
        }
    }
}; ?>

<div class="p-6 bg-white dark:bg-zinc-900 rounded-xl shadow-sm space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <flux:heading level="1" size="xl">Kelola Kursi (Seats)</flux:heading>
            <flux:subheading>Konfigurasi Denah Kursi Studio 1 (Klik kursi untuk mengubah status)</flux:subheading>
        </div>
    </div>

    <flux:separator />

    <div class="w-full flex flex-col items-center space-y-2">
        <div class="w-2/3 h-4 bg-zinc-300 dark:bg-zinc-700 rounded-b-xl shadow-inner text-center text-[10px] text-zinc-600 font-bold tracking-widest pt-0.5">
            LAYAR UTAMA / SCREEN
        </div>
    </div>

    <div style="max-width: 600px; margin: 1.5rem auto; padding: 0 0.5rem; width: 100%;">
        <div style="display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 20px 12px; justify-items: center;">
            @forelse ($seats as $seat)
                <div class="flex flex-col items-center w-full">
                    <flux:button 
                        variant="filled" 
                        :color="$seat->is_available ? 'indigo' : 'red'" 
                        size="sm" 
                        wire:click="toggleSeat({{ $seat->id }})"
                        class="w-12 h-12 flex items-center justify-center font-semibold rounded-lg shadow-sm hover:scale-105 transition-transform cursor-pointer"
                    >
                        {{ $seat->seat_number }}
                    </flux:button>
                    
                    <span class="text-[9px] mt-1.5 uppercase font-bold tracking-wider {{ $seat->is_available ? 'text-zinc-400' : 'text-red-500' }}">
                        {{ $seat->is_available ? 'Tersedia' : 'Terisi' }}
                    </span>
                </div>
            @empty
                <div style="grid-column: span 5; text-align: center; color: #71717a; padding: 1.5rem;">
                    Belum ada data kursi di database untuk Studio 1. <br>
                    <span class="text-xs text-zinc-400">Silakan isi (seed) tabel `seats` terlebih dahulu.</span>
                </div>
            @endforelse
        </div>
    </div>

    <div class="flex justify-center space-x-6 text-xs pt-4 border-t border-zinc-100 dark:border-zinc-800">
        <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-indigo-600 rounded"></div>
            <span class="text-zinc-600 dark:text-zinc-400">Kursi Tersedia</span>
        </div>
        <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-red-600 rounded"></div>
            <span class="text-zinc-600 dark:text-zinc-400">Kursi Terisi / Dipesan</span>
        </div>
    </div>
</div>