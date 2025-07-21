<?php

namespace App\Http\Controllers;

use App\Models\DetailPeminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */


 public function suki()
{
    $userId = auth()->id();

    $pengembalian = Pengembalian::with([
        'detailPeminjaman.user',
        'detailPeminjaman.barang'
    ])
    ->whereHas('detailPeminjaman.peminjaman', function ($query) use ($userId) {
        $query->where('id_user', $userId);
    })
    ->get();

    if ($pengembalian->isEmpty()) {
        return response()->json([
            'status' => 'empty',
            'message' => 'Belum ada pengembalian',
            'data' => []
        ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Data peminjaman berhasil diambil',
        'data' => $pengembalian
    ]);
}

public function barangBelumDikembalikan()
{
    $userId = auth()->id();

    $data = DetailPeminjaman::with(['barang', 'peminjaman'])
        ->whereHas('peminjaman', function ($query) use ($userId) {
            $query->where('id_user', $userId)
                  ->where('status', 'Diterima'); 
        })
        ->whereDoesntHave('pengembalian') 
        ->get();

    if ($data->isEmpty()) {
        return response()->json([
            'status' => 'empty',
            'message' => 'Tidak ada barang yang sedang dipinjam',
            'data' => []
        ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Daftar barang yang belum dikembalikan',
        'data' => $data
    ]);
}

   public function index()
{
     $pengembalian = Pengembalian::with('detailPeminjaman.user','detailPeminjaman.barang')->get();
        
    
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
    'foto'                   => 'required|image|mimes:jpeg,png,jpg,gif',
    'tanggal_dikembalikan'   => 'required|date',
    'keterangan'             => 'nullable|string|max:255',
]);

        if ($validator->fails()) {
    return response()->json([
        'error' => $validator->errors()
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
