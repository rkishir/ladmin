@section('title', 'Websites title')
<div>
    <div class="flex justify-between">
        <h1>Websites</h1>
        <div>
            <livewire:admin.websites.create/>
        </div>
    </div>
    @include('errors.messages')


    <div class="bg-primary text-gray-200 py-2 px-4 my-5 rounded-md">
       List of websites
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4">

        <div class="col-span-2">
            <x-form.input type="search" id="websites" name="query" wire:model="query" label="none" placeholder="Search Roles">
                {{ old('query', request('query')) }}
            </x-form.input>
        </div>

    </div>

    <table>
        <thead>
        <tr>
            <th>
                <a href="#" wire:click.prevent="sortBy('name')">Name</a>
            </th>
            <th>
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->websites() as $website)
            <tr>
                <td>{{ $website->name }}</td>
                <td>
                    <div class="flex space-x-2">

                        <a href="{{ route('admin.websites.edit', ['website' => $website->id]) }}">Edit</a>

                        @if ($website->label == 'App')

                        @else
                            <x-modal>
                                <x-slot name="trigger">
                                    <a href="#" @click="on = true">Delete</a>
                                </x-slot>

                                <x-slot name="title">Confirm Delete</x-slot>

                                <x-slot name="content">
                                    <div class="text-center">
                                        Are you sure you want to role: <b>{{ $website->name }}</b>
                                    </div>
                                </x-slot>

                                <x-slot name="footer">
                                    <button class="btn" @click="on = false">Cancel</button>
                                    <button class="btn btn-red" wire:click="deleteRole('{{ $website->id }}')">Delete Website</button>
                                </x-slot>
                            </x-modal>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $this->websites()->links() }}

</div>
