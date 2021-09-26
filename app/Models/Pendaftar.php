<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Pendaftar extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kode',
        'pengda_id',
        'wa',
        'email',
        'nama' ,
        'nick_name' ,
        'ktp',
        'no_sk',
        'img_sk',
        'img_foto' ,
        'img_bukti',
        'daftar_ulang',
        'surat_suara',
        'kotak_suara',
    ];

    public function getPengda() {
        return $this->belongsTo(Pengda::class,'pengda_id','id');
    }

    public function getNamaAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getWaAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getEmailAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getKtpAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getNoSkAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
