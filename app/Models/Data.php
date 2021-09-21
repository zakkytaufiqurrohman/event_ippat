<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'sk';

    protected $fillable = ['pengda_id','nama','no_sk','alamat','nick_name'];
    public $timestamps = false;

    public function getPengda() {
        return $this->belongsTo(Pengda::class,'pengda_id','id');
    }
}
