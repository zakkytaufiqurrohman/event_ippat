<?php

namespace App\Http\Controllers;

use App\Exports\LaporanScan;
use Illuminate\Http\Request;
use DB;
use PDFS;

use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use App\Models\Pengda;
use App\Models\Data;
use App\Models\Laporan;
use App\Models\Scan;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function daftarUlang()
    {
        // $oke = Scan::with(["pendaftaran" => function($q){
        //     $q->where('pendaftars.pengda_id',2);
        //     // $q->select('nick_name');
        // }])->where('scan',3)->first();
        // $oke = Scan::with('pendaftaran')->first();
        // $oke = DB::table('scans')->
        // select('pendaftars.nama')->
        // leftJoin('pendaftars','pendaftars.id','scans.pendaftars_id')->first();
        // echo Crypt::decryptString($oke->nama);
        // die;
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
            ->select('pengdas.nama as pengda','scans.*','pendaftars.nama','pendaftars.pengda_id','pendaftars.no_sk as no')
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
                        
                        $sk .= Crypt::decryptString($row->no);
                            
                        
                        return $sk;
                    })
                    ->rawColumns(['action','pengda','name','sk'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        
        $data = Scan::find($request->id);
        $data->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus']);
    }

    public function export($id)
    {
        // return $id;
        // return Excel::download(new LaporanScan(1,1), 'siswa.xlsx');
        $params = explode(':',$id);
        if($params[0] == 0 || $params[0] =='0' ){
            $pengda = '%';
        }
        else {
            $pengda = $params[0];
        }
        $oke = DB::table('scans')
        ->select('pendaftars.nama','pengdas.nama as pengda','pendaftars.no_sk','scans.*')
        ->join('pendaftars','pendaftars.id','scans.pendaftars_id')
        ->join('pengdas','pengdas.id','pendaftars.pengda_id')
        ->where('pendaftars.pengda_id','like',$pengda)->where('scan','like',$params[1])->get();

    	$pdf = PDFS::loadview('scan.laporan_scan',['datas'=>$oke,'scan'=>$params[1]]);
    	return $pdf->download('laporan-scan.pdf');
    }
}
