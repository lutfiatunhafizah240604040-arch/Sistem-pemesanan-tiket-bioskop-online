<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\WithFileUploads; 
use App\Models\Movies;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithPagination, WithFileUploads;

    public bool $showMovieModal = false;

    public $movieId; 
    public $title;
    public $genre; 
    public $release_year;
    public $duration;
    public $poster; 
    public $existingPoster; 

    #[Computed]
    public function movies()
    {
        return Movies::latest()->paginate(10);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['movieId', 'title', 'genre', 'release_year', 'duration', 'poster', 'existingPoster']); 
        $this->showMovieModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $this->reset(['poster']); 

        $movie = Movies::findOrFail($id);
        
        $this->movieId = $movie->id;
        $this->title = $movie->title;
        $this->genre = $movie->Genre; 
        $this->release_year = $movie->release_year;
        $this->duration = $movie->duration;
        $this->existingPoster = $movie->poster_path;

        $this->showMovieModal = true;
    }

    public function save()
    {
        $validated = $this->validate([
            'title'        => 'required|string|max:255',
            'genre'        => 'nullable|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'duration'     => 'required|integer|min:1',
            'poster'       => 'nullable|image|max:2048', 
        ]);

        $posterName = $this->existingPoster; 

        if ($this->poster) {
            if ($this->existingPoster && file_exists(public_path('posters/' . $this->existingPoster))) {
                @unlink(public_path('posters/' . $this->existingPoster));
            }

            $posterName = time() . '_' . preg_replace('/\s+/', '_', $this->poster->getClientOriginalName());
            
            $temporaryPath = $this->poster->getRealPath();
            
            if (!file_exists(public_path('posters'))) {
                mkdir(public_path('posters'), 0755, true);
            }

            rename($temporaryPath, public_path('posters/' . $posterName));
        }

        Movies::updateOrCreate(
            ['id' => $this->movieId],
            [
                'title'        => $this->title,
                'Genre'        => $this->genre, 
                'release_year' => $this->release_year,
                'duration'     => $this->duration,
                'poster_path'  => $posterName,
            ]
        );

        $this->showMovieModal = false;
        
        $message = $this->movieId ? 'Movie successfully updated!' : 'Movie successfully added!';
        session()->flash('message', $message);

        $this->reset(['movieId', 'title', 'genre', 'release_year', 'duration', 'poster', 'existingPoster']);
    }

    public function delete($id)
    {
        $movie = Movies::findOrFail($id);

        if ($movie->poster_path && file_exists(public_path('posters/' . $movie->poster_path))) {
            @unlink(public_path('posters/' . $movie->poster_path));
        }

        $movie->delete();
        session()->flash('message', 'Movie successfully deleted!');
    }
};
?>

{{-- SATU-SATUNYA ELEMEN ROOT PEMBUNGKUS LIVEWIRE --}}
<div>
    {{-- NOTIFIKASI SUKSES (FIXED: Dipaksa Flex Row Kesamping Menggunakan !important) --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 3000)" 
             x-show="show"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             role="alert" 
             style="position: fixed !important; top: 30px !important; right: 30px !important; z-index: 99999 !important; display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: flex-start !important; width: auto !important; min-width: 350px !important; max-width: 550px !important; padding: 16px 20px !important; color: #1f2937 !important; background-color: #ffffff !important; border-radius: 12px !important; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; border-left: 4px solid #10b981 !important;">
            
            {{-- Wadah Ikon Centang --}}
            <div style="display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important; width: 30px !important; height: 30px !important; color: #10b981 !important; background-color: #d1fae5 !important; border-radius: 8px !important;">
                <svg style="width: 16px !important; height: 16px !important;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            
            {{-- Wadah Teks Pesan (Diberikan white-space: nowrap dan display inline-flex) --}}
            <div style="margin-left: 14px !important; font-size: 14px !important; font-weight: 500 !important; color: #1f2937 !important; white-space: nowrap !important; display: inline-flex !important; align-items: center !important; flex-shrink: 0 !important;">
                {{ session('message') }}
            </div>
        </div>
    @endif

    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Movies</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Manage your movies</p>
        </div>

        <hr class="border-zinc-200 dark:border-zinc-800" />

        <div class="space-y-4">
            <div class="flex justify-start">
                <flux:button variant="primary" icon="plus" wire:click="create">Add Movies</flux:button>
            </div>

            <div class="overflow-x-auto rounded-lg border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-sm px-2">
                <flux:table :paginate="$this->movies">
                    <flux:table.columns>
                        <flux:table.column class="pl-4">No</flux:table.column>
                        <flux:table.column>Poster</flux:table.column>
                        <flux:table.column>Title</flux:table.column>
                        <flux:table.column>Genre</flux:table.column> 
                        <flux:table.column>Year</flux:table.column>
                        <flux:table.column>Duration</flux:table.column>
                        <flux:table.column>Created At</flux:table.column>
                        <flux:table.column>Action</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($this->movies as $index => $movie)
                            <flux:table.row :key="$movie->id" class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                
                                <flux:table.cell class="pl-4 font-medium text-zinc-500">
                                    {{ $this->movies->firstItem() + $index }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    <div class="flex items-center justify-start py-1">
                                        @if($movie->poster_path)
                                            <img src="{{ asset('posters/' . $movie->poster_path) }}" alt="Poster {{ $movie->title }}" class="w-10 h-14 object-cover rounded shadow-sm border border-zinc-200 dark:border-zinc-700">
                                        @else
                                            <div class="w-10 h-14 bg-zinc-100 dark:bg-zinc-800 rounded flex items-center justify-center text-[9px] text-zinc-400 text-center px-1">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                </flux:table.cell>

                                <flux:table.cell class="font-semibold text-zinc-900 dark:text-white whitespace-nowrap">
                                    {{ $movie->title }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700">
                                        {{ $movie->Genre ?? '-' }}
                                    </span>
                                </flux:table.cell>

                                <flux:table.cell class="text-zinc-600 dark:text-zinc-300 font-medium whitespace-nowrap">
                                    {{ $movie->release_year }}
                                </flux:table.cell>

                                <flux:table.cell class="text-zinc-600 dark:text-zinc-300 whitespace-nowrap">
                                    {{ $movie->duration }} mins
                                </flux:table.cell>

                                <flux:table.cell class="text-zinc-500 dark:text-zinc-400 text-xs whitespace-nowrap">
                                    {{ $movie->created_at ? $movie->created_at->diffForHumans() : '-' }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    <flux:dropdown>
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                                        <flux:menu>
                                            <flux:menu.item icon="pencil" wire:click="edit({{ $movie->id }})">Edit</flux:menu.item>
                                            <flux:menu.separator />
                                            <flux:menu.item variant="danger" icon="trash" wire:click="delete({{ $movie->id }})" wire:confirm="Are you sure you want to delete this movie?">Delete</flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </flux:table.cell>

                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </div>
        </div>

        {{-- MODAL TAMBAH/EDIT FILM --}}
        <flux:modal wire:model="showMovieModal" class="md:w-96 space-y-6">
            <div>
                <flux:heading size="lg">{{ $movieId ? 'Edit Movie' : 'Add New Movie' }}</flux:heading>
                <flux:subheading>Fill in the form below to save movie information.</flux:subheading>
            </div>

            <form wire:submit.prevent="save" class="space-y-4">
                <flux:input wire:model="title" label="Title" placeholder="e.g. Inception" required />
                @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                
                <flux:input wire:model="genre" label="Genre" placeholder="e.g. Sci-Fi, Action" />
                @error('genre') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:input wire:model="release_year" type="number" label="Year" placeholder="2010" required />
                        @error('release_year') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <flux:input wire:model="duration" type="number" label="Duration (mins)" placeholder="148" required />
                        @error('duration') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if ($existingPoster && !$poster)
                    <div class="mt-2 text-xs text-zinc-500">
                        <p class="mb-1">Current Poster:</p>
                        <img src="{{ asset('posters/' . $existingPoster) }}" class="w-16 h-20 object-cover rounded border">
                    </div>
                @endif

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-zinc-800 dark:text-zinc-200">Poster Image</label>
                    <input type="file" wire:model="poster" class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-zinc-50 file:text-zinc-700
                        hover:file:bg-zinc-100
                        dark:file:bg-zinc-800 dark:file:text-zinc-200" />
                    
                    <span wire:loading wire:target="poster" class="text-xs text-blue-500">Uploading image...</span>
                    @error('poster') <span class="text-xs text-red-500 d-block">{{ $message }}</span> @enderror
                </div>

                <div class="flex space-x-2 justify-end mt-6">
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="poster, save">Save Movie</flux:button>
                </div>
            </form>
        </flux:modal>
    </div>
</div>