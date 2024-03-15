<?php

namespace App\Http\Controllers;
use App\Models\Paket_Wisata;
use App\Models\Reservasi;

use Illuminate\Http\Request;

class Paket_WisataController extends Controller
{
    public function index(){
        //Menampilkan Data Paket_Wisata
        return view('paket_wisata.index', ['paket_wisata' => Paket_Wisata::all()]);
        } 
        public function create(){
            //Menampilkan Form Tambah Paket_Wisata
            return view('paket_wisata.create');
            }
            public function store(Request $request){
            //Menyimpan Data Paket_Wisata
            $request->validate([
            'nama_paket' => 'required|unique:paket_wisata,nama_paket',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'harga_per_pack' => 'required',
            'diskon' => 'required',
            'foto1' => 'required|image|file|max:2048',
            'foto2' => 'required|image|file|max:2048',
            'foto3' => 'required|image|file|max:2048',
            'foto4' => 'required|image|file|max:2048',
            'foto5' => 'required|image|file|max:2048'
            ]);
            $array = $request->only([
            'nama_paket',
            'deskripsi',
            'fasilitas',
            'harga_per_pack',
            'diskon'
            ]);
            $array['foto1'] = $request->file('foto1')->store('Foto Paket Wisata');
            $array['foto2'] = $request->file('foto2')->store('Foto Paket Wisata');
            $array['foto3'] = $request->file('foto3')->store('Foto Paket Wisata');
            $array['foto4'] = $request->file('foto4')->store('Foto Paket Wisata');
            $array['foto5'] = $request->file('foto5')->store('Foto Paket Wisata');
            $tambah= Paket_Wisata::create($array);
            if($tambah) $request->file('foto1')->store('Foto Paket Wisata');
            return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto2')->store('Foto Paket Wisata');
            return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto3')->store('Foto Paket Wisata');
            return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto4')->store('Foto Paket Wisata');
            return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto5')->store('Foto Paket Wisata');
            return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            }
            
            public function destroy(Request $request, $id)
        {
            //Menghapus Paket Wisata
            $paket_wisata = Paket_Wisata::find($id);
            if ($paket_wisata){
            $hapus=$paket_wisata->delete();
            if($hapus) unlink("storage/" . $paket_wisata->foto1);
            if($hapus) unlink("storage/" . $paket_wisata->foto2);
            if($hapus) unlink("storage/" . $paket_wisata->foto3);
            if($hapus) unlink("storage/" . $paket_wisata->foto4);
            if($hapus) unlink("storage/" . $paket_wisata->foto5);
            }
            return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil menghapus Paket Wisata ');
        }
        public function edit($id)
        {
        //Menampilkan Form Edit
        $paket_wisata = Paket_Wisata::find($id);
        if (!$paket_wisata) return redirect()->route('paket_wisata.index')->with('error_message', 'paket_wisata dengan id' . $id . ' tidak ditemukan');
        return view('paket_wisata.edit', [
            'paket_wisata' => $paket_wisata
        ]);
    }
    public function update(Request $request, $id)
        {
        //Mengedit Data Paket Wisata
        $request->validate([
        'nama_paket' =>'required|unique:paket_wisata,nama_paket,'.$id,
        'deskripsi' => 'required',
        'fasilitas' => 'required',
        'harga_per_pack' => 'required',
        'diskon' => 'required'
        ]);
        $paket_wisata = Paket_Wisata::find($id);
        $paket_wisata->nama_paket = $request->nama_paket;
        $paket_wisata->deskripsi = $request->deskripsi;
        $paket_wisata->fasilitas = $request->fasilitas;
        $paket_wisata->harga_per_pack = $request->harga_per_pack;
        $paket_wisata->diskon = $request->diskon;
        $paket_wisata->foto1 = $request->file('foto1')->store('Foto Paket Wisata');
        $paket_wisata->foto2 = $request->file('foto2')->store('Foto Paket Wisata');
        $paket_wisata->foto3 = $request->file('foto3')->store('Foto Paket Wisata');
        $paket_wisata->foto4 = $request->file('foto4')->store('Foto Paket Wisata');
        $paket_wisata->foto5 = $request->file('foto5')->store('Foto Paket Wisata');
        $paket_wisata->save();
        return redirect()->route('paket_wisata.index')->with('success_message', 'Berhasil mengubah Paket Wisata');
        }

}