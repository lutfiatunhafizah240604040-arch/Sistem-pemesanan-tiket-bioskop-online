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

<!-- Memastikan Tailwind CSS ter-load dengan sempurna untuk layout luar -->


<div class="p-6 bg-white rounded-lg shadow max-w-4xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Pemesanan Tiket Online</h2>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-left: 4px solid #10b981;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #10b981; background-color: #d1fae5; border-radius: 6px;">
                <svg style="width: 20px; height: 20px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div style="margin-left: 12px; font-size: 14px; font-weight: 600; color: #374151;">
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-left: 4px solid #ef4444;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #ef4444; background-color: #fee2e2; border-radius: 6px;">
                <svg style="width: 20px; height: 20px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
        <div style="max-width: 600px; margin-left: auto; margin-right: auto; margin-top: 32px;">
            <div class="mb-8 w-full rounded-b-3xl bg-zinc-300 py-3 text-center text-xs font-bold tracking-widest text-zinc-700 shadow-inner">
                LAYAR UTAMA / SCREEN
            </div>

            <!-- Wadah Baris Kursi (Menggunakan CSS Murni agar pasti Vertikal ke Bawah per Baris) -->
            <div style="display: flex; flex-direction: column; gap: 24px; width: 100%; align-items: center;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $rowSeats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <!-- Baris Kontainer: Menyatukan Label Huruf dan Barisan Kursi -->
                    <div style="display: flex; align-items: center; gap: 16px; justify-content: center; width: 100%;">
                        
                        <!-- Label Huruf Baris (A, B, dll) -->
                        <div style="width: 24px; text-align: center; font-size: 14px; font-weight: bold; color: #71717a;">
                            <?php echo e($row); ?>

                        </div>
                        
                        <!-- KUNCI UTAMA: Grid Murni CSS 5 Kolom Horizontal Berjejer ke Samping -->
                        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $rowSeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php
                                    $isChosen = in_array($seat->id, $selectedSeats);
                                    $isAvailable = $seat->is_available;

                                    // Base inline style untuk kotak kursi bioskop
                                    $btnStyle = 'width: 75px; padding-top: 10px; padding-bottom: 10px; display: flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 8px; font-size: 13px; font-weight: bold; border: 1px solid #e4e4e7; transition: transform 0.15s ease; cursor: pointer;';
                                    
                                    if (!$isAvailable) {
                                        $btnStyle .= ' background-color: #f4f4f5; color: #a1a1aa; cursor: not-allowed;';
                                    } elseif ($isChosen) {
                                        $btnStyle .= ' background-color: #2563eb; color: #ffffff; border-color: #2563eb;';
                                    } else {
                                        $btnStyle .= ' background-color: #f4f4f5; color: #18181b;';
                                    }
                                ?>

                                <button
                                    wire:click="toggleSeat(<?php echo e($seat->id); ?>)"
                                    <?php if(!$isAvailable): ?> disabled <?php endif; ?>
                                    style="<?php echo e($btnStyle); ?>"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                    
                                    <!-- Nomor Kursi (Atas) -->
                                    <div><?php echo e($seat->seat_number); ?></div>
                                    
                                    <!-- Label Teks Status (Bawah) -->
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isAvailable): ?>
                                        <span style="font-size: 9px; color: #ef4444; font-weight: normal; margin-top: 4px; display: block;">TERISI</span>
                                    <?php elseif($isChosen): ?>
                                        <span style="font-size: 9px; color: #bfdbfe; font-weight: normal; margin-top: 4px; display: block;">PILIH</span>
                                    <?php else: ?>
                                        <span style="font-size: 9px; color: #a1a1aa; font-weight: normal; margin-top: 4px; display: block;">TERSEDIA</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
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