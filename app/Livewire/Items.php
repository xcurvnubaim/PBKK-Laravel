<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class Items extends Component
{
    public $items, $itemId, $item_name, $stock, $price;
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
        $this->item_name = '';
        $this->stock = '';
        $this->price = '';
    }
    
    public function store()
    {
        $this->validate([
            'item_name' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        Item::updateOrCreate(['id' => $this->itemId], [
            'item_name' => $this->item_name,
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
        $this->item_name = $item->item_name;
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
