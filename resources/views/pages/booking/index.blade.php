<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Booking;

new class extends Component
{
    use WithPagination;

    public $editId = null;
    public $isEditing = false;
    public $editUserId = '';
    public $editShowtimeId = '';
    public $editBookingDate = '';
    public $editTotalPrice = '';
    public $editPaymentStatus = 'pending';

    #[Computed]
    public function bookings()
    {
        return Booking::latest()->paginate(10);
    }

    #[On('booking:created')]
    public function store(array $data)
    {
        Booking::create($data);
        $this->resetPage();
    }

    public function update(): void
    {
        if (! $this->editId) {
            return;
        }

        $booking = Booking::find($this->editId);

        if (! $booking) {
            return;
        }

        $booking->update([
            'user_id' => $this->editUserId,
            'showtime_id' => $this->editShowtimeId,
            'booking_date' => $this->editBookingDate,
            'total_price' => $this->editTotalPrice,
            'payment_status' => $this->editPaymentStatus,
        ]);

        $this->resetEdit();
        $this->resetPage();
    }

    public function edit(int $id): void
    {
        $booking = Booking::find($id);

        if (! $booking) {
            return;
        }

        $this->editId = $booking->id;
        $this->editUserId = $booking->user_id;
        $this->editShowtimeId = $booking->showtime_id;
        $this->editBookingDate = $booking->booking_date;
        $this->editTotalPrice = $booking->total_price;
        $this->editPaymentStatus = $booking->payment_status;
        $this->isEditing = true;
    }

    public function cancelEdit(): void
    {
        $this->resetEdit();
    }

    protected function resetEdit(): void
    {
        $this->editId = null;
        $this->isEditing = false;
        $this->editUserId = '';
        $this->editShowtimeId = '';
        $this->editBookingDate = '';
        $this->editTotalPrice = '';
        $this->editPaymentStatus = 'pending';
    }

    public function delete(int $id): void
    {
        Booking::find($id)?->delete();
        $this->resetPage();
    }
};
?>

<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="space-y-2">
            <flux:heading size="xl" class="text-white">Bookings</flux:heading>
            <flux:subheading size="lg" class="text-zinc-400">Manage your bookings</flux:subheading>
        </div>

        <flux:modal.trigger name="create-booking">
            <flux:button variant="primary" icon="plus" color="primary">Add Booking</flux:button>
        </flux:modal.trigger>
    </div>

    <livewire:booking.create />

    @if ($isEditing)
        <div class="rounded-[2rem] border border-zinc-800 bg-zinc-950 p-6 shadow-lg">
            <div class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-white">Edit Booking</h2>
                    <p class="text-sm text-zinc-400">Update the booking details and save your changes.</p>
                </div>
                <flux:button variant="ghost" wire:click="cancelEdit">Cancel</flux:button>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <flux:input label="User ID" wire:model="editUserId" />
                <flux:input label="Showtime ID" wire:model="editShowtimeId" />
                <flux:input label="Booking Date" type="date" wire:model="editBookingDate" />
                <flux:input label="Total Price" type="number" wire:model="editTotalPrice" />
                <div class="md:col-span-2">
                    <label for="edit_payment_status" class="block text-sm font-medium text-zinc-300">Payment Status</label>
                    <select id="edit_payment_status" wire:model="editPaymentStatus" class="mt-1 block w-full rounded-lg border border-zinc-700 bg-zinc-900 px-3 py-2 text-sm text-zinc-100 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <flux:button variant="ghost" wire:click="cancelEdit">Cancel</flux:button>
                <flux:button variant="primary" wire:click="update">Save Changes</flux:button>
            </div>
        </div>
    @endif

    <div class="overflow-hidden rounded-[2rem] border border-zinc-800 bg-zinc-950 shadow-lg">
        <div class="border-b border-zinc-800 px-6 py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-zinc-400">Bookings</p>
                    <p class="mt-1 text-sm text-zinc-500">Manage your ticket orders from here.</p>
                </div>
                <p class="text-sm text-zinc-500">
                    Showing {{ $this->bookings->firstItem() ?? 0 }} to {{ $this->bookings->lastItem() ?? 0 }} of {{ $this->bookings->total() }} results
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <flux:table :paginate="$this->bookings" class="min-w-full bg-zinc-950 text-zinc-200">
                <flux:table.columns>
                    <flux:table.column class="pl-6 text-zinc-400">No</flux:table.column>
                    <flux:table.column class="text-zinc-400">User ID</flux:table.column>
                    <flux:table.column class="text-zinc-400">Showtime ID</flux:table.column>
                    <flux:table.column class="text-zinc-400">Booking Date</flux:table.column>
                    <flux:table.column class="text-zinc-400">Total Price</flux:table.column>
                    <flux:table.column class="text-zinc-400">Payment Status</flux:table.column>
                    <flux:table.column class="text-right pr-6 text-zinc-400">Action</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse($this->bookings as $booking)
                        <flux:table.row :key="$booking->id">
                            <flux:table.cell class="pl-6 text-zinc-200">{{ $loop->iteration + $this->bookings->firstItem() - 1 }}</flux:table.cell>
                            <flux:table.cell class="text-zinc-200">{{ $booking->user_id }}</flux:table.cell>
                            <flux:table.cell class="text-zinc-200">{{ $booking->showtime_id }}</flux:table.cell>
                            <flux:table.cell class="text-zinc-200">{{ $booking->booking_date }}</flux:table.cell>
                            <flux:table.cell class="text-zinc-200">{{ number_format($booking->total_price, 0, ',', '.') }}</flux:table.cell>
                            <flux:table.cell>
                                <span class="inline-flex rounded-full bg-zinc-800 px-3 py-1 text-xs font-semibold text-zinc-300">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell class="text-right pr-6">
                                <flux:dropdown>
                                    <flux:button icon="ellipsis-horizontal" variant="ghost" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="edit({{ $booking->id }})">Edit</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $booking->id }})">Delete</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="7" class="py-8 text-center text-zinc-500">No bookings found.</flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <div class="border-t border-zinc-800 px-6 py-4 text-sm text-zinc-500">
            Showing {{ $this->bookings->firstItem() ?? 0 }} to {{ $this->bookings->lastItem() ?? 0 }} of {{ $this->bookings->total() }} results
        </div>
    </div>
</div>
