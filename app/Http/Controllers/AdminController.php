<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use DataTables;
use Auth;
class AdminController extends Controller
{
   
    public function index()
    {
        if(Auth::user()->level != 1){
            return view('404');
        }
        return view('admin.index');
    }

    public function data(Request $request){

        if ($request->ajax()) {

            $data = User::all();

            return Datatables::of($data)
                    ->editColumn('action', function ($row) {
                        $action = '';
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$row->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$row->id}' onclick='Edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                        $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-warning'  data-id='{$row->id}' onclick='reset(this);'><i class='fa fa-undo'></i></a>&nbsp;";
                        return $action;
                    })
                    ->editColumn('level', function ($row) {
                        $level = '';
                        if($row->level == 1){
                            $level = 'Admin';
                        }
                        if($row->level == 2){
                            $level = 'User';
                        }
                        if($row->level == 3){
                            $level = 'Scan 1';
                        }
                        if($row->level == 4){
                            $level = 'Scan 2';
                        }
                        if($row->level == 5){
                            $level = 'Scan 3';
                        }


                        return $level;
                    })
                    ->rawColumns(['action','level'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
            'level.required' => 'level tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{

            $data = User::create([
                'name' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'level' => $request->level,
                'email' => ''
              
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan data!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
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
        $validated = $request->validate([
            'nama' => 'required',
            'username' => "required|unique:users,username,{$request->id},id",
            'level' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'username.required' => 'username tidak boleh kosong',
            'level.required' => 'level tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{
            $user = User::find($request->id);
            $user->update([
                'name' => $request->nama,
                'username' => $request->username,
                'level' => $request->level,
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil mengubah data!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        //
        $user = User::find($id);
        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data!', 'data' => $user]);
    }

    public function destroy(Request $request)
    {
        //
        $admin = User::find($request->id);
        $admin->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus']);
    }

    public function reset(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            if (!$user) {
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan.']);
            }
            $user->update([
                'password' => bcrypt(12345678),
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil reset password User']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}
