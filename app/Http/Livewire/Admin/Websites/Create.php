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

class Create extends Base
{
    public $name = '';
    public $label = '';
    public $tagline =  '';
    public $description =  '';
    public $logo =  '';

    protected array $rules = [
        'name' => 'required|string|unique:websites,name'
    ];

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

    public function render(): view
    {
        return view('livewire.admin.websites.create');
    }
    public function store(): Redirector|RedirectResponse
    {
        $this->validate();

        //  dd($this->name, $this->label, $this->tagline, $this->description);
        $website = Website::create([
            'name'  => strtolower(str_replace(' ', '', $this->name)),
            'label' => $this->label,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'logo' => $this->logo
        ]);
        flash('Website Created')->success();
        add_user_log([
            'title'        => 'created Website ' . $this->name,
            'link'         => route('admin.websites.edit', ['website' => $website->id]),
            'reference_id' => $website->id,
            'section'      => 'Websites',
            'type'         => 'created'
        ]);

        return redirect()->route('admin.websites.index');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
