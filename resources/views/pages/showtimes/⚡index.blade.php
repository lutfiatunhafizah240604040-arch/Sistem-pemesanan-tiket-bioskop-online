<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Showtimes; 

new class extends Component
{
    use WithPagination;

    public bool $showShowtimeModal = false;

    public $showtimeId; 
    public $movie_id; 
    public $cinema_name;
    public $studio_name;
    public $total_seats; 
    public $show_time;   

    #[Computed]
    public function showtimes()
    {
        return Showtimes::latest()->paginate(10);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['showtimeId', 'movie_id', 'cinema_name', 'studio_name', 'total_seats', 'show_time']); 
        $this->showShowtimeModal = true; 
    }

    public function edit($id)
    {
        $this->resetValidation();

        $showtime = Showtimes::findOrFail($id);
        
        $this->showtimeId = $showtime->id;
        $this->movie_id = $showtime->movie_id;
        $this->cinema_name = $showtime->cinema_name;
        $this->studio_name = $showtime->studio_name;
        $this->total_seats = $showtime->price; 
        $this->show_time = $showtime->show_time; 

        $this->showShowtimeModal = true;
    }

    public function save()
    {
        $this->validate([
            'movie_id'    => 'required|exists:movies,id', 
            'cinema_name' => 'required|string|max:255',
            'studio_name' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1', 
            'show_time'   => 'required', 
        ]);

        Showtimes::updateOrCreate(
            ['id' => $this->showtimeId],
            [
                'movie_id'    => $this->movie_id, 
                'cinema_name' => $this->cinema_name,
                'studio_name' => $this->studio_name,
                'price'       => $this->total_seats, 
                'show_time'   => $this->show_time, 
            ]
        );

        $this->showShowtimeModal = false; 
        
        $message = $this->showtimeId ? 'Showtime successfully updated!' : 'Showtime successfully added!';
        session()->flash('message', $message);

        $this->reset(['showtimeId', 'movie_id', 'cinema_name', 'studio_name', 'total_seats', 'show_time']);
    }

    public function delete($id)
    {
        $showtime = Showtimes::findOrFail($id);
        $showtime->delete();
        
        session()->flash('message', 'Showtime successfully deleted!');
    }
};
?>

{{-- SATU-SATUNYA ELEMEN ROOT PEMBUNGKUS LIVEWIRE --}}
<div>
    {{-- NOTIFIKASI SUKSES --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 3000)" 
             x-show="show"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             role="alert" 
             style="position: fixed !important; top: 30px !important; right: 30px !important; z-index: 99999 !important; display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: flex-start !important; width: auto !important; min-width: 350px !important; max-width: 550px !important; padding: 16px 20px !important; color: #1f2937 !important; background-color: #ffffff !important; border-radius: 12px !important; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; border-left: 4px solid #10b981 !important;">
            
            <div style="display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important; width: 30px !important; height: 30px !important; color: #10b981 !important; background-color: #d1fae5 !important; border-radius: 8px !important;">
                <svg style="width: 16px !important; height: 16px !important;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            
            <div style="margin-left: 14px !important; font-size: 14px !important; font-weight: 500 !important; color: #1f2937 !important; white-space: nowrap !important; display: inline-flex !important; align-items: center !important; flex-shrink: 0 !important;">
                {{ session('message') }}
            </div>
        </div>
    @endif

    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Showtimes</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Manage your showtime schedules</p>
        </div>

        <hr class="border-zinc-200 dark:border-zinc-800" />

        <div class="space-y-4">
            @if (auth()->user()?->isAdmin())
                <div class="flex justify-start">
                    <flux:button variant="primary" icon="plus" wire:click="create">Add Showtime</flux:button>
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg border border-zinc-200 bg-white shadow-sm px-2">
                <flux:table :paginate="$this->showtimes">
                    <flux:table.columns>
                        <flux:table.column class="pl-4">No</flux:table.column>
                        <flux:table.column>Movie</flux:table.column> {{-- Kolom Judul Film --}}
                        <flux:table.column>Cinema</flux:table.column> {{-- Kolom Nama Bioskop --}}
                        <flux:table.column>Studio</flux:table.column>
                        <flux:table.column>Showtime</flux:table.column>
                        <flux:table.column>Price</flux:table.column>
                        <flux:table.column>Action</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($this->showtimes as $index => $showtime)
                            <flux:table.row :key="$showtime->id">
                                
                                <flux:table.cell class="pl-4 font-medium text-zinc-500">
                                    {{ $this->showtimes->firstItem() + $index }}
                                </flux:table.cell>

                                {{-- Menampilkan Judul Film Asli --}}
                                <flux:table.cell class="font-semibold text-zinc-900">
                                    {{ $showtime->movie->title ?? 'No Movie Connected' }}
                                </flux:table.cell>

                                {{-- Menampilkan Nama Bioskop (misal: Grand XXI) --}}
                                <flux:table.cell class="text-zinc-600">
                                    {{ $showtime->cinema_name ?? '-' }}
                                </flux:table.cell>

                                <flux:table.cell class="text-zinc-600">
                                    {{ $showtime->studio_name }}
                                </flux:table.cell>

                                <flux:table.cell class="text-zinc-600">
                                    {{ $showtime->show_time ? \Carbon\Carbon::parse($showtime->show_time)->format('d M Y, H:i') : '-' }}
                                </flux:table.cell>

                                <flux:table.cell class="text-zinc-600 font-medium">
                                    Rp {{ number_format($showtime->price, 0, ',', '.') }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    @if (auth()->user()?->isAdmin())
                                        <flux:dropdown>
                                            <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                                            <flux:menu>
                                                <flux:menu.item icon="pencil" wire:click="edit({{ $showtime->id }})">Edit</flux:menu.item>
                                                <flux:menu.separator />
                                                <flux:menu.item variant="danger" icon="trash" wire:click="delete({{ $showtime->id }})" wire:confirm="Are you sure?">Delete</flux:menu.item>
                                            </flux:menu>
                                        </flux:dropdown>
                                    @else
                                        <span class="text-xs text-zinc-400">Read-only</span>
                                    @endif
                                </flux:table.cell>

                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </div>
        </div>

        <flux:modal wire:model="showShowtimeModal" class="md:w-96 space-y-6">
            <div>
                <flux:heading size="lg">{{ $showtimeId ? 'Edit Showtime' : 'Add New Showtime' }}</flux:heading>
                <flux:subheading>Fill in the details to manage showtime data.</flux:subheading>
            </div>

            <form wire:submit.prevent="save" class="space-y-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-zinc-800 dark:text-zinc-200">Select Movie</label>
                    <select wire:model="movie_id" class="w-full rounded-lg border border-zinc-200 p-2 text-sm dark:bg-zinc-800 dark:border-zinc-700 bg-white" required>
                        <option value="">-- Choose Movie --</option>
                        @foreach(\App\Models\Movies::all() as $movie)
                            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                        @endforeach
                    </select>
                    @error('movie_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-zinc-800 dark:text-zinc-200">Cinema Name</label>
                    <select wire:model="cinema_name" class="w-full rounded-lg border border-zinc-200 p-2 text-sm dark:bg-zinc-800 dark:border-zinc-700 bg-white" required>
                        <option value="">-- Choose Cinema --</option>
                        <option value="CGV Cinemas">CGV Cinemas</option>
                        <option value="XXI">XXI</option>
                        <option value="Cinepolis">Cinepolis</option>
                        <option value="Cinema 21">Cinema 21</option>
                        <option value="Grand XXI">Grand XXI</option>
                    </select>
                    @error('cinema_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-zinc-800 dark:text-zinc-200">Studio Name</label>
                    <select wire:model="studio_name" class="w-full rounded-lg border border-zinc-200 p-2 text-sm dark:bg-zinc-800 dark:border-zinc-700 bg-white" required>
                        <option value="">-- Choose Studio --</option>
                        <option value="Studio 1">Studio 1</option>
                        <option value="Studio 2">Studio 2</option>
                        <option value="Studio 3">Studio 3</option>
                        <option value="Studio 4">Studio 4</option>
                        <option value="Studio 5">Studio 5</option>
                    </select>
                    @error('studio_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <flux:input wire:model="show_time" type="datetime-local" label="Showtime Date & Time" required />
                @error('show_time') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                <flux:input wire:model="total_seats" type="number" label="Price / Total Seats" placeholder="e.g. 50000" required />
                @error('total_seats') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                <div class="flex space-x-2 justify-end mt-6">
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="save">Save Showtime</flux:button>
                </div>
            </form>
        </flux:modal>
    </div>
</div>