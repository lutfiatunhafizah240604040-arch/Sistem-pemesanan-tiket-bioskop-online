<?php

namespace App\Livewire\Dashboard;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Movies;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public array $stats = [];

    public array $summaryItems = [];

    public array $recentBookings = [];

    public array $latestMovies = [];

    public function mount(): void
    {
        $this->stats = [
            [
                'label' => 'Total Booking',
                'value' => number_format(Booking::count(), 0, ',', '.'),
                'detail' => 'Jumlah seluruh transaksi',
                'icon' => '<svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3v3"/><path d="M17 3v3"/><rect x="4" y="5" width="16" height="15" rx="2"/><path d="M4 9h16"/></svg>',
                'accent' => 'bg-sky-50 text-sky-600',
            ],
            [
                'label' => 'Tiket Terjual',
                'value' => number_format(BookingDetail::count(), 0, ',', '.'),
                'detail' => 'Total kuantitas tiket',
                'icon' => '<svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16"/><path d="M4 12h10"/><path d="M4 17h16"/><circle cx="17" cy="17" r="3"/></svg>',
                'accent' => 'bg-violet-50 text-violet-600',
            ],
            [
                'label' => 'Pendapatan',
                'value' => $this->formatCurrency((int) Booking::whereIn('status', ['success', 'paid'])->sum('total_price')),
                'detail' => 'Pendapatan berhasil dibayar',
                'icon' => '<svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18"/><path d="M6 7h10a3 3 0 0 1 0 6H8a3 3 0 0 0 0 6h8"/></svg>',
                'accent' => 'bg-emerald-50 text-emerald-600',
            ],
            [
                'label' => 'Total Pengguna',
                'value' => number_format(User::count(), 0, ',', '.'),
                'detail' => 'Jumlah akun terdaftar',
                'icon' => '<svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 19a4 4 0 0 0-8 0"/><circle cx="12" cy="8" r="4"/><path d="M20 19a3 3 0 0 0-1.6-2.7"/><path d="M4 19a3 3 0 0 1 1.6-2.7"/></svg>',
                'accent' => 'bg-amber-50 text-amber-600',
            ],
        ];

        $this->summaryItems = [
            [
                'label' => 'Total Booking',
                'value' => number_format(Booking::count(), 0, ',', '.'),
                'icon' => '<svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3v3"/><path d="M17 3v3"/><rect x="4" y="5" width="16" height="15" rx="2"/><path d="M4 9h16"/></svg>',
                'accent' => 'bg-sky-50 text-sky-600',
            ],
            [
                'label' => 'Tiket Terjual',
                'value' => number_format(BookingDetail::count(), 0, ',', '.'),
                'icon' => '<svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16"/><path d="M4 12h10"/><path d="M4 17h16"/><circle cx="17" cy="17" r="3"/></svg>',
                'accent' => 'bg-violet-50 text-violet-600',
            ],
            [
                'label' => 'Pendapatan',
                'value' => $this->formatCurrency((int) Booking::whereIn('status', ['success', 'paid'])->sum('total_price')),
                'icon' => '<svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18"/><path d="M6 7h10a3 3 0 0 1 0 6H8a3 3 0 0 0 0 6h8"/></svg>',
                'accent' => 'bg-emerald-50 text-emerald-600',
            ],
            [
                'label' => 'Pengguna Baru',
                'value' => number_format(User::whereDate('created_at', now()->toDateString())->count(), 0, ',', '.'),
                'icon' => '<svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 19a4 4 0 0 0-8 0"/><circle cx="12" cy="8" r="4"/><path d="M20 19a3 3 0 0 0-1.6-2.7"/><path d="M4 19a3 3 0 0 1 1.6-2.7"/></svg>',
                'accent' => 'bg-amber-50 text-amber-600',
            ],
        ];

        $this->recentBookings = Booking::query()
            ->with(['user', 'showtime.movie'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function (Booking $booking): array {
                return [
                    'name' => $booking->user?->name ?? 'Guest',
                    'film' => $booking->showtime?->movie?->title ?? 'Film tidak tersedia',
                    'date' => $booking->created_at?->format('d M Y') ?? '-',
                    'quantity' => $booking->details()->count(),
                    'status' => $this->mapBookingStatus($booking->status),
                ];
            })
            ->toArray();

        $this->latestMovies = Movies::query()
            ->latest('created_at')
            ->take(5)
            ->get()
            ->map(function (Movies $movie): array {
                $posterPath = $movie->poster_path;
                $posterUrl = $posterPath && file_exists(public_path('posters/' . $posterPath))
                    ? asset('posters/' . $posterPath)
                    : null;

                return [
                    'id' => $movie->id,
                    'title' => $movie->title ?? 'Judul tidak tersedia',
                    'genre' => $movie->Genre ?? '-',
                    'duration' => $movie->duration ? $movie->duration . ' menit' : '-',
                    'year' => $movie->release_year ?? '-',
                    'poster_url' => $posterUrl,
                    'initial' => strtoupper(substr(($movie->title ?? 'F')[0], 0, 1)),
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }

    private function mapBookingStatus(string $status): array
    {
        return match ($status) {
            'success' => ['label' => 'Selesai', 'class' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200'],
            'pending' => ['label' => 'Pending', 'class' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200'],
            'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-rose-50 text-rose-700 ring-1 ring-rose-200'],
            default => ['label' => ucfirst($status), 'class' => 'bg-slate-100 text-slate-700 ring-1 ring-slate-200'],
        };
    }

    private function formatCurrency(int $value): string
    {
        return 'Rp '.number_format($value, 0, ',', '.');
    }
}
