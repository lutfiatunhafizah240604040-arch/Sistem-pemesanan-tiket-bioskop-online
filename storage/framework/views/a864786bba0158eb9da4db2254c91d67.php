<?php # [BlazeFolded]:{flux::heading}:{C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/heading.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::subheading}:{C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/subheading.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::separator}:{C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/separator.blade.php}:{1776985208} ?>
<?php
use Livewire\Component;
use App\Models\Seat;
?>

<div class="p-6 bg-white dark:bg-zinc-900 rounded-xl shadow-sm space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <?php ob_start(); ?><h1 class="font-medium [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white text-2xl [&amp;:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&amp;]:mt-2" data-flux-heading><?php ob_start(); ?>Kelola Kursi (Seats)<?php echo trim(ob_get_clean()); ?></h1>

        <?php echo ltrim(ob_get_clean()); ?>
            <?php ob_start(); ?><div class="text-sm [:where(&amp;)]:text-zinc-500 [:where(&amp;)]:dark:text-white/70" data-flux-subheading>
    <?php ob_start(); ?>Konfigurasi Denah Kursi Studio 1 (Klik kursi untuk mengubah status)<?php echo trim(ob_get_clean()); ?>

</div>
<?php echo ltrim(ob_get_clean()); ?>
        </div>
    </div>

    <?php ob_start(); ?><div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/15 dark:bg-white/20 h-px w-full" data-flux-separator></div>
<?php echo ltrim(ob_get_clean()); ?>

    <div class="w-full flex flex-col items-center space-y-2">
        <div class="w-2/3 h-4 bg-zinc-300 dark:bg-zinc-700 rounded-b-xl shadow-inner text-center text-[10px] text-zinc-600 font-bold tracking-widest pt-0.5">
            LAYAR UTAMA / SCREEN
        </div>
    </div>

    <div style="max-width: 600px; margin: 1.5rem auto; padding: 0 0.5rem; width: 100%;">
        <div style="display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 20px 12px; justify-items: center;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex flex-col items-center w-full">
                    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/d9e50dd29c8b86433c4fc4e05a9555fb.php'); ?>
<?php if (isset($__slotsd9e50dd29c8b86433c4fc4e05a9555fb)) { $__slotsStackd9e50dd29c8b86433c4fc4e05a9555fb[] = $__slotsd9e50dd29c8b86433c4fc4e05a9555fb; } ?>
<?php if (isset($__attrsd9e50dd29c8b86433c4fc4e05a9555fb)) { $__attrsStackd9e50dd29c8b86433c4fc4e05a9555fb[] = $__attrsd9e50dd29c8b86433c4fc4e05a9555fb; } ?>
<?php $__attrsd9e50dd29c8b86433c4fc4e05a9555fb = ['variant' => 'filled','color' => $seat->is_available ? 'indigo' : 'red','size' => 'sm','wire:click' => 'toggleSeat('.e($seat->id).')','class' => 'w-12 h-12 flex items-center justify-center font-semibold rounded-lg shadow-sm hover:scale-105 transition-transform cursor-pointer']; ?>
<?php $__slotsd9e50dd29c8b86433c4fc4e05a9555fb = []; ?>
<?php $__blaze->pushData($__attrsd9e50dd29c8b86433c4fc4e05a9555fb); ?>
<?php ob_start(); ?>
                        <?php echo e($seat->seat_number); ?>

                    <?php $__slotsd9e50dd29c8b86433c4fc4e05a9555fb['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsd9e50dd29c8b86433c4fc4e05a9555fb); ?>
<?php _d9e50dd29c8b86433c4fc4e05a9555fb($__blaze, $__attrsd9e50dd29c8b86433c4fc4e05a9555fb, $__slotsd9e50dd29c8b86433c4fc4e05a9555fb, ['color'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackd9e50dd29c8b86433c4fc4e05a9555fb)) { $__slotsd9e50dd29c8b86433c4fc4e05a9555fb = array_pop($__slotsStackd9e50dd29c8b86433c4fc4e05a9555fb); } ?>
<?php if (! empty($__attrsStackd9e50dd29c8b86433c4fc4e05a9555fb)) { $__attrsd9e50dd29c8b86433c4fc4e05a9555fb = array_pop($__attrsStackd9e50dd29c8b86433c4fc4e05a9555fb); } ?>
<?php $__blaze->popData(); ?>
                    
                    <span class="text-[9px] mt-1.5 uppercase font-bold tracking-wider <?php echo e($seat->is_available ? 'text-zinc-400' : 'text-red-500'); ?>">
                        <?php echo e($seat->is_available ? 'Tersedia' : 'Terisi'); ?>

                    </span>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div style="grid-column: span 5; text-align: center; color: #71717a; padding: 1.5rem;">
                    Belum ada data kursi di database untuk Studio 1. <br>
                    <span class="text-xs text-zinc-400">Silakan isi (seed) tabel `seats` terlebih dahulu.</span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
</div><?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\storage\framework\views/livewire/views/d342891b.blade.php ENDPATH**/ ?>