<?php

namespace App\Http\Controllers;

use App\Exports\LaporanScan;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use App\Models\Pengda;
use App\Models\Data;
use App\Models\Laporan;
use App\Models\Scan;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function daftarUlang()
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3 ){
            $pengdas = Pengda::all();
            return view('laporan.daftar_ulang',compact('pengdas'));
        }
        return view('404');        
       
    }

    public function suratSuara()
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 4 ){
            $pengdas = Pengda::all();
            return view('laporan.surat_suara',compact('pengdas'));
        }
        return view('404');        
       
    }

    public function kotakSuara()
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 2 ||  Auth::user()->level == 5 ){
            $pengdas = Pengda::all();
            return view('laporan.kotak_suara',compact('pengdas'));
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
            $data = DB::table('scans')->leftJoin("pendaftars",'pendaftars.id','scans.pendaftars_id')
            ->select('pengdas.nama as pengda','scans.*','pendaftars.*')
            ->leftJoin('pengdas','pendaftars.pengda_id','pengdas.id')
            ->where('pendaftars.pengda_id','like',$pengda)->where('scans.scan',$request->scan)->get();
            return Datatables::of($data)
                    ->editColumn('action', function ($row) {
                        $action = '';
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$row->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";


                        return $action;
                    })
                    ->editColumn('pengda', function($row) {
                        $pengda = '';
                        
                        $pengda .= $row->pengda;
                            
                        
                        return $pengda;
                    })
                    ->editColumn('name', function($row) {
                        $name = '';
                        
                        $name .=  Crypt::decryptString($row->nama);
                            
                        
                        return $name;
                    })
                    ->editColumn('sk', function($row) {
                        $sk = '';
                        
                        $sk .= Crypt::decryptString($row->no_sk);
                            
                        
                        return $sk;
                    })
                    ->rawColumns(['action','pengda','name','sk'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        //
        $data = Scan::find($request->id);
        $data->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus']);
    }

    public function export(Request $request)
    {
        //
        return Excel::download(new LaporanScan(1,1), 'siswa.xlsx');
    }
}
