<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'reservasi';
    protected $fillable = [
        'id_pelanggan',
        'id_paket',
        'tgl_reservasi_wisata',
        'harga',
        'jumlah_peserta',
        'diskon',
        'nilai_diskon',
        'total_bayar',
        'file_bukti_tf',
        'status_reservasi_wisata'
    ];

    public function paketwisata(){
        return $this->belongsTo(Paket_Wisata::class,'id_paket', 'id', 'nama_paket', 'diskon', 'harga_per_pack' );
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class,'id_pelanggan', 'id', 'nama_lengkap');
    }
}
