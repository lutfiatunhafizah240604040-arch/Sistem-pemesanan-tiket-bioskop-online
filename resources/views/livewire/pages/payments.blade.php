<x-layouts::app :title="__('Payments')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mx-auto flex w-full max-w-7xl flex-col gap-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Transaksi</p>
                        <h1 class="mt-2 text-2xl font-semibold text-slate-900">Payments</h1>
                        <p class="mt-2 text-sm text-slate-600">Halaman pembayaran yang terhubung ke data booking.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <select wire:model.live="statusFilter" class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 shadow-sm focus:border-slate-400 focus:outline-none">
                            <option value="all">Semua Status</option>
                            <option value="success">Lunas</option>
                            <option value="pending">Menunggu</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                        <button type="button" class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Cetak Laporan
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-slate-500">Total</p>
                    <p class="mt-2 text-xl font-semibold text-slate-900">{{ $summary['total'] }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-slate-500">Lunas</p>
                    <p class="mt-2 text-xl font-semibold text-emerald-600">{{ $summary['lunas'] }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-slate-500">Menunggu</p>
                    <p class="mt-2 text-xl font-semibold text-amber-600">{{ $summary['pending'] }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-slate-500">Dibatalkan</p>
                    <p class="mt-2 text-xl font-semibold text-rose-600">{{ $summary['cancelled'] }}</p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Daftar Pembayaran</h2>
                    <span class="text-sm text-slate-500">Terhubung ke data booking</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead>
                            <tr class="text-slate-500">
                                <th class="px-3 py-3 font-medium">No</th>
                                <th class="px-3 py-3 font-medium">Kode Booking</th>
                                <th class="px-3 py-3 font-medium">Customer</th>
                                <th class="px-3 py-3 font-medium">Film</th>
                                <th class="px-3 py-3 font-medium">Nominal</th>
                                <th class="px-3 py-3 font-medium">Status</th>
                                <th class="px-3 py-3 font-medium">Tanggal</th>
                                <th class="px-3 py-3 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($payments as $index => $payment)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-3 py-3 font-medium text-slate-700">{{ $index + 1 }}</td>
                                    <td class="px-3 py-3 font-medium text-slate-700">{{ $payment['booking_code'] }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ $payment['customer'] }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ $payment['movie'] }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ $payment['amount'] }}</td>
                                    <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {{ $payment['status']['class'] }}">
                                            {{ $payment['status']['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 text-slate-500">{{ $payment['created_at'] }}</td>
                                    <td class="px-3 py-3">
                                        <button type="button" class="rounded-lg border border-slate-200 px-2.5 py-1.5 text-xs font-medium text-slate-600 transition hover:bg-slate-50">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-3 py-8 text-center text-sm text-slate-500">Belum ada data pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
