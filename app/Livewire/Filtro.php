<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Filtro extends Component
{
    use WithPagination;
    public $subcategoria_id;
    public $categoria_id;
    public $familia_id;

    public $search;

    #[On('search')]
    public function search($search)
    {
        $this->search = $search;
    }

    public function render()
    {
        $productos = Producto::when($this->familia_id, function ($query) {
            $query->whereHas('subcategoria.categoria', function ($query) {
                $query->where('familia_id', $this->familia_id);
            });
        })
            ->when($this->categoria_id, function ($query) {
                $query->whereHas('subcategoria', function ($query) {
                    $query->where('categoria_id', $this->categoria_id);
                });
            })
            ->when($this->subcategoria_id, function ($query) {
                $query->where('subcategoria_id', $this->subcategoria_id);
            })
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);



        return view('livewire.filtro', compact('productos'));
    }
}
