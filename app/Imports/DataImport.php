<?php

namespace App\Imports;

use App\Models\Data;
use App\Models\Pengda;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class DataImport implements ToModel,WithHeadingRow
{
    private $pengda;
    public function __construct()
    {
        $this->pengda = Pengda::select('id','nama')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $name = preg_replace('/\s+/', '',$row['pengda']);
        $pengdas = $this->pengda->where('nama',$name)->first();
        $nick = explode(',',$row['nama']);
        return new Data([
            'pengda_id' => $pengdas->id ?? null,
            'nama' =>  Crypt::encryptString($row['nama']),
            'no_sk' => Crypt::encryptString($row['sk']),
            'alamat' =>  Crypt::encryptString($row['alamat']),
            'nick_name' => strtolower($nick[0]),
        ]);
    }
}
