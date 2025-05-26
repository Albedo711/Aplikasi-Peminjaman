<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
   protected $table = 'peminjaman';
    protected $fillable = [
        'id_user',
        'waktu_tenggat',
        'tanggal_pinjam',
        'keterangan',
        'status'
    ];

    protected $attributes = [
        'status' => 'Ditinjau',
    ];

   public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}


    public function detailpeminjaman(){
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman');
    }


}
