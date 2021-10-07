<?php

namespace App\Http\Controllers;

use App\Exports\DataPeserta;
use App\Models\Pengda;
use App\Models\Data;
use DB;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Imports\DataImport;
use App\Models\Sk;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Auth;

class DataController extends Controller
{
    public function index()
    {
        if(Auth::user()->level != 1){
            return view('404');
        }        
        $pengdas = Pengda::all();
        return view('data.index',compact('pengdas'));
    }

    public function data(Request $request){

        if ($request->ajax()) {

            $data = Data::all();

            return Datatables::of($data)
                    ->editColumn('action', function ($row) {
                        $action = '';
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$row->id}' onclick='Edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";

                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$row->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";


                        return $action;
                    })
                    ->editColumn('pengda', function($row) {
                        $pengda = '';
                        
                        $pengda .= $row->getPengda->nama;
                            
                        
                        return $pengda;
                    })
                    ->editColumn('name', function($row) {
                        $name = '';
                        
                        $name .= Crypt::decryptString($row->nama);
                            
                        
                        return $name;
                    })
                    ->editColumn('sk', function($row) {
                        $sk = '';
                        
                        $sk .= Crypt::decryptString($row->no_sk);
                            
                        
                        return $sk;
                    })
                    ->editColumn('alamat', function($row) {
                        $alamat = '';
                        
                        $alamat .= Crypt::decryptString($row->alamat);
                            
                        
                        return $alamat;
                    })
                    ->editColumn('nick', function($row) {
                        $nick = '';
                        
                        $nick .=$row->nick_name;
                            
                        
                        return $nick;
                    })
                    ->rawColumns(['action','pengda','name','sk','nick','alamat'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function import(Request $request) 
    {
        $validator = Validator::make(
            [
                'file'      => $request->file,
                'extension' => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:xlsx,xls',
            ]
          );
          if ($validator->fails()) {
            return 'format salah';
          }
        Excel::import(new DataImport,request()->file('file'));
             
        return back();
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'pengda' => 'required',
            'nama' => 'required|unique:sk,nama',
            'no_sk' => 'required|unique:sk,no_sk',
            'alamat' => 'required',
        ],[
            'pengda.required' => 'Pengda tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
            'no_sk.required' => 'no sk tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{
            $nick = explode(',',$request->nama);
            $datas = Data::where('nick_name',strtolower($nick[0]))->first();
            if(!empty($datas->nama)){
                return response()->json(['status' => 'error', 'message' => 'Nama sudah ada!']);
            }
            $data = Data::create([
                'pengda_id' => $request->pengda,
                'nama' =>  Crypt::encryptString($request->nama),
                'no_sk' => Crypt::encryptString($request->no_sk),
                'alamat' =>  Crypt::encryptString($request->alamat),
                'nick_name' => strtolower($nick[0]),
              
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan data!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        //
        $data = Data::find($request->id);
        $data->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus']);
    }

    public function export()
    {   
        return Excel::download(new DataPeserta(), 'DataPeserta.xlsx');
    }

    public function edit($id)
    {
        //
        $user = Sk::find($id);
        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data!', 'data' => $user]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'pengda' => 'required',
            'nick_name' => "required|unique:sk,nick_name,{$request->id},id",
            'no_sk' => 'required|unique:sk,no_sk',
            'alamat' => 'required',
        ],[
            'pengda.required' => 'Pengda tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
            'no_sk.required' => 'no sk tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{
            $user = Data::find($request->id);
            $user->update([
                'pengda_id' => $request->pengda,
                'nama' =>  Crypt::encryptString($request->nama),
                'no_sk' => Crypt::encryptString($request->no_sk),
                'alamat' =>  Crypt::encryptString($request->alamat),
                'nick_name' => $request->nick_name,
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil mengubah data!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
