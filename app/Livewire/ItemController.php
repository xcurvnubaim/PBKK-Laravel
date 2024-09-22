<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemController extends Component
{
    public $items, $itemId, $name, $stock, $price;
    public bool $isOpen = false;

    public function render()
    {
        $this->items = Item::all();
        return view('livewire.items.items');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->stock = '';
        $this->price = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        Item::updateOrCreate(['id' => $this->itemId], [
            'name' => $this->name,
            'stock' => $this->stock,
            'price' => $this->price
        ]);

        session()->flash('message', $this->itemId ? 'Item Updated Successfully.' : 'Item Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->itemId = $id;
        $this->name = $item->name;
        $this->stock = $item->stock;
        $this->price = $item->price;

        $this->openModal();
    }

    public function delete($id)
    {
        Item::find($id)->delete();
        session()->flash('message', 'Item Deleted Successfully.');
    }
}
