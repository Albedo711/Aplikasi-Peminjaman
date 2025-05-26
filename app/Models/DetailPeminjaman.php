<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
     protected $primaryKey = 'id';
      protected $table = 'detail_peminjaman';
    protected $fillable = [
        'id_peminjaman',
        'id_barang',
        'jumlah',
    ];

     
public function barang() {
    return $this->belongsTo(Barang::class, 'id_barang');
}


    public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
}


   
}
