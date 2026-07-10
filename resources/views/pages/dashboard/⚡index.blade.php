<?php

use Livewire\Volt\Component;
use App\Http\Models\Movies;
use App\Http\Models\Showtimes;
use App\Http\Models\Booking;

new class extends Component
{
    public function with(): array
    {
        return [
            'totalMovies' => Movies::count(),
            'todayShowtimes' => Showtimes::count(),
            'totalBookings' => Booking::count(),
            'recentBookings' => Booking::latest()->take(5)->get(),
        ];
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Film</span>
                <span class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-neutral-50">{{ $totalMovies }}</span>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Jadwal Tayang</span>
                <span class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-neutral-50">{{ $todayShowtimes }}</span>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Pemesanan</span>
                <span class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-neutral-50">{{ $totalBookings }}</span>
            </div>
        </div>
    </div>

    <div class="relative min-h-[100px] flex-1 overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900 md:min-h-min">
        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-50 mb-4">Pemesanan Tiket Terbaru</h3>
        <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
            @forelse($recentBookings as $booking)
                <div class="py-3 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-sm text-neutral-900 dark:text-neutral-50">ID Booking: #{{ $booking->id }}</p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-50 text-green-700 dark:bg-green-950/50 dark:text-green-400 border border-green-200 dark:border-green-900">
                            {{ $booking->status ?? 'Success' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-neutral-500 dark:text-neutral-400">
                    <p class="text-sm">Belum ada riwayat pemesanan tiket.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>