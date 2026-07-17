<x-layouts::app :title="__('Payments')">
    @php
        $bookings = \App\Models\Booking::query()
            ->with(['user', 'showtime.movie'])
            ->latest()
            ->get();

        $summary = [
            'total' => $bookings->count(),
            'lunas' => $bookings->whereIn('status', ['success', 'paid'])->count(),
            'pending' => $bookings->where('status', 'pending')->count(),
            'diproses' => $bookings->where('status', 'processing')->count(),
            'gagal' => $bookings->where('status', 'failed')->count(),
            'cancelled' => $bookings->where('status', 'cancelled')->count(),
        ];

        $statusStyles = [
            'success' => ['label' => 'Lunas', 'class' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200'],
            'paid' => ['label' => 'Lunas', 'class' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200'],
            'pending' => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200'],
            'processing' => ['label' => 'Diproses', 'class' => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200'],
            'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-rose-50 text-rose-700 ring-1 ring-rose-200'],
            'failed' => ['label' => 'Gagal', 'class' => 'bg-red-50 text-red-700 ring-1 ring-red-200'],
            'expired' => ['label' => 'Kedaluwarsa', 'class' => 'bg-gray-100 text-gray-700 ring-1 ring-gray-200'],
        ];
    @endphp

    <div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mx-auto flex w-full max-w-7xl flex-col gap-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Transaksi</p>
                        <h1 class="mt-2 text-2xl font-semibold text-slate-900">Payments</h1>
                    </div>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-6">
                <div class="rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Total</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $summary['total'] }}</p>
                </div>
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-600">Lunas</p>
                    <p class="mt-2 text-lg font-semibold text-emerald-700">{{ $summary['lunas'] }}</p>
                </div>
                <div class="rounded-xl border border-amber-200 bg-amber-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-600">Menunggu</p>
                    <p class="mt-2 text-lg font-semibold text-amber-700">{{ $summary['pending'] }}</p>
                </div>
                <div class="rounded-xl border border-sky-200 bg-sky-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-sky-600">Diproses</p>
                    <p class="mt-2 text-lg font-semibold text-sky-700">{{ $summary['diproses'] }}</p>
                </div>
                <div class="rounded-xl border border-red-200 bg-red-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-red-600">Gagal</p>
                    <p class="mt-2 text-lg font-semibold text-red-700">{{ $summary['gagal'] }}</p>
                </div>
                <div class="rounded-xl border border-rose-200 bg-rose-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-rose-600">Dibatalkan</p>
                    <p class="mt-2 text-lg font-semibold text-rose-700">{{ $summary['cancelled'] }}</p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Daftar Pembayaran</h2>
                    <span class="text-sm text-slate-500">Ringkas</span>
                </div>
                <div class="space-y-3">
                    @foreach ($bookings as $index => $booking)
                        @php
                            $status = $statusStyles[$booking->status] ?? ['label' => ucfirst($booking->status), 'class' => 'bg-slate-100 text-slate-700 ring-1 ring-slate-200'];
                            $paymentMethod = match ($booking->status) {
                                'pending' => 'QRIS',
                                'processing' => 'Transfer Bank',
                                'failed' => 'E-Wallet',
                                'expired' => 'Transfer Bank',
                                default => 'Transfer Bank',
                            };
                        @endphp
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-3 transition hover:bg-slate-100">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-sm font-semibold text-slate-900">{{ $booking->booking_code }}</span>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {{ $status['class'] }}">
                                            {{ $status['label'] }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-slate-600">{{ $booking->user?->name ?? 'Guest' }} • {{ $booking->showtime?->movie?->title ?? 'Film tidak tersedia' }}</p>
                                    <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                        <span class="rounded-full bg-white px-2.5 py-1 ring-1 ring-slate-200">Metode: {{ $paymentMethod }}</span>
                                        <span class="rounded-full bg-white px-2.5 py-1 ring-1 ring-slate-200">Status: {{ $status['label'] }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-600">
                                    <span class="font-semibold text-slate-900">Rp {{ number_format((int) $booking->total_price, 0, ',', '.') }}</span>
                                    <span>{{ $booking->created_at?->format('d M Y H:i') ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
