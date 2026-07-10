<?php
use Livewire\Component;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Seat;
use App\Models\Showtimes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
?>

<div class="p-6 bg-white rounded-lg shadow max-w-4xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Pemesanan Tiket Online</h2>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-l: 4px solid #10b981;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #10b981; background-color: #d1fae5; border-radius: 6px;">
                <svg style="width: 20 h: 20" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div style="margin-left: 12px; font-size: 14px; font-weight: 600; color: #374151;">
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-l: 4px solid #ef4444;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #ef4444; background-color: #fee2e2; border-radius: 6px;">
                <svg style="width: 20 h: 20" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div style="margin-left: 12px; font-size: 14px; font-weight: 600; color: #374151;">
                <?php echo e(session('error')); ?>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Jadwal Film</label>
        <select wire:model.live="showtime_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">-- Pilih Jadwal --</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $showtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <option value="<?php echo e($st->id); ?>">
                    <?php echo e($st->movie->title ?? 'Film Tidak Diketahui'); ?> - <?php echo e(\Carbon\Carbon::parse($st->start_time)->format('H:i')); ?>

                </option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showtime_id && $showtime_id != ''): ?>
        <div class="w-full bg-gray-300 text-center text-xs font-bold py-2 rounded mb-10 tracking-widest text-gray-600">
            LAYAR UTAMA
        </div>

        <div class="space-y-4 mb-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $rowSeats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex justify-center gap-4 items-center">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $rowSeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $isChosen = in_array($seat->id, $selectedSeats);
                            $isAvailable = $seat->is_available;
                            
                            $btnClass = 'w-16 py-2 text-center rounded text-xs font-semibold transition-colors ';
                            if (!$isAvailable) {
                                $btnClass .= 'bg-red-500 text-white cursor-not-allowed'; 
                            } elseif ($isChosen) {
                                $btnClass .= 'bg-blue-600 text-white'; 
                            } else {
                                $btnClass .= 'bg-gray-100 text-gray-800 hover:bg-gray-200'; 
                            }
                        ?>

                        <button 
                            wire:click="toggleSeat(<?php echo e($seat->id); ?>)"
                            <?php if(!$isAvailable): ?> disabled <?php endif; ?>
                            class="<?php echo e($btnClass); ?>">
                            <div><?php echo e($seat->seat_number); ?></div>
                            <span class="text-[10px] block font-normal">
                                <?php echo e(!$isAvailable ? 'TERISI' : ($isChosen ? 'DIPILIH' : 'TERSEDIA')); ?>

                            </span>
                        </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-12 text-gray-400 text-sm italic border border-dashed rounded-lg mb-8">
            Silakan pilih jadwal film terlebih dahulu untuk menampilkan denah kursi.
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="border-t pt-4 flex justify-between items-center mt-6 bg-gray-50 p-4 rounded-lg shadow-inner">
        <div>
            <p class="text-sm text-gray-600">Kursi Dipilih: <span class="font-bold text-gray-900"><?php echo e(count($selectedSeats)); ?></span></p>
            <p class="text-lg font-bold text-gray-900">Total: Rp <?php echo e(number_format(count($selectedSeats) * 50000, 0, ',', '.')); ?></p>
        </div>
        
        <button 
            wire:click="checkout" 
            <?php if(!$showtime_id || count($selectedSeats) === 0): ?> disabled <?php endif; ?>
            style="
                display: block;
                padding: 12px 24px;
                background-color: #16a34a;
                color: #ffffff;
                font-weight: 700;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                transition: background-color 0.15s ease;
            "
            onmouseover="this.style.backgroundColor='#15803d'"
            onmouseout="this.style.backgroundColor='#16a34a'"
            class="disabled:opacity-50 disabled:cursor-not-allowed">
            Konfirmasi & Pesan Tiket
        </button>
    </div>
</div><?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\storage\framework\views/livewire/views/4b239c8f.blade.php ENDPATH**/ ?>