<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;

class PenginapanController extends Controller
{
    public function index()
    {
        //Menampilkan Data Penginapan
        $penginapan = Penginapan::all();
        return view('penginapan.index', [ 
            'penginapan' => $penginapan
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah Penginapan
        return view( 
            'penginapan.create', [
        ]);
    }

    public function store(Request $request)
    { 
        //Menyimpan Data Penginapan
        $request->validate([
            'nama_penginapan' => 'required', 
            'deskripsi' => 'required',
            'fasilitas'=> 'required',
            'foto1' => 'required',
            'foto2' => 'required',
            'foto3' => 'required',
            'foto4' => 'required',
            'foto5' => 'required'
        ]);
        $array = $request->only([
            'nama_penginapan', 'deskripsi', 'fasilitas', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'
        ]);

        $array['foto1'] = $request->file('foto1')->store('Foto Penginapan');
        $array['foto2'] = $request->file('foto2')->store('Foto Penginapan');
        $array['foto3'] = $request->file('foto3')->store('Foto Penginapan');
        $array['foto4'] = $request->file('foto4')->store('Foto Penginapan');
        $array['foto5'] = $request->file('foto5')->store('Foto Penginapan');
        $tambah = Penginapan::create($array);
        if($tambah) $request->file('foto1')->store('Foto Penginapan');
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah penginapan baru');
        if($tambah) $request->file('foto2')->store('Foto Penginapan');
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah penginapan baru');
        if($tambah) $request->file('foto3')->store('Foto Penginapan');
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah penginapan baru');
        if($tambah) $request->file('foto4')->store('Foto Penginapan');
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah penginapan baru');
        if($tambah) $request->file('foto5')->store('Foto Penginapan');
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah penginapan baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit Penginapan
        $penginapan = Penginapan::find($id);
        if (!$penginapan) return redirect()->route('penginapan.index') 
        ->with('error_message', 'penginapan dengan id = '.$id.' tidak ditemukan');
        return view('penginapan.edit', [ 
            'penginapan' => $penginapan,
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data Penginapan
        $request->validate([
            'nama_penginapan' => 'required', 
            'deskripsi' => 'required',
            'fasilitas'=> 'required',
            'foto1' => 'required',
            'foto2' => 'required',
            'foto3' => 'required',
            'foto4' => 'required',
            'foto5' => 'required'
        ]);
        $penginapan = Penginapan::find($id);
        $penginapan->nama_penginapan = $request->nama_penginapan;
        $penginapan->deskripsi = $request->deskripsi;
        $penginapan->fasilitas = $request->fasilitas;
        $penginapan->foto1 = $request->file('foto1')->store('Foto Penginapan');
        $penginapan->foto2 = $request->file('foto2')->store('Foto Penginapan');
        $penginapan->foto3 = $request->file('foto3')->store('Foto Penginapan');
        $penginapan->foto4 = $request->file('foto4')->store('Foto Penginapan');
        $penginapan->foto5 = $request->file('foto5')->store('Foto Penginapan');
        $penginapan->save();
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil mengubah Penginapan');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus Penginapan
        $penginapan = Penginapan::find($id);
        if ($penginapan){
            $hapus=$penginapan->delete();
        if($hapus) unlink("storage/" . $penginapan->foto1);
        if($hapus) unlink("storage/" . $penginapan->foto2);
        if($hapus) unlink("storage/" . $penginapan->foto3);
        if($hapus) unlink("storage/" . $penginapan->foto4);
        if($hapus) unlink("storage/" . $penginapan->foto5);
        }
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menghapus Penginapan');
    }
}