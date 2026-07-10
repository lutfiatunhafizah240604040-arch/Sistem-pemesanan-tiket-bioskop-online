<?php

use Livewire\Component;
use Livewire\WithFileUploads; 
use App\Models\Movies;

new class extends Component
{
    // WAJIB dimasukkan agar Livewire bisa memproses upload file gambar
    use WithFileUploads;

    // Wadah penampung data dari form input (Mengikuti struktur form Anda)
    public $form = [
        'title'        => '',
        'Genre'        => '',
        'release_year' => '',
        'duration'     => '',
    ];

    // Khusus untuk file poster dipisah agar tidak merusak array teks
    public $poster; 

    public function save()
    {
        // 1. Validasi Data Inputan
        $this->validate([
            'form.title'        => 'required|string|max:255',
            'form.Genre'        => 'nullable|string|max:255',
            'form.release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'form.duration'     => 'required|integer|min:1',
            'poster'            => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        $posterName = null;

        // 2. Proses upload file gambar menggunakan sistem Storage Laravel
        if ($this->poster) {
            $posterName = time() . '_' . preg_replace('/\s+/', '_', $this->poster->getClientOriginalName());

            // Menggunakan storeAs bawaan Laravel ke disk 'public'
            $this->poster->storeAs('posters', $posterName, 'public');
        }

        // 3. Simpan data ke Database
        Movies::create([
            'title'        => $this->form['title'],
            'Genre'        => $this->form['Genre'], 
            'release_year' => $this->form['release_year'],
            'duration'     => $this->form['duration'],
            'poster_path'  => $posterName, // Menyimpan nama file gambar ke kolom poster_path
        ]);

        // 4. Reset form agar kosong kembali setelah sukses
        $this->reset(['form', 'poster']);
        
        // Buat pesan notifikasi sukses
        session()->flash('message', 'Movie successfully added!');
        
        // Tutup modal otomatis jika film berhasil disimpan
        $this->dispatch('close-modal', name: 'create-movie');
    }
};
?>

<div>
    <flux:modal name="create-movie" class="md:w-96">
        <form class="space-y-8" wire:submit.prevent="save">            
            {{-- header --}}            
            <div class="space-y-2">            
                <flux:heading size="lg" class="text-zinc-900 dark:text-white">                    
                    Create Movie                
                </flux:heading>                
                <flux:text class="text-zinc-500 dark:text-zinc-400">                    
                    Add a new movie to your catalog
                </flux:text>            
            </div>            
            
            {{-- form field --}}            
            <div class="space-y-6">                
                {{-- Title --}}
                <flux:input                    
                    label="Title"                    
                    placeholder="Enter movie title (e.g., Toy Story 5)"                    
                    wire:model="form.title"                
                />                
                @error('form.title') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Genre --}}
                    <div>
                        <flux:input                    
                            label="Genre"                    
                            placeholder="e.g., Animasi, Horor"                    
                            wire:model="form.Genre"                
                        />
                        @error('form.Genre') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Year --}}
                    <div>
                        <flux:input                    
                            type="number"
                            label="Release Year"                    
                            placeholder="e.g., 2026"                    
                            wire:model="form.release_year"                
                        />
                        @error('form.release_year') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Duration --}}
                    <div>
                        <flux:input                    
                            type="number"
                            label="Duration (minutes)"                    
                            placeholder="e.g., 102"                    
                            wire:model="form.duration"                
                        />
                        @error('form.duration') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Poster File Upload menggunakan Tag HTML Biasa agar Livewire tidak error --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-zinc-800 dark:text-zinc-200">Movie Poster</label>
                    <input 
                        type="file" 
                        wire:model="poster" 
                        class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-zinc-50 file:text-zinc-700
                            hover:file:bg-zinc-100
                            dark:file:bg-zinc-800 dark:file:text-zinc-200" 
                    />
                    @error('poster') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>                
            
            {{-- footer --}}            
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-800">                
                <flux:modal.close>                    
                    <flux:button variant="outline" color="neutral">Cancel</flux:button>                
                </flux:modal.close>                
                <flux:button variant="primary" color="primary" type="submit">Create</flux:button>            
            </div>                        
        </form>
    </flux:modal>
</div>