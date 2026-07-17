<div class="mx-auto flex w-full max-w-7xl flex-col gap-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="flex flex-col gap-4 lg:grid lg:grid-cols-2 lg:items-start lg:gap-6">
            <div class="min-w-0">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Sistem Pemesanan</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Halo, Lutfiatun Hafizah</h1>
                <p class="mt-2 text-sm text-slate-600">Selamat datang di sistem pemesanan tiket bioskop online.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center lg:justify-end">
                <div class="w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Ringkasan Hari Ini</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $summaryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="flex min-w-[132px] items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full <?php echo e($item['accent']); ?>">
                                    <?php echo $item['icon']; ?>

                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] font-medium text-slate-500"><?php echo e($item['label']); ?></p>
                                    <p class="truncate text-sm font-semibold text-slate-900"><?php echo e($item['value']); ?></p>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Daftar Film</h2>
                <p class="mt-1 text-sm text-slate-500">Film terbaru yang tersedia di menu movies.</p>
            </div>
            <a href="<?php echo e(route('movies.index')); ?>" class="text-sm font-medium text-sky-600 transition hover:text-sky-700">
                Lihat semua →
            </a>
        </div>

        <div class="mt-5 flex gap-4 overflow-x-auto pb-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="min-w-[160px] max-w-[160px] flex-shrink-0 rounded-2xl border border-slate-200 bg-slate-50/70 p-2 transition hover:-translate-y-0.5 hover:shadow-sm">
                    <div class="flex h-20 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($movie['poster_url'])): ?>
                            <img src="<?php echo e($movie['poster_url']); ?>" alt="<?php echo e($movie['title']); ?>" class="h-full w-full object-cover object-center" />
                        <?php else: ?>
                            <span class="text-lg font-semibold text-slate-600"><?php echo e($movie['initial']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <p class="truncate font-semibold text-slate-900"><?php echo e($movie['title']); ?></p>
                        <p class="mt-1 text-sm text-slate-500"><?php echo e($movie['genre']); ?> • <?php echo e($movie['duration']); ?> • <?php echo e($movie['year']); ?></p>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="w-full rounded-xl border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-center text-sm text-slate-500">
                    Belum ada data film.
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\resources\views/livewire/dashboard/index.blade.php ENDPATH**/ ?>