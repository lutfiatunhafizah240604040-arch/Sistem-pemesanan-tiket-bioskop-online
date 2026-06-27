<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Booking;

new class extends Component
{
    use WithPagination;

    public $editId;
    public $user_id;
    public $showtime_id;
    public $booking_date;
    public $total_price;
    public $payment_status = 'Pending';

    #[Computed]
    public function Bookings()
    {
        return Booking::paginate(10);
    }

    public function edit($id = null)
    {
        if (!$id) return; // Menghindari crash jika ID kosong
        
        $booking = Booking::find($id);
        if ($booking) {
            $this->editId = $id;
            $this->user_id = $booking->user_id;
            $this->showtime_id = $booking->showtime_id;
            $this->booking_date = $booking->booking_date;
            $this->total_price = $booking->total_price;
            $this->payment_status = $booking->payment_status;
            $this->js("Flux.modal('create-Booking').show()");
        }
    }

    public function save()
    {
        $this->validate([
            'user_id' => 'required',
            'showtime_id' => 'required',
            'booking_date' => 'required|date',
            'total_price' => 'required|numeric',
            'payment_status' => 'required',
        ]);

        if ($this->editId) {
            Booking::find($this->editId)->update([
                'user_id' => $this->user_id,
                'showtime_id' => $this->showtime_id,
                'booking_date' => $this->booking_date,
                'total_price' => $this->total_price,
                'payment_status' => $this->payment_status,
            ]);
        } else {
            Booking::create([
                'user_id' => $this->user_id,
                'showtime_id' => $this->showtime_id,
                'booking_date' => $this->booking_date,
                'total_price' => $this->total_price,
                'payment_status' => $this->payment_status,
            ]);
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['editId', 'user_id', 'showtime_id', 'booking_date', 'total_price']);
        $this->payment_status = 'Pending';
    }

    public function delete($id)
    {
        if ($id) Booking::find($id)->delete();
    }
};
?>

<div>
    <div class="max-w-7xl mx-auto space-y-4">
        <flux:heading size="xl" class="text-zinc-800 dark:text-white">Bookings</flux:heading>
        <flux:separator variant="subtle" />

        <flux:modal.trigger name="create-Booking">
            <flux:button variant="primary" icon="plus" wire:click="resetForm">Add Booking</flux:button>
        </flux:modal.trigger>

        <flux:modal name="create-Booking" class="md:w-[25rem] space-y-6">
            <form wire:submit="save" x-on:submit="Flux.modal('create-Booking').close()" class="space-y-4">
                <div>
                    <flux:heading size="lg">{{ $editId ? 'Edit Booking' : 'Create Booking' }}</flux:heading>
                </div>

                <flux:input wire:model="user_id" label="User ID" type="number" required />
                <flux:input wire:model="showtime_id" label="Showtime ID" type="number" required />
                <flux:input wire:model="booking_date" label="Booking Date" type="date" required />
                <flux:input wire:model="total_price" label="Total Price" type="number" required />
                
                <flux:select wire:model="payment_status" label="Payment Status">
                    <flux:select.option value="Pending">Pending</flux:select.option>
                    <flux:select.option value="Paid">Paid</flux:select.option>
                </flux:select>

                <div class="flex space-x-2 justify-end mt-6">
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">{{ $editId ? 'Update' : 'Create' }}</flux:button>
                </div>
            </form>
        </flux:modal>

        <div class="overflow-x-auto">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>User_id</flux:table.column>
                    <flux:table.column>Showtime</flux:table.column>
                    <flux:table.column>Date</flux:table.column>
                    <flux:table.column>Price</flux:table.column>
                    <flux:table.column>Status</flux:table.column>
                    <flux:table.column>Action</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($this->Bookings as $Booking)
                        <flux:table.row>
                            <flux:table.cell>{{ $Booking->user_id }}</flux:table.cell>
                            <flux:table.cell>{{ $Booking->showtime_id }}</flux:table.cell>
                            <flux:table.cell>{{ $Booking->booking_date }}</flux:table.cell>
                            <flux:table.cell>Rp {{ number_format($Booking->total_price) }}</flux:table.cell>
                            <flux:table.cell>
                                <flux:badge variant="{{ $Booking->payment_status === 'Paid' ? 'success' : 'warning' }}">
                                    {{ $Booking->payment_status }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:dropdown>
                                    <flux:button variant="ghost" icon="ellipsis-horizontal" size="sm" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="edit({{ $Booking->id }})">Edit</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $Booking->id }})" wire:confirm="Yakin ingin menghapus?">Delete</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        </div>
    </div>
</div>