<?php

namespace App\Http\Controllers;

use App\Models\Pengda;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;
use DataTables;
use Illuminate\Support\Facades\Validator;

class PendaftarController extends Controller
{
    public function index()
    {
        if(Auth::user()->level != 1){
            return view('404');
        }
        $pengdas = Pengda::all();
        return view('pendaftar.index',compact('pengdas'));
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
                    ->editColumn('action', function ($row) {
                        $wa = "https://api.whatsapp.com/send?phone=".$row->wa."&text=From: Panitia Ikatan Pejabat Pembuat Akta Tanah (IPPAT) E-ID Card Klik disini: " .env("HOST_ECARD", "www").Crypt::encryptString($row->kode)." NB: SIMPAN DULU NOMOR INI YA, SUPAYA BISA KLIK LINKNYA";
                        $action = '';
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$row->id}' onclick='Edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$row->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";
                        $action .= "<a href='$wa' target='_blank' class='btn btn-icon btn-success'><i class='fas fa-comments'></i></a>&nbsp;";


                        return $action;
                    })
                    ->editColumn('kode', function($row) {
                        $kodes = '';
                        
                        $kodes .= "<label class='badge badge-primary'>{$row->kode}</label>&nbsp;";
                            
                        
                        return $kodes;
                    })
                    ->editColumn('wa', function($row) {
                        $wa = '';
                        
                        $wa .= $row->wa;
                            
                        
                        return $wa;
                    })
                    ->editColumn('email', function($row) {
                        $email = '';
                        
                        $email .= $row->email;
                            
                        
                        return $email;
                    })
                    ->editColumn('no_sk', function($row) {
                        $no_sk = '';
                        
                        $no_sk .= $row->no_sk;
                            
                        
                        return $no_sk;
                    })
                    ->editColumn('nama', function($row) {
                        $nama = '';
                        
                        $nama .= $row->nama;
                            
                        
                        return $nama;
                    })
                    ->editColumn('foto', function($row) {
                        $url = asset("upload/foto/".$row->img_foto);
                        $foto = '';
                        $foto .= "<a href=".$url."  target='_blank'><img src=".$url." border='0' width='50' height='60px' class='img' align='center' />'</a>" ;
        
                        return $foto;
                    })
                    ->editColumn('bukti', function($row) {
                        $url = asset("upload/bukti/".$row->img_bukti);
                        $bukti = '';
                        $bukti .= "<a href=".$url."  target='_blank'><img src=".$url." border='0' width='50' height='60px' class='img' align='center' />'</a>" ;
        
                        return $bukti;
                    })
                    ->editColumn('sk', function($row) {
                        $url = asset("upload/sk/".$row->img_sk);
                        $sk = '';
                        $sk .= "<a href=".$url."  target='_blank'><img src=".$url." border='0' width='50' height='60px' class='img' align='center' />'</a>" ;
        
                        return $sk;
                    })
                    ->editColumn('pengda', function($row) {
                        $pengda = '';
                        
                        $pengda .= $row->getPengda->nama;
                            
                        
                        return $pengda;
                    })
                    ->rawColumns(['action','kode','foto','bukti','sk','email','wa','no_sk',
                    'nama'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Pendaftar = Pendaftar::find($id);
        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data!', 'data' => $Pendaftar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validated = $request->validate([
            'nama' => 'required',
            'wa' => 'required',
            'email'  => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'wa.required' => 'wa tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{
            $user = Pendaftar::find($request->id);
            $user->update([
                'nama' => Crypt::encryptString($request->nama),
                'wa' => Crypt::encryptString($request->wa),
                'email' => Crypt::encryptString($request->email),
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil mengubah data!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $Pendaftar = Pendaftar::find($request->id);
        //hapus file lama
        if (file_exists(public_path('upload/foto/').$Pendaftar->img_foto))
        {
            $image_path_pas_foto = public_path('upload/foto/').$Pendaftar->img_foto;

            unlink($image_path_pas_foto);
        }
        if (file_exists(public_path('upload/bukti/').$Pendaftar->img_bukti))
        {
            $image_path_pas_bukti = public_path('upload/bukti/').$Pendaftar->img_bukti;

            unlink($image_path_pas_bukti);
        }    
        if (file_exists(public_path('upload/sk/').$Pendaftar->img_sk))
        {
            $image_path_pas_sk = public_path('upload/sk/').$Pendaftar->img_sk;

            unlink($image_path_pas_sk);
        }            
        $Pendaftar->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus']);
    }
}
