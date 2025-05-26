<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    
    public function index()
    {
        $barang = Barang::all(); 
        $categories = Category::all(); 
        return view('Barang', compact('barang', 'categories'));
    }

 
    public function create()
    {
        $categories = Category::all(); 
        return view('post.add', compact('categories')); 
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:categories,id',
            'nama_barang' => 'required|max:300',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'brand' => 'required|max:300',
            'status' => 'required|in:Tersedia,Dipinjam',
        ]);
  
    
        $fileName = null;
        if ($request->hasFile('foto_barang')) {
    $fileName = $request->file('foto_barang')->store('barang', 'public');
}

        
        Barang::create([
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $fileName,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'brand' => $request->brand,
            'status' => $request->status,
        ]);

        return redirect()->route('index')->with('success', 'Barang berhasil ditambahkan.');
    }

    
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
         $categories = Category::all(); 
        return view('post.edit', compact('barang', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:300',
            'stok' => 'required|integer',
            'brand' => 'nullable|max:300',
            'status' => 'required|in:Tersedia,Dipinjam',
        ]);

        $barang = Barang::findOrFail($id);


        if ($request->hasFile('foto_barang')) {
            $fileName = time() . '.' . $request->foto_barang->extension();
            $request->foto_barang->move(public_path('images'), $fileName);
            $barang->foto_barang = $fileName;
        }

        $barang->update($request->all());

        return redirect()->route('index')->with('success', 'Barang berhasil diupdate.');
    }

 
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('index')->with('success', 'Barang berhasil dihapus.');
    }
}
