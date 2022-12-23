<?php

namespace App\Http\Livewire\Admin\Websites;

use Livewire\Component;
use App\Http\Livewire\Base;
use App\Models\Website;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;


use function add_user_log;
use function flash;
use function redirect;
use function view;


class WebsiteEdit extends Base
{
    public Website $website;
    protected function rules(): array
    {
        return [
            'name' => 'required|string|unique:websites,name,' . $this->website->id
        ];
    }


    protected array $messages = [
        'name.required' => 'Name is required'
    ];
    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {

        $this->name = $this->website->name ?? '';
        // $this->name =  $this->website->name ?? '';
    }


    public function render(): view
    {

        return view('livewire.admin.websites.website-edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();
        $this->website->name  = strtolower(str_replace(' ', '_', $this->name));
        $this->website->save();

        add_user_log([
            'title'        => 'updated website ' . $this->name,
            'link'         => route('admin.websites.edit', ['website' => $this->website->id]),
            'reference_id' => $this->website->id,
            'section'      => 'Websites',
            'type'         => 'Update'
        ]);

        flash('Website updated')->success();

        return redirect()->route('admin.websites.index');
    }
}
