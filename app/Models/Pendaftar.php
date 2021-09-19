<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kode',
        'pengda',
        'wa',
        'email',
        'nama' ,
        'ktp',
        'no_sk',
        'img_sk',
        'img_foto' ,
        'img_bukti',
        'daftar_ulang',
        'surat_suara',
        'kotak_suara',
    ];
}
