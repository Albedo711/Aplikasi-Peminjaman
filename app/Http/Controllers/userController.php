<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = User::all();
        return view('user', compact('user')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Post.user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,user',
            'kelas' => 'required_if:role,user|string|in:X,XI,XII', 
            'jurusan' => 'required_if:role,user|string|in:RPL,PSPT,ANIMASI,TJKT,TE', 
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

       
        if ($request->role == 'user') {
            $user->kelas = $request->kelas;
            $user->jurusan = $request->jurusan;
        }

        $user->save();

        return back()->with('success', 'Register successfully');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    
    $user = User::findOrFail($id);

 
    return view('Post.useredit', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|string|in:admin,user',
        'kelas' => 'required_if:role,user|string|in:X,XI,XII',
        'jurusan' => 'required_if:role,user|string|in:RPL,PSPT,ANIMASI,TJKT,TE',
        'password' => 'nullable|string',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->role = $request->role;

    if ($request->role == 'user') {
        $user->kelas = $request->kelas;
        $user->jurusan = $request->jurusan;
    } else {
        $user->kelas = null;
        $user->jurusan = null;
    }
    
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
  
    $user->save();

    return redirect()->route('user')->with('success', 'User berhasil diupdate');
}



    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user')->with('success', 'User berhasil dihapus.');
    }
}
