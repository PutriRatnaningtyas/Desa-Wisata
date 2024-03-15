<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_Wisata extends Model
{
    use HasFactory;
    protected $table = 'kategori_wisata'; 
    protected $fillable = [ 
        'kategori_wisata'
    ];
}
