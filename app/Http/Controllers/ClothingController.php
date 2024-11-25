<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Http\Request;

class ClothingController extends Controller
{
    // Menampilkan semua pakaian
    public function index()
    {
        $clothings = Clothing::paginate(10); // 10 adalah jumlah item per halaman
        return view('admin.home', compact('clothings'));
    }

    
    // Menampilkan form untuk menambah pakaian
    public function create()
    {
        return view('clothing.create');
    }

    // Menyimpan pakaian baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|url',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        Clothing::create([
            'nama' => $request->nama,
            'foto' => $request->foto,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('clothing.index')->with('success', 'Clothing item added successfully!');
    }

    // Menampilkan form untuk mengedit pakaian
    public function edit($id)
    {
        $clothing = Clothing::findOrFail($id);
        return view('clothing.edit', compact('clothing'));
    }

    // Memperbarui data pakaian
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|url',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $clothing = Clothing::findOrFail($id);
        $clothing->update([
            'nama' => $request->nama,
            'foto' => $request->foto,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('clothing.index')->with('success', 'Clothing item updated successfully!');
    }

    // Menghapus pakaian
    public function destroy($id)
    {
        $clothing = Clothing::findOrFail($id);
        $clothing->delete();

        return redirect()->route('clothing.index')->with('success', 'Clothing item deleted successfully!');
    }
}
