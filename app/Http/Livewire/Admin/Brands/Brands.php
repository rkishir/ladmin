<?php

namespace App\Http\Livewire\Admin\Brands;

use Livewire\Component;
use App\Http\Livewire\Base;
use App\Models\Brand;
use Illuminate\Support\Facades\View;
use Livewire\WithPagination;
use function view;

class Brands extends Component
{
    use WithPagination;

    public $paginate  = '';
    public $query     = '';
    public $sortField = 'name';
    public $sortAsc   = true;

    public function render()
    {
        return view('livewire.admin.brands.brands');
    }
    public function builder()
    {
        return Brand::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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
    public function brands(): object
    {
        $query = $this->builder();

        if ($this->query) {
            $query->where('name', 'like', '%' . $this->query . '%');
        }

        return $query->paginate($this->paginate);
    }
    public function deleteBrand($id): void
    {
        $this->builder()->findOrFail($id)->delete();

        $this->dispatchBrowserEvent('close-modal');
    }
}
