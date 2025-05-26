<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
     $pengembalian = Pengembalian::with('detailPeminjaman.peminjaman.user','detailPeminjaman.barang')->get();
        
    
    return view('pengembalian', compact('pengembalian'));
}

public function terima($id){
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->status = 'Disetujui';
        $pengembalian->save();

        return redirect()->back()->with('success', 'pengembalian berhasil diterima');
    }

    public function tolak($id){
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->status = 'Ditolak';
        $pengembalian->save();

        return redirect()->back()->with('success', 'pengembalian berhasil ditolak');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
    'id_detail_peminjaman'   => 'required|exists:detail_peminjaman,id',
    'foto'                   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'tanggal_dikembalikan'   => 'required|date',
    'keterangan'             => 'nullable|string|max:255',
]);

        if($validator->fails()){
            return response()->json([
                 'error' => [
                    'message' => [
                        'bad request'
                    ]
                ]
                    ], 400);
        }

        $data = $request->except('status');
        $data['status'] = 'Ditinjau'; 

        if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('foto_barang', 'public');
        $data['foto'] = $fotoPath;
    }

        $pengembalian = Pengembalian::create($data);
        
        
        return response()->json([
            'success' => true,
            'data' => $pengembalian
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        //
    }
}
