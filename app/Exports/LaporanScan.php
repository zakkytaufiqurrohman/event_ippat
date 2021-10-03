<?php

namespace App\Exports;

use App\Models\Scan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanScan implements FromCollection
{
    protected $pengda;
    protected $scan;
    protected $datas = [];
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
        $datas =  $oke = DB::table('scans')->
        select("pendaftars.nama")->
        leftJoin('pendaftars','pendaftars.id','scans.pendaftars_id')->get();
        return $datas;
        
        // Scan::with('pendaftars')->get();
        // where('pengda',$this->pengda)->where('scan',$this->scan)->get();


        // return DB::table('scans')
        // ->select(DB::raw("Crypt::decryptString('pendaftars.nama'))"))
        // ->join('pendaftars','pendaftars.id','scans.pendaftars_id')->
        // where('pendaftars.pengda_id',$this->pengda)->where('scan',$this->scan)->get();
    }

    private $count = 0;

    public function map($datas): array
    {
        return [
            \Crypt::decryptString($datas['nama'])
        ];
    }
}
