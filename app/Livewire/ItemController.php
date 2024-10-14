<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use App\Models\category;
use Livewire\WithPagination;

class ItemController extends Component
{
    use WithPagination;
    public $itemId, $name, $stock, $price, $category, $categoryId;
    public bool $isOpen = false;

    public function render()
    {
        // Fetch paginated items directly in the render method
        $items = Item::with('category')->paginate(10);
        $categories = Category::all();
        return view('livewire.items.items', ['items' => $items, 'categories' => $categories]);
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
        $this->category = '';
    }
    
    public function store()
    {
        // Validasi input
        $this->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'category' => 'required|string' // Validasi kategori sebagai string
        ]);

        // Coba cari kategori yang sudah ada berdasarkan nama (case-insensitive)
        $existingCategory = Category::where('category_name', strtolower($this->category))->first();
        $categoryId = $existingCategory ? $existingCategory->id : null;
        // if ($existingCategory) {
        //     // Jika kategori ditemukan, ambil ID-nya
        //     $categoryId = $existingCategory->id;
        // } else {
        //     // Jika tidak ditemukan, hapus kategori yang ada sebelumnya (jika ada)
        //     if (isset($this->categoryId)) {
        //         $oldCategory = Category::find($this->categoryId);
        //         if ($oldCategory) {
        //             $oldCategory->delete(); // Hapus kategori lama
        //         }
        //     }
        //     // Buat kategori baru
        //     $newCategory = Category::create(['category_name' => $this->category]);
        //     $categoryId = $newCategory->id; // Ambil ID kategori baru
        // }   

        // Buat atau perbarui item dengan menyertakan category_id
        Item::updateOrCreate(
            ['id' => $this->itemId], // Untuk update jika ada ID, atau create jika tidak ada
            [
                'name' => $this->name,
                'stock' => $this->stock,
                'price' => $this->price,
                'category_id' => $categoryId // Masukkan ID kategori yang sudah ada atau baru dibuat
            ]
        );

        // Set pesan flash dan tutup modal
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
