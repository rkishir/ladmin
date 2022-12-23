<div>
    @if(can('add_role'))
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true">Add Website</button>
        </x-slot>

        <x-slot name="title">Add Website</x-slot>

        <x-slot name="content">

            <x-form.input wire:model="name" label="Website" name="name" required>{{ old('name') }}</x-form.input>

        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancel</button>
            <button class="btn btn-primary" wire:click="store">Create Website</button>
        </x-slot>

    </x-modal>
    @endif
</div>
