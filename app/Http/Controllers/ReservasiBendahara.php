<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\Paket_Wisata;
use app\Models\User;

class ReservasiBendahara extends Controller
{
    public function index(){
        $reservasi = Reservasi::all();
        return view('reservasibendahara.index', [
            'reservasi' => $reservasi
        ]);
    }

    public function edit($id)
    {
        //Menampilkan Form Edit
        $reservasi = reservasi::find($id);
        if (!$reservasi) return redirect()->route('reservasibendahara.index')
            ->with('error_message', 'Data reservasi dengan id = ' . $id . ' tidak ditemukan');
        return view('reservasibendahara.edit', [
            'reservasi' => $reservasi,
            'users' => User::all(),
            'paketwisata' => Paket_Wisata::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::find($id);
        $reservasi->status_reservasi_wisata = $request->status_reservasi_wisata;
        $reservasi->save();
        return redirect()->route('reservasibendahara.index')->with('success_message', 'Pembayaran Telah di Validasi');
    }
}
