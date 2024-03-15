<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_Berita extends Model
{
    use HasFactory;
    protected $table = 'kategori_berita'; 
    protected $fillable = [ 
        'kategori_berita'
    ];
}
