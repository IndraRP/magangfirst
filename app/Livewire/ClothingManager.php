<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clothing;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ClothingManager extends Component
{
    use WithFileUploads;

    public $clothingId, $nama,$harga, $stok;
    public $foto;
    public $existingFoto;
    public $isEditing = false;
    public $isModalOpen = false; // Properti untuk mengontrol modal

    protected $rules = [
        'nama' => 'required|string|max:255',
        'foto' => 'nullable|sometimes|image|max:1024',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
    ];

    public function render()
    {
        $clothings = Clothing::paginate(5);
        return view('livewire.clothing-manager', compact('clothings'))
            ->extends('admin.home') // Menggunakan layout navbar_admin
            ->section('body'); // Menempatkan konten di section 'content'
    }

   public function storeClothing()
{
    $this->validate(); // Validasi data form

    // Upload foto jika ada
    $fotoPath = null;
    if ($this->foto) {
        $fotoPath = $this->foto->store('upload', 'public'); // Simpan di storage/app/public/upload
    }

    // Simpan ke database
    Clothing::create([
        'nama' => $this->nama,
        'foto' => $fotoPath, // Simpan path ke database
        'harga' => $this->harga,
        'stok' => $this->stok,
    ]);

    session()->flash('message', 'Clothing created successfully!');
    $this->resetFields();
    $this->dispatch('closeModal');
}


    public function resetFields()
    {
        $this->nama = '';
        $this->foto = '';
        $this->harga = '';
        $this->stok = '';
        $this->isEditing = false;
    }

    public function setClothing($id)
{
    $clothing = Clothing::find($id);
    if ($clothing) {
        $this->clothingId = $clothing->id;
        $this->nama = $clothing->nama;
        $this->foto = null; // Reset foto (gunakan baru jika diupload)
        $this->existingFoto = $clothing->foto; // Simpan path foto lama
        $this->harga = $clothing->harga;
        $this->stok = $clothing->stok;
    }
}

public function updateClothingTest()
{
    $this->validate(); // Validasi form

    $clothing = Clothing::find($this->clothingId);

    // Upload foto baru jika ada
    $fotoPath = $this->existingFoto; // Gunakan foto lama jika tidak ada yang baru
    if ($this->foto) {
        $fotoPath = $this->foto->store('upload', 'public');
    }

    // Update data di database
    $clothing->update([
        'nama' => $this->nama,
        'foto' => $fotoPath,
        'harga' => $this->harga,
        'stok' => $this->stok,
    ]);

    session()->flash('message', 'Pakaian berhasil diperbarui!');
    $this->resetFields();
    $this->dispatch('closeModal');
}


    public function deleteClothing($id)
    {
        $clothing = Clothing::find($id);
        $clothing->delete();
        session()->flash('message', 'Clothing deleted successfully!');
    }
}