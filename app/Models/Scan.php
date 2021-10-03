<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $table = 'scans';

    protected $fillable = ['kode','pendaftars_id','scan','jam','date','user_id','created_at'];

    public function pendaftaran() {
        // return $this->belongsTo(Pengda::class,'pengda_id','id');

        return $this->belongsToMany(Pendaftar::class,'scans','id','pendaftar_id');
    }
}
