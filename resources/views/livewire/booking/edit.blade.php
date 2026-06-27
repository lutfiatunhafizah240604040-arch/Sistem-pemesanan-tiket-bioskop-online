<div>
    <flux:modal name="edit-booking" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Booking</flux:heading>
                <flux:text class="mt-2">Make changes to your booking details.</flux:text>
            </div>

            <form wire:submit="save" class="space-y-4">
                <div>
                    <flux:input 
                        label="Name" 
                        placeholder="Booking name"
                        wire:model="name"
                        class="w-full"
                    />
                    @if(isset($formErrors['name']))
                        <span class="text-sm text-red-500 mt-1 block">{{ $formErrors['name'][0] ?? '' }}</span>
                    @endif
                </div>

                <div>
                    <flux:textarea 
                        label="Description" 
                        placeholder="Enter description..."
                        wire:model="description"
                        class="w-full"
                    />
                    @if(isset($formErrors['description']))
                        <span class="text-sm text-red-500 mt-1 block">{{ $formErrors['description'][0] ?? '' }}</span>
                    @endif
                </div>

                @if($hasChanges)
                    <div class="text-sm text-orange-500 font-medium">
                        you have unsaved changes
                    </div>
                @endif

                <div class="flex gap-3 pt-4">
                    <flux:spacer />
                    <flux:button 
                        type="button" 
                        variant="ghost"
                        wire:click="cancel"
                    >
                        Cancel
                    </flux:button>
                    <flux:button 
                        type="submit" 
                        variant="primary"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Update</span>
                        <span wire:loading>Saving...</span>
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
