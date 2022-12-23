<?php

namespace App\Http\Livewire\Admin\Websites;

use Livewire\Component;
use App\Http\Livewire\Base;
use App\Models\Website;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use function view;

class Websites extends Base
{
    use WithPagination;

    public $paginate  = '';
    public $query     = '';
    public $sortField = 'name';
    public $sortAsc   = true;

    public function render(): View
    {
        return view('livewire.admin.websites.index');
    }
    public function builder()
    {
        return Website::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    }
    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function websites(): object
    {
        $query = $this->builder();

        if ($this->query) {
            $query->where('name', 'like', '%' . $this->query . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function deleteWebsite($id): void
    {
        $this->builder()->findOrFail($id)->delete();

        $this->dispatchBrowserEvent('close-modal');
    }
}
