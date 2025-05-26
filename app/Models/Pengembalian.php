<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'id_detail_peminjaman',
        'foto',
        'tanggal_dikembalikan',
        'keterangan',
        'status'
    ];
     protected $attributes = [
        'status' => 'Ditinjau',
    ];

    public function detailPeminjaman()
{
    return $this->belongsTo(DetailPeminjaman::class, 'id_detail_peminjaman');
}
}
