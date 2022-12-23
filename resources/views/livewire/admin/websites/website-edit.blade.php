@section('title', 'Edit website')
<div>
    <div class="mb-5">
        <a href="{{ route('admin.websites.index') }}">Websites</a>
        <span class="dark:text-gray-200">- Edit Website</span>
    </div>


    <div class="float-right"><span class="text-red-600">*</span> <span class="dark:text-gray-200"> = required</span>
    </div>

    <div class="clearfix"></div>

    <x-form wire:submit.prevent="update" method="put">

        <div class="row">

            <div class="md:w-1/2">
                @if ($website?->name == 'Admin')
                    <x-form.input wire:model="name" label='Website' name='name' disabled></x-form.input>
                @else
                    <x-form.input wire:model="name" label='website' name='name' required></x-form.input>
                @endif
            </div>

        </div>



        <x-form.submit>Update Website</x-form.submit>

    </x-form>

</div>
