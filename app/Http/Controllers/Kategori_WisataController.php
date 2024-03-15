<?php

namespace App\Http\Controllers;
use App\Models\Kategori_Wisata;
use App\Models\Obyek_Wisata;

use Illuminate\Http\Request;

class Kategori_WisataController extends Controller
{
    public function index()
    {
        //Menampilkan Semua Data Kategori_Wisata
        $katwis = Kategori_Wisata::all();
        return view('kategori_wisata.index', [ 
            'kategori_wisata' => $katwis
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah Kategori_Wisata
        return view('kategori_wisata.create');
    } 

    public function store(Request $request)
    { 
        //Menyimpan Data Kategori_Wisata
        $request->validate([
            'kategori_wisata' => 'required|unique:kategori_wisata,kategori_wisata'
        ]);
        $array = $request->only([
            'kategori_wisata'
        ]);
        $katwis = Kategori_Wisata::create($array);
        return redirect()->route('katwis.index') 
            ->with('success_message', 'Berhasil menambah kategori wisata baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit
        $katwis = Kategori_Wisata::find($id);
        if (!$katwis) return redirect()->route('katwis.index') 
        ->with('error_message', 'kategori wisata dengan id = '.$id.' tidak ditemukan');
        return view('kategori_wisata.edit', [ 
            'kategori_wisata' => $katwis
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data Kategori Wisata
        $request->validate([
            'kategori_wisata' => 'required|unique:kategori_wisata,kategori_wisata,'.$id
        ]);
        $katwis = Kategori_Wisata::find($id);
        $katwis->kategori_wisata = $request->kategori_wisata;
        $katwis->save();
        return redirect()->route('katwis.index') 
            ->with('success_message', 'Berhasil mengubah kategori wisata');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus Kategori Wisata
        $katwis = Kategori_Wisata::find($id);
        if ($katwis) $katwis->delete();
        return redirect()->route('katwis.index') 
            ->with('success_message', 'Berhasil menghapus kategori wisata');
    }
}
