<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Booking;
use Illuminate\Validation\ValidationException;

class Edit extends Component
{
    public ?int $bookingId = null;
    public string $name = '';
    public string $description = '';
    public bool $hasChanges = false;
    public bool $isSaving = false;
    public array $formErrors = [];

    #[On('edit-booking')]
    public function editBooking($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $this->bookingId = $booking->id;
            $this->name = $booking->name;
            $this->description = $booking->description ?? '';
            $this->hasChanges = false;
            $this->formErrors = [];
            $this->dispatch('open-modal', 'edit-booking');
        }
    }

    public function updatedName()
    {
        $this->hasChanges = true;
    }

    public function updatedDescription()
    {
        $this->hasChanges = true;
    }

    public function save()
    {
        try {
            $this->isSaving = true;
            $this->formErrors = [];
            
            $validated = validator([
                'name' => $this->name,
                'description' => $this->description,
            ], [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
            ])->validate();

            if ($this->bookingId) {
                $booking = Booking::find($this->bookingId);
                $booking->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
            } else {
                Booking::create([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
            }
            
            $this->hasChanges = false;
            $this->isSaving = false;
            
            $this->dispatch('close-modal', 'edit-booking');
            $this->dispatch('booking-updated');
        } catch (ValidationException $e) {
            $this->formErrors = $e->errors();
            $this->isSaving = false;
        }
    }

    public function cancel()
    {
        $this->hasChanges = false;
        $this->bookingId = null;
        $this->name = '';
        $this->description = '';
        $this->formErrors = [];
        $this->dispatch('close-modal', 'edit-booking');
    }

    public function render()
    {
        return view('livewire.booking.edit');
    }
}
