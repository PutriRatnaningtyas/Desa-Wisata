<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Reservasi;

class PelangganController extends Controller
{
    public function index()
    {
        //Menampilkan Data Pelanggan
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', [ 
            'pelanggan' => $pelanggan
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah pelanggan
        return view( 
            'pelanggan.create', [ 
            'users' => User::all() //Mengirimkan semua data user ke Modal pada halaman create
        ]);
    }

    public function store(Request $request)
    { 
        //Menyimpan Data pelanggan
        $request->validate([
            'nama_lengkap' => 'required', 
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto'=> 'required',
            'id_user' => 'required'
        ]);
        $array = $request->only([
            'nama_lengkap', 
            'no_hp',
            'alamat',
            'foto',
            'id_user'
        ]);
        $array['foto']=$request->file('foto')->store('Foto pelanggan');
            $tambah=Pelanggan::create($array);
            if($tambah) $request->file('foto')->store('Foto pelanggan');
            return redirect()->route('pelanggan.index') ->with('success_message', 'Berhasil menambah Pelanggan baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) return redirect()->route('pelanggan.index') 
        ->with('error_message', 'user dengan id = '.$id.' tidak ditemukan');
        return view('pelanggan.edit', [ 
            'pelanggan' => $pelanggan,
            'users' => User::all() 
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data Pelanggan
        $request->validate([
            'nama_lengkap' => 'required', 
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto'=> 'required',
            'id_user' => 'required'
        ]);
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_lengkap = $request->nama_lengkap;
        $pelanggan->no_hp = $request->no_hp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->foto = $request->file('foto')->store('Foto Pelanggan');
        $pelanggan->id_user = $request->id_user;
        $pelanggan->save();
        return redirect()->route('pelanggan.index') 
            ->with('success_message', 'Berhasil mengubah pelanggan');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus  pelanggan
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) $pelanggan->delete();
        return redirect()->route('pelanggan.index') 
            ->with('success_message', 'Berhasil menghapus pelanggan');
    }
}
