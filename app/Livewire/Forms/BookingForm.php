<?php

namespace App\Livewire\Forms;

use App\Models\Booking;

class BookingForm
{
    public ?int $id = null;
    public string $name = '';
    public string $description = '';

    public function setBooking(Booking $booking)
    {
        $this->id = $booking->id;
        $this->name = $booking->name;
        $this->description = $booking->description ?? '';
    }

    public function validate()
    {
        return validator([
            'name' => $this->name,
            'description' => $this->description,
        ], [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ])->validate();
    }

    public function store()
    {
        $this->validate();

        if ($this->id) {
            $booking = Booking::find($this->id);
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

        $this->reset();
    }

    public function reset()
    {
        $this->id = null;
        $this->name = '';
        $this->description = '';
    }
}
