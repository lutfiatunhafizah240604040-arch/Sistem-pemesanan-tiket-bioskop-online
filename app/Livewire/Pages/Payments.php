<?php

namespace App\Livewire\Pages;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Livewire\Component;

class Payments extends Component
{
    public string $statusFilter = 'all';

    public Collection $payments;

    public array $summary = [];

    public function mount(): void
    {
        $this->loadPayments();
    }

    public function updatedStatusFilter(): void
    {
        $this->loadPayments();
    }

    public function render()
    {
        return view('livewire.pages.payments');
    }

    private function loadPayments(): void
    {
        $query = Booking::query()
            ->with(['user', 'showtime.movie'])
            ->latest();

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $this->payments = $query->get()->map(function (Booking $booking): array {
            $status = match ($booking->status) {
                'success' => ['label' => 'Lunas', 'class' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200'],
                'pending' => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200'],
                'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-rose-50 text-rose-700 ring-1 ring-rose-200'],
                default => ['label' => ucfirst($booking->status), 'class' => 'bg-slate-100 text-slate-700 ring-1 ring-slate-200'],
            };

            return [
                'id' => $booking->id,
                'booking_code' => $booking->booking_code,
                'customer' => $booking->user?->name ?? 'Guest',
                'movie' => $booking->showtime?->movie?->title ?? 'Film tidak tersedia',
                'amount' => 'Rp '.number_format((int) $booking->total_price, 0, ',', '.'),
                'status' => $status,
                'created_at' => $booking->created_at?->format('d M Y H:i') ?? '-',
            ];
        });

        $this->summary = [
            'total' => Booking::count(),
            'lunas' => Booking::where('status', 'success')->count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];
    }
}
