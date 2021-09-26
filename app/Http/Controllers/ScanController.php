<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class ScanController extends Controller
{
    public function index($kode){
        $kode = Crypt::decryptString($kode);
        $pendaftar = Pendaftar::where('kode',$kode)->with('getPengda')->first();
        if(empty($pendaftar)){
            return response()->json(['status' => 'error', 'message' => 'Pendaftar Tidak Ditemukan!']);
        }

        $data = [
            'nama' => $pendaftar->nama,
            'nik' => $pendaftar->ktp,
            'no_sk' => $pendaftar->no_sk,
            'img_foto' => $pendaftar->img_foto
        ];
        return response()->json(['status' => 'success', 'message' => 'Pendaftar Ditemukan!', 'data' => $data]);
    }

    public function daftar_ulang()
    {
        return view('scan.daftar_ulang');
    }

    public function daftar_ulang_store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required'
        ],[
            'kode.required' => 'Kode tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try{
            $pendaftars = Pendaftar::where('kode',$request->kode)->get();

            if($pendaftars->count()<=0){
                return response()->json(['status' => 'error', 'message' => 'Pendaftar Tidak Ditemukan!']);
            }

            $scan = Scan::where('kode',$request->kode)
                            ->where('scan',1)->get();

            if($scan->count()>0){
                return response()->json(['status' => 'warning', 'message' => 'Pendaftar Sudah Pernah Daftar Ulang!']); 
            }

            $kode = Crypt::encryptString($request->kode);
            $data = Scan::insert([
                'kode' => $request->kode,
                'pendaftars_id' => $pendaftars->first()->id,
                'scan' => 1,
                'jam' => Carbon::now()->format('H:i:s'),
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => Auth::user()->id
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Absen!', 'kode' => $kode]);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function surat_suara()
    {
        return view('scan.surat_suara');
    }

    public function surat_suara_store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required'
        ],[
            'kode.required' => 'Kode tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try{
            $pendaftars = Pendaftar::where('kode',$request->kode)->get();

            if($pendaftars->count()<=0){
                return response()->json(['status' => 'error', 'message' => 'Pendaftar Tidak Ditemukan!']);
            }

            $scan = Scan::where('kode',$request->kode)  
                            ->where('scan',1)->get();

            if($scan->count()<=0){
                return response()->json(['status' => 'warning', 'message' => 'Pendaftar Belum Daftar Ulang!']); 
            }

            $scan = Scan::where('kode',$request->kode)
                            ->where('scan',2)->get();
            
            if($scan->count()>0){
                return response()->json(['status' => 'warning', 'message' => 'Pendaftar Sudah Pernah Absen Surat Suara!']); 
            }

            $kode = Crypt::encryptString($request->kode);
            $data = Scan::insert([
                'kode' => $request->kode,
                'pendaftars_id' => $pendaftars->first()->id,
                'scan' => 2,
                'jam' => Carbon::now()->format('H:i:s'),
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => Auth::user()->id
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Absen!', 'kode' => $kode]);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function kotak_suara()
    {
        return view('scan.kotak_suara');
    }

    public function kotak_suara_store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required'
        ],[
            'kode.required' => 'Kode tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try{
            $pendaftars = Pendaftar::where('kode',$request->kode)->get();

            if($pendaftars->count()<=0){
                return response()->json(['status' => 'error', 'message' => 'Pendaftar Tidak Ditemukan!']);
            }

            $scan = Scan::where('kode',$request->kode)  
                            ->where('scan',1)->get();

            if($scan->count()<=0){
                return response()->json(['status' => 'warning', 'message' => 'Pendaftar Belum Daftar Ulang!']); 
            }

            $scan = Scan::where('kode',$request->kode)  
                            ->where('scan',2)->get();

            if($scan->count()<=0){
                return response()->json(['status' => 'warning', 'message' => 'Pendaftar Belum Absen Surat Suara!']); 
            }

            $scan = Scan::where('kode',$request->kode)
                            ->where('scan',3)->get();
            
            if($scan->count()>0){
                return response()->json(['status' => 'warning', 'message' => 'Pendaftar Sudah Pernah Absen Kotak Suara!']); 
            }

            $kode = Crypt::encryptString($request->kode);
            $data = Scan::insert([
                'kode' => $request->kode,
                'pendaftars_id' => $pendaftars->first()->id,
                'scan' => 3,
                'jam' => Carbon::now()->format('H:i:s'),
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => Auth::user()->id
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Absen!', 'kode' => $kode]);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
