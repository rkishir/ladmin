<div>
    <x-tab name="company">

    <x-tabs.header>
        <x-tabs.link name="details">Details</x-tabs.link>
        <x-tabs.link name="company">Company</x-tabs.link>
        <x-tabs.link name="team">Team</x-tabs.link>
    </x-tabs.header>

    <x-tabs.div name="details">
        <p>Details</p>
    </x-tabs.div>

    <x-tabs.div name="company">
        <p>Company</p>
    </x-tabs.div>

    <x-tabs.div name="team">
        <p>Team</p>
    </x-tabs.div>

</x-tab>

    <x-accordian  >
         <x-slot name="lefta">
            <h3>Rolesdd</h3>
            <p>dadfasdf .</p>
        </x-slot>
    </x-accordian>

    <div class="card">

        <div class="flex justify-between">
            <h2 class="mb-5">Add User form here</h2>
            <div>
                <span class="error">*</span>
                <span class="dark:text-gray-200"> = required</span>
            </div>
        </div>

            <h4>Select Role</h4>
            @error('rolesSelected')
                <p class="error">{{ $message }}</p>
            @enderror

            <x-form.input wire:model="name" label='Name' name='name' required></x-form.input>
            <x-form.input wire:model="email" label='Email' name='email' required></x-form.input>
            <x-form.input wire:model="password" type="password" label='Password' name='password'></x-form.input>
            <x-form.input wire:model="confirmPassword" type="password" label='Confirm Password' name='confirmPassword'></x-form.input>

            <x-button wire:click="store">Add User</x-button>

            @include('errors.messages')


    </div>
</div>
