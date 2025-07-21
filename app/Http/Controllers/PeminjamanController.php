<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function suki()
{
    $userId = auth()->id();

    $peminjaman = Peminjaman::with('detailPeminjaman.barang')
        ->whereHas('detailPeminjaman', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })
        ->get();

    if ($peminjaman->isEmpty()) {
        return response()->json([
            'status' => 'empty',
            'message' => 'Belum ada peminjaman',
            'data' => []
        ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Data peminjaman berhasil diambil',
        'data' => $peminjaman
    ]);
}


public function detail()
    {
        // Mengambil semua detail peminjaman dengan relasi barang dan pengembalian
        $detailPeminjaman = DetailPeminjaman::with(['barang', 'pengembalian'])->get();

        // Bisa juga kamu filter sesuai kebutuhan, misalnya hanya yang belum dikembalikan:
        $detailPeminjaman = DetailPeminjaman::with(['barang', 'pengembalian'])
           ->whereDoesntHave('pengembalian')
           ->get();

        return response()->json([
            'success' => true,
            'data' => $detailPeminjaman
        ]);
    }



    public function index()
    {
       
        $peminjaman = Peminjaman::with('detailPeminjaman.user', 'detailPeminjaman.barang')->get();
        return view('peminjaman', compact('peminjaman'));
    }

    public function terima($id){
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Diterima';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman berhasil diterima');
    }

    public function tolak($id){
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Ditolak';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak');
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
        $validator = Validator::make($request->all(),[
            //peminjaman
            
            'waktu_tenggat' => 'required|date',
            'tanggal_pinjam' => 'required|date',
            'keterangan'    => 'required|string|max:300',
 
            //detail peminjaman
            'id_user'   => 'required|exists:users,id_user',
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => [
                    'message' => [
                        'details' => $validator->errors()
                    ]
                ]
            ], 400);
        }
        $peminjaman = Peminjaman::create(array_merge(
        $request->only('waktu_tenggat', 'tanggal_pinjam', 'keterangan'),
        ['status' => 'ditinjau']  
        ));

        DetailPeminjaman::create([
            'id_peminjaman' => $peminjaman->id,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'id_user' => $request->id_user
           

        ]);

      
        return response()->json([
            'success' => true,
            'data' => $peminjaman->load('detailPeminjaman') 
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
