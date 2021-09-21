<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengda extends Model
{
    protected $table = 'pengdas';
    public $timestamps = false;

    protected $fillable = ['nama'];
}
