<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori_Berita;

class BeritaController extends Controller
{
    public function index()
    {
        //Menampilkan Data Berita
        $berita = Berita::all();
        return view('berita.index', [ 
            'berita' => $berita
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah Berita
        return view( 
            'berita.create', [ 
            'katber' => Kategori_Berita::all() //Mengirimkan semua data Kategori Berita ke Modal pada halaman create
        ]);
    }

    public function store(Request $request)
    { 
        //Menyimpan Data Berita
        $request->validate([
            'judul' => 'required', 
            'berita' => 'required',
            'tgl_post' => 'required',
            'id_kategori_berita'=> 'required',
            'foto' => 'required'
        ]);
        $array = $request->only([
            'judul', 'berita', 'tgl_post', 'id_kategori_berita', 'foto'
        ]);
        berita::create($array);
        return redirect()->route('berita.index') 
            ->with('success_message', 'Berhasil menambah berita baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit
        $berita = Berita::find($id);
        if (!$berita) return redirect()->route('berita.index') 
        ->with('error_message', 'kategori berita dengan id = '.$id.' tidak ditemukan');
        return view('berita.edit', [ 
            'berita' => $berita,
            'katber' => Kategori_Berita::all() 
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data Berita
        $request->validate([
            'judul' => 'required',
            'berita' => 'required',
            'tgl_post' => 'required',
            'id_kategori_berita'=> 'required',
            'foto' => 'required'
        ]);
        $berita = Berita::find($id);
        $berita->judul = $request->judul;
        $berita->berita = $request->berita;
        $berita->tgl_post = $request->tgl_post;
        $berita->id_kategori_berita = $request->id_kategori_berita;
        $berita->foto = $request->file('foto')->store('Foto Berita');
        $berita->save();
        return redirect()->route('berita.index') 
            ->with('success_message', 'Berhasil mengubah berita');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus  Berita
        $berita = Berita::find($id);
        if ($berita) $berita->delete();
        return redirect()->route('berita.index') 
            ->with('success_message', 'Berhasil menghapus berita');
    }
}
