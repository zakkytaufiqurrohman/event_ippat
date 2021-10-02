<?php

namespace App\Exports;

use App\Models\Scan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanScan implements FromCollection
{
    protected $pengda;
    protected $scan;
    public function __construct($pengda,$scan)
    {
        $this->pengda = $pengda;
        $this->scan = $scan;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Scan::with(["pendaftar" => function($q){
            $q->where('pendaftars.pengda_id', '=', 1);
        }])->get();
        
        // Scan::with('pendaftars')->get();
        // where('pengda',$this->pengda)->where('scan',$this->scan)->get();


        // return DB::table('scans')
        // ->select(DB::raw("Crypt::decryptString('pendaftars.nama'))"))
        // ->join('pendaftars','pendaftars.id','scans.pendaftars_id')->
        // where('pendaftars.pengda_id',$this->pengda)->where('scan',$this->scan)->get();
    }
}
