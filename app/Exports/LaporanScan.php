<?php

namespace App\Exports;

use App\Models\Pendaftar;
use App\Models\Scan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanScan implements FromCollection,WithMapping,WithHeadings
{
    protected $pengda;
    public function __construct($pengda)
    {
        $this->pengda = $pengda;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Pendaftar::with('getPengda:id,nama')->where('pengda_id','like',$this->pengda)->get();
    }
    private $i = 1;
    public function map($registration) : array {
        return [
            $this->i++,
            $registration->getPengda->nama,
            $registration->nama,
            $registration->email,
            $registration->kode,
            $registration->wa,
            $registration->no_sk,
            $registration->ktp,
        ] ;
 
 
    }

    public function headings() : array {
        return [
           '#',
           'Pengda',
           'Nama',
           'Email',
           'Kode',
           'Wa',
           'Sk',
           'KTP'
        ] ;
    }
}
