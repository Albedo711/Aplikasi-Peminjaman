<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $category = Category::all();
        $jumlahcategory = count($category);
        $kembali = Pengembalian::all();
        $jumlahkembali = count($kembali);
        $peminjaman = Peminjaman::all();
        $jumlahpinjam = count($peminjaman);
         $barang = Barang::all();
        $jumlahBarang = count($barang);
        return view('dashboard', compact('user','jumlahBarang','jumlahpinjam','jumlahkembali','jumlahcategory'));
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact('user'));
    }

   
    
}

