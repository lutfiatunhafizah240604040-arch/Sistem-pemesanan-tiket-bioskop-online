<x-layouts::app :title="__('Bookings')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            <h2 class="text-xl font-semibold text-neutral-900 dark:text-neutral-50">Booking Tiket</h2>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Silakan cek status pemesanan dan metode pembayaran berikut.</p>

            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Metode Pembayaran</p>
                    <p class="mt-2 text-base font-semibold text-slate-900">Transfer Bank</p>
                    <p class="mt-1 text-sm text-slate-600">Anda dapat menyelesaikan pembayaran via transfer bank, QRIS, atau e-wallet.</p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Status Booking</p>
                    <div class="mt-3 space-y-2 text-sm text-slate-700">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                            <span>Menunggu — pembayaran belum selesai</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                            <span>Diproses — pembayaran sedang diverifikasi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                            <span>Gagal — pembayaran tidak berhasil</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
