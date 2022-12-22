<div>
    <div class="card">

        <div class="flex justify-between">
            <h2 class="mb-5">Add User</h2>
            <div>
                <span class="error">*</span>
                <span class="dark:text-gray-200"> = required</span>
            </div>
        </div>

            <h4>Select Role</h4>
            @error('rolesSelected')
                <p class="error">{{ $message }}</p>
            @enderror

            @foreach($roles as $role)
                <p><x-form.checkbox wire:model="rolesSelected" :label="$role->label" :wire:key="$role->id" value="{{ $role->id }}" />
            @endforeach

            <x-form.input wire:model="name" label='Name' name='name' required></x-form.input>
            <x-form.input wire:model="email" label='Email' name='email' required></x-form.input>
            <x-form.input wire:model="password" type="password" label='Password' name='password'></x-form.input>
            <x-form.input wire:model="confirmPassword" type="password" label='Confirm Password' name='confirmPassword'></x-form.input>

            <x-button wire:click="store">Add User</x-button>

            @include('errors.messages')


    </div>
</div>
