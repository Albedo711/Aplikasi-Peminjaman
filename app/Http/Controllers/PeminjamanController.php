<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $peminjaman = Peminjaman::with('user', 'detailPeminjaman.barang')->get();
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
            'id_user'   => 'required|exists:users,id_user',
            'waktu_tenggat' => 'required|date',
            'tanggal_pinjam' => 'required|date',
            'keterangan'    => 'required|string|max:300',
 
            //detail peminjaman
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
        $request->only('id_user', 'waktu_tenggat', 'tanggal_pinjam', 'keterangan'),
        ['status' => 'ditinjau']  
        ));

        DetailPeminjaman::create([
            'id_peminjaman' => $peminjaman->id,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
           

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
