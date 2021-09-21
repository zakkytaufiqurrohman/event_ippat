<?php

namespace App\Http\Controllers;
use App\Models\Pengda;
use App\Models\Data;
use DB;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Imports\PengdaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PengdaController extends Controller
{
    public function index()
    {
        return view('pengda.index');
    }

    public function data(Request $request){

        if ($request->ajax()) {

            $data = Pengda::all();

            return Datatables::of($data)
                    ->editColumn('action', function ($row) {
                        $action = '';
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$row->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";


                        return $action;
                    })
                    ->rawColumns(['action'])
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
        Excel::import(new PengdaImport,request()->file('file'));
             
        return back();
    }

    public function destroy(Request $request)
    {
        //
        $pengda = Pengda::find($request->id);
        // $pengda->update(['deleted_by' => Auth::user()->id]);
        $pengda->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus']);
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try{

            $data = Pengda::create([
                'nama' => $request->nama,
              
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan data!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
