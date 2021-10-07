<?php

namespace App\Exports;

use App\Models\Data;
use App\Models\Sk;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataPeserta implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Data::with('getPengda:id,nama')->get();
    }
    private $i = 1;
    public function map($registration) : array {
        return [
            $this->i++,
            $registration->getPengda->nama,
            Crypt::decryptString($registration->nama),
            Crypt::decryptString($registration->no_sk),
            Crypt::decryptString($registration->alamat),
        ] ;
 
 
    }

    public function headings() : array {
        return [
           '#',
           'Pengda',
           'Nama',
           'Sk',
           'Alamat'
        ] ;
    }
}
