<?php

use Livewire\Component;

new class extends Component
{
    public $user_id = '';
    public $showtime_id = '';
    public $booking_date = '';
    public $total_price = '';
    public $payment_status = 'pending';

    public function store()
    {
        $this->dispatch('booking:created', [
            'user_id' => $this->user_id,
            'showtime_id' => $this->showtime_id,
            'booking_date' => $this->booking_date,
            'total_price' => $this->total_price,
            'payment_status' => $this->payment_status,
        ]);

        $this->reset();
    }

    public function cancel()
    {
        $this->reset();
    }
};
?>

<div>
    <flux:modal name="create-booking" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Booking</flux:heading>
                <flux:text class="mt-2">Add a new booking to the system.</flux:text>
            </div>
            <flux:input label="User ID" placeholder="Enter user ID" wire:model="user_id" />
            <flux:input label="Showtime ID" placeholder="Enter showtime ID" wire:model="showtime_id" />
            <flux:input label="Booking Date" type="date" wire:model="booking_date" />
            <flux:input label="Total Price" type="number" step="0.01" placeholder="0.00" wire:model="total_price" />
            <div>
                <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                <select id="payment_status" wire:model="payment_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div class="flex gap-3">
                <flux:button type="button" variant="ghost" wire:click="cancel">Cancel</flux:button>
                <flux:spacer />
                <flux:button type="button" variant="primary" wire:click="store">Create Booking</flux:button>
            </div>
        </div>
    </flux:modal>
</div>