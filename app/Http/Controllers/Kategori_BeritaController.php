<?php

namespace App\Http\Controllers;
use App\Models\Kategori_Berita;
use App\Models\Berita;

use Illuminate\Http\Request;

class Kategori_BeritaController extends Controller
{
    public function index()
    {
        //Menampilkan Semua Data Kategori_Berita
        $katber = Kategori_Berita::all();
        return view('kategori_berita.index', [ 
            'kategori_berita' => $katber
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah Kategori_Berita
        return view('kategori_berita.create');
    } 

    public function store(Request $request)
    { 
        //Menyimpan Data Kategori_Berita
        $request->validate([
            'kategori_berita' => 'required|unique:kategori_berita,kategori_berita'
        ]);
        $array = $request->only([
            'kategori_berita'
        ]);
        $katber = Kategori_Berita::create($array);
        return redirect()->route('katber.index') 
            ->with('success_message', 'Berhasil menambah kategori berita baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit
        $katber = Kategori_Berita::find($id);
        if (!$katber) return redirect()->route('katber.index') 
        ->with('error_message', 'kategori berita dengan id = '.$id.' tidak ditemukan');
        return view('kategori_berita.edit', [ 
            'kategori_berita' => $katber
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data Kategori Berita
        $request->validate([
            'kategori_berita' => 'required|unique:kategori_berita,kategori_berita,'.$id
        ]);
        $katber = Kategori_Berita::find($id);
        $katber->kategori_berita = $request->kategori_berita;
        $katber->save();
        return redirect()->route('katber.index') 
            ->with('success_message', 'Berhasil mengubah kategori berita');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus Kategori Berita
        $katber = Kategori_Berita::find($id);
        if ($katber) $katber->delete();
        return redirect()->route('katber.index') 
            ->with('success_message', 'Berhasil menghapus kategori berita');
    }
}
