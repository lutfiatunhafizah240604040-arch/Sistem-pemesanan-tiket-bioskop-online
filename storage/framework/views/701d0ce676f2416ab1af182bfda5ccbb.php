<?php if (isset($component)) { $__componentOriginal81a506f898233b9e7d58286e6bea3c18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81a506f898233b9e7d58286e6bea3c18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'f4ac99e09542ff494432bc959d4fee61::app','data' => ['title' => __('Payments')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts::app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Payments'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php
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
    ?>

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
                    <p class="mt-2 text-lg font-semibold text-slate-900"><?php echo e($summary['total']); ?></p>
                </div>
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-600">Lunas</p>
                    <p class="mt-2 text-lg font-semibold text-emerald-700"><?php echo e($summary['lunas']); ?></p>
                </div>
                <div class="rounded-xl border border-amber-200 bg-amber-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-600">Menunggu</p>
                    <p class="mt-2 text-lg font-semibold text-amber-700"><?php echo e($summary['pending']); ?></p>
                </div>
                <div class="rounded-xl border border-sky-200 bg-sky-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-sky-600">Diproses</p>
                    <p class="mt-2 text-lg font-semibold text-sky-700"><?php echo e($summary['diproses']); ?></p>
                </div>
                <div class="rounded-xl border border-red-200 bg-red-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-red-600">Gagal</p>
                    <p class="mt-2 text-lg font-semibold text-red-700"><?php echo e($summary['gagal']); ?></p>
                </div>
                <div class="rounded-xl border border-rose-200 bg-rose-50 p-3 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-rose-600">Dibatalkan</p>
                    <p class="mt-2 text-lg font-semibold text-rose-700"><?php echo e($summary['cancelled']); ?></p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Daftar Pembayaran</h2>
                    <span class="text-sm text-slate-500">Ringkas</span>
                </div>
                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $status = $statusStyles[$booking->status] ?? ['label' => ucfirst($booking->status), 'class' => 'bg-slate-100 text-slate-700 ring-1 ring-slate-200'];
                            $paymentMethod = match ($booking->status) {
                                'pending' => 'QRIS',
                                'processing' => 'Transfer Bank',
                                'failed' => 'E-Wallet',
                                'expired' => 'Transfer Bank',
                                default => 'Transfer Bank',
                            };
                        ?>
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-3 transition hover:bg-slate-100">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-sm font-semibold text-slate-900"><?php echo e($booking->booking_code); ?></span>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium <?php echo e($status['class']); ?>">
                                            <?php echo e($status['label']); ?>

                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-slate-600"><?php echo e($booking->user?->name ?? 'Guest'); ?> • <?php echo e($booking->showtime?->movie?->title ?? 'Film tidak tersedia'); ?></p>
                                    <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                        <span class="rounded-full bg-white px-2.5 py-1 ring-1 ring-slate-200">Metode: <?php echo e($paymentMethod); ?></span>
                                        <span class="rounded-full bg-white px-2.5 py-1 ring-1 ring-slate-200">Status: <?php echo e($status['label']); ?></span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-600">
                                    <span class="font-semibold text-slate-900">Rp <?php echo e(number_format((int) $booking->total_price, 0, ',', '.')); ?></span>
                                    <span><?php echo e($booking->created_at?->format('d M Y H:i') ?? '-'); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal81a506f898233b9e7d58286e6bea3c18)): ?>
<?php $attributes = $__attributesOriginal81a506f898233b9e7d58286e6bea3c18; ?>
<?php unset($__attributesOriginal81a506f898233b9e7d58286e6bea3c18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81a506f898233b9e7d58286e6bea3c18)): ?>
<?php $component = $__componentOriginal81a506f898233b9e7d58286e6bea3c18; ?>
<?php unset($__componentOriginal81a506f898233b9e7d58286e6bea3c18); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\resources\views/pages/payments/index.blade.php ENDPATH**/ ?>