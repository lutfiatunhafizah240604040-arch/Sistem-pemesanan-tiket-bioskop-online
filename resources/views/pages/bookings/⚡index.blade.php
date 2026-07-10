<?php

use Livewire\Component;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Seat;
use App\Models\Showtimes; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

new class extends Component
{
    public $showtime_id = '';
    public $selectedSeats = []; // Menyimpan ID kursi yang dipilih user

    // Mengambil data saat halaman dimuat
    public function with(): array
    {
        return [
            'showtimes' => Showtimes::with('movie')->get(), 
            // Ambil semua kursi, kelompokkan berdasarkan baris (A, B, dst) untuk denah
            'seats' => Seat::all()->groupBy(function($item) {
                return substr($item->seat_number, 0, 1);
            })
        ];
    }

    // Fungsi aksi ketika user klik tombol kursi
    public function toggleSeat($seatId)
    {
        $seat = Seat::find($seatId);
        
        // Jika kursi sudah terisi di sistem, abaikan klik user
        if (!$seat || !$seat->is_available) {
            return;
        }

        // Jika sudah dipilih, batalkan pilihan. Jika belum, tambahkan ke array.
        if (in_array($seatId, $this->selectedSeats)) {
            $this->selectedSeats = array_diff($this->selectedSeats, [$seatId]);
        } else {
            $this->selectedSeats[] = $seatId;
        }
    }

    // Proses Simpan Transaksi Tiket
    public function checkout()
    {
        $this->validate([
            'showtime_id' => 'required|exists:showtimes,id', 
            'selectedSeats' => 'required|array|min:1',
        ]);

        $ticketPrice = 50000; // Contoh harga Rp 50.000 per kursi
        $totalPrice = count($this->selectedSeats) * $ticketPrice;

        DB::beginTransaction();

        try {
            $bookingCode = 'TKT-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // 1. Simpan data utama booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'showtime_id' => $this->showtime_id,
                'booking_code' => $bookingCode,
                'total_price' => $totalPrice,
                'status' => 'success',
            ]);

            // 2. Simpan detail kursi & update status kursi di denah admin menjadi terisi
            foreach ($this->selectedSeats as $seatId) {
                BookingDetail::create([
                    'booking_id' => $booking->id,
                    'seat_id' => $seatId,
                ]);

                $seat = Seat::find($seatId);
                if ($seat) {
                    $seat->update(['is_available' => false]); // Ubah status ke Terisi
                }
            }

            DB::commit();

            session()->flash('success', 'Tiket berhasil dipesan! Kode: ' . $bookingCode);
            $this->selectedSeats = []; // Bersihkan pilihan kursi setelah sukses

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal memesan tiket: ' . $e->getMessage());
        }
    }
};
?>

<div class="p-6 bg-white rounded-lg shadow max-w-4xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Pemesanan Tiket Online</h2>

    @if (session()->has('success'))
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-l: 4px solid #10b981;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #10b981; background-color: #d1fae5; border-radius: 6px;">
                <svg style="width: 20 h: 20" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div style="margin-left: 12px; font-size: 14px; font-weight: 600; color: #374151;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-l: 4px solid #ef4444;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #ef4444; background-color: #fee2e2; border-radius: 6px;">
                <svg style="width: 20 h: 20" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div style="margin-left: 12px; font-size: 14px; font-weight: 600; color: #374151;">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Jadwal Film</label>
        <select wire:model.live="showtime_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">-- Pilih Jadwal --</option>
            @foreach($showtimes as $st)
                <option value="{{ $st->id }}">
                    {{ $st->movie->title ?? 'Film Tidak Diketahui' }} - {{ \Carbon\Carbon::parse($st->start_time)->format('H:i') }}
                </option>
            @endforeach
        </select>
    </div>

    @if($showtime_id && $showtime_id != '')
        <div class="w-full bg-gray-300 text-center text-xs font-bold py-2 rounded mb-10 tracking-widest text-gray-600">
            LAYAR UTAMA
        </div>

        <div class="space-y-4 mb-8">
            @foreach($seats as $row => $rowSeats)
                <div class="flex justify-center gap-4 items-center">
                    @foreach($rowSeats as $seat)
                        @php
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
                        @endphp

                        <button 
                            wire:click="toggleSeat({{ $seat->id }})"
                            @if(!$isAvailable) disabled @endif
                            class="{{ $btnClass }}">
                            <div>{{ $seat->seat_number }}</div>
                            <span class="text-[10px] block font-normal">
                                {{ !$isAvailable ? 'TERISI' : ($isChosen ? 'DIPILIH' : 'TERSEDIA') }}
                            </span>
                        </button>
                    @endforeach
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 text-gray-400 text-sm italic border border-dashed rounded-lg mb-8">
            Silakan pilih jadwal film terlebih dahulu untuk menampilkan denah kursi.
        </div>
    @endif

    <div class="border-t pt-4 flex justify-between items-center mt-6 bg-gray-50 p-4 rounded-lg shadow-inner">
        <div>
            <p class="text-sm text-gray-600">Kursi Dipilih: <span class="font-bold text-gray-900">{{ count($selectedSeats) }}</span></p>
            <p class="text-lg font-bold text-gray-900">Total: Rp {{ number_format(count($selectedSeats) * 50000, 0, ',', '.') }}</p>
        </div>
        
        <button 
            wire:click="checkout" 
            @if(!$showtime_id || count($selectedSeats) === 0) disabled @endif
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
</div>