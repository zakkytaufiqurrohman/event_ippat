<?php

namespace App\Http\Controllers;

use App\Exports\LaporanScan;
use App\Exports\LapPendaftar;
use App\Models\Pengda;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LapPendaftarController extends Controller
{
    public function index()
    {
        if(Auth::user()->level == 10 || Auth::user()->level == 1  ){
            $pengdas = Pengda::all();
            return view('pendaftar.lap_pendaftar',compact('pengdas'));   
        }
        return view('404');
       
    }

    public function data(Request $request){

        if ($request->ajax()) {
            if(empty($request->id)) {
                $pengda = '%';
            } 
            else {
                $pengda = $request->id;
            };
            $data = Pendaftar::where('pengda_id','like',$pengda)->get();

            return Datatables::of($data)
                    ->editColumn('nama', function($row) {
                        $nama = '';
                        
                        $nama .= $row->nama;
                            
                        
                        return $nama;
                    })
                    ->editColumn('pengda', function($row) {
                        $pengda = '';
                        
                        $pengda .= $row->getPengda->nama;
                            
                        
                        return $pengda;
                    })
                    ->rawColumns(['nama','pengda'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function export($id)
    {   
        if($id == '0'){
            $pengda = '%';
        }
        else {
            $pengda = $id;
        }
        return Excel::download(new LapPendaftar($pengda), 'Pendaftar.xlsx');
    }
}
