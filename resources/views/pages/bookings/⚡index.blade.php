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
        $activeShowtime = Showtimes::find($this->showtime_id);

        $seatsQuery = Seat::query();
        if ($activeShowtime) {
            $seatsQuery->where('studio_id', 1);
        } else {
            $seatsQuery->whereNull('id');
        }

        return [
            'showtimes' => Showtimes::with('movie')->get(),
            'seats' => $seatsQuery->get()->groupBy(function ($item) {
                return substr($item->seat_number, 0, 1);
            }),
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

<!-- Memastikan Tailwind CSS ter-load dengan sempurna untuk layout luar -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="p-6 bg-white rounded-lg shadow max-w-4xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Pemesanan Tiket Online</h2>

    @if (session()->has('success'))
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-left: 4px solid #10b981;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #10b981; background-color: #d1fae5; border-radius: 6px;">
                <svg style="width: 20px; height: 20px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div style="margin-left: 12px; font-size: 14px; font-weight: 600; color: #374151;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div role="alert" style="position: fixed; top: 30px; right: 30px; z-index: 99999; display: flex; align-items: center; width: 100%; max-width: 340px; padding: 16px; color: #1f2937; background-color: #ffffff; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-left: 4px solid #ef4444;">
            <div style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; width: 32px; height: 32px; color: #ef4444; background-color: #fee2e2; border-radius: 6px;">
                <svg style="width: 20px; height: 20px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
        <div style="max-width: 600px; margin-left: auto; margin-right: auto; margin-top: 32px;">
            <div class="mb-8 w-full rounded-b-3xl bg-zinc-300 py-3 text-center text-xs font-bold tracking-widest text-zinc-700 shadow-inner">
                LAYAR UTAMA / SCREEN
            </div>

            <!-- Wadah Baris Kursi (Menggunakan CSS Murni agar pasti Vertikal ke Bawah per Baris) -->
            <div style="display: flex; flex-direction: column; gap: 24px; width: 100%; align-items: center;">
                @foreach($seats as $row => $rowSeats)
                    <!-- Baris Kontainer: Menyatukan Label Huruf dan Barisan Kursi -->
                    <div style="display: flex; align-items: center; gap: 16px; justify-content: center; width: 100%;">
                        
                        <!-- Label Huruf Baris (A, B, dll) -->
                        <div style="width: 24px; text-align: center; font-size: 14px; font-weight: bold; color: #71717a;">
                            {{ $row }}
                        </div>
                        
                        <!-- KUNCI UTAMA: Grid Murni CSS 5 Kolom Horizontal Berjejer ke Samping -->
                        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px;">
                            @foreach($rowSeats as $seat)
                                @php
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
                                @endphp

                                <button
                                    wire:click="toggleSeat({{ $seat->id }})"
                                    @if(!$isAvailable) disabled @endif
                                    style="{{ $btnStyle }}"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                    
                                    <!-- Nomor Kursi (Atas) -->
                                    <div>{{ $seat->seat_number }}</div>
                                    
                                    <!-- Label Teks Status (Bawah) -->
                                    @if(!$isAvailable)
                                        <span style="font-size: 9px; color: #ef4444; font-weight: normal; margin-top: 4px; display: block;">TERISI</span>
                                    @elseif($isChosen)
                                        <span style="font-size: 9px; color: #bfdbfe; font-weight: normal; margin-top: 4px; display: block;">PILIH</span>
                                    @else
                                        <span style="font-size: 9px; color: #a1a1aa; font-weight: normal; margin-top: 4px; display: block;">TERSEDIA</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
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