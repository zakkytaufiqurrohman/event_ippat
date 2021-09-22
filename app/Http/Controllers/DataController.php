<?php

namespace App\Http\Controllers;
use App\Models\Pengda;
use App\Models\Data;
use DB;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function index()
    {
        // return Crypt::encryptString('zakky'); 
        $pengdas = Pengda::all();
        return view('data.index',compact('pengdas'));
    }

    public function data(Request $request){

        if ($request->ajax()) {

            $data = Data::all();

            return Datatables::of($data)
                    ->editColumn('action', function ($row) {
                        $action = '';
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
}
