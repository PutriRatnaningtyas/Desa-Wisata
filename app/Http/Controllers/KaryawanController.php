<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\User;

class KaryawanController extends Controller
{
    public function index()
    {
        //Menampilkan Data Karyawan
        $karyawan = Karyawan::all();
        return view('karyawan.index', [ 
            'karyawan' => $karyawan
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah Karyawan
        return view( 
            'karyawan.create', [ 
            'users' => User::all() //Mengirimkan semua data User ke Modal pada halaman create
        ]);
    }

    public function store(Request $request)
    { 
        //Menyimpan Data Karyawan
        $request->validate([
            'nama_karyawan' => 'required', 
            'alamat' => 'required',
            'no_hp' => 'required',
            'jabatan'=> 'required',
            'id_user' => 'required'
        ]);
        $array = $request->only([
            'nama_karyawan',
            'alamat',
            'no_hp',
            'jabatan',
            'id_user'
        ]);
        karyawan::create($array);
        return redirect()->route('karyawan.index') 
            ->with('success_message', 'Berhasil menambah karyawan baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit
        $karyawan = Karyawan::find($id);
        if (!$karyawan) return redirect()->route('karyawan.index') 
        ->with('error_message', 'user dengan id = '.$id.' tidak ditemukan');
        return view('karyawan.edit', [ 
            'karyawan' => $karyawan,
            'users' => User::all() 
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data karyawan
        $request->validate([
            'nama_karyawan' => 'required', 
            'alamat' => 'required',
            'no_hp' => 'required',
            'jabatan'=> 'required',
            'id_user' => 'required'
        ]);
        $karyawan = Karyawan::find($id);
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->id_user = $request->id_user;
        $karyawan->save();
        return redirect()->route('karyawan.index') 
            ->with('success_message', 'Berhasil mengubah karyawan');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus  karyawan
        $karyawan = Karyawan::find($id);
        if ($karyawan) $karyawan->delete();
        return redirect()->route('karyawan.index') 
            ->with('success_message', 'Berhasil menghapus karyawan');
    }
}
