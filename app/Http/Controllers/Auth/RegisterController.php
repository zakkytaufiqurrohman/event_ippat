<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Pengda;
use App\Models\Pendaftar;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

use DB;


class RegisterController extends Controller
{
    //

    public function index(){
        $pengdas = Pengda::all();
        return view('auth.register',compact('pengdas'));
    }

    public function success(){
        return view('success');
    }

    public function cekNama(Request $request){
        $sk = Data::where('nick_name',strtolower($request->nama))->where('pengda_id',$request->pengda)->first();
        if(empty($sk->nama)){
            return response()->json(0);
        }
        else {
            return response()->json(Crypt::decryptString($sk->no_sk));
        }

    }

    public function register(Request $request){

        $data = Data::where('pengda_id',$request->pengda)->where('nick_name',$request->nama)->first();
        if(empty($data)){
            return response()->json(['status' => 'error', 'message' => 'Maaf Anda Tidak Terdaftar Hub Panitia']);
        }
        $this->validate($request,[
            'pengda' => 'required|max:255',
            'nama' => 'required|min:2|max:255|unique:Pendaftars,nick_name',
            'no_sk' => 'required|min:2',
            'wa' => 'required|min:2',
            'email' => 'required|min:2',
            'ktp' =>'required|min:2',
            'sk' => 'required|max:500|mimes:jpeg,jpg,png',
            'foto' => 'required|max:500|mimes:jpeg,jpg,png',
            'bukti_tf' => 'required|max:500|mimes:jpeg,jpg,png',
        ],[
            'pengda.required'=>'pengda Tidak Boleh Kosong',
            'wa.required'=>'NO WA Tidak Boleh Kosong',
            'no_sk.required'=>'No Sk Tidak Boleh Kosong',
            'ktp.required'=>'Ktp Tidak Boleh Kosong',
            'email.required'=>'email Tidak Boleh Kosong',
            'nama.unique'=>'Anda Sudah Terdaftar',
            'nomor.min'=>'Nomor minimal 2 character',
            'no_sk.min'=>'No sk minimal 2 character',
            'ktp.min'=>'Ktp minimal 2 character',
            'email.min'=>'email minimal 2 character',

            'sk.mimes' => 'Format harus jpeg,jpg,png ',
            'foto.mimes' => 'Format harus jpeg,jpg,png ',
            'bukti_tf.mimes' => 'Format harus jpeg,jpg,png ',
            'bukti_tf.max' => 'Max file upload 500 Kbps',
            'foto.max' => 'Max file upload 500 Kbps',
            'sk.max' => 'Max file upload 500 Kbps'
            
        ]);
        DB::beginTransaction();
        try{
            // upload
            $sk = $request->sk;
            $foto = $request->foto;
            $bukti_tf = $request->bukti_tf;

            $text_sk = str_replace(' ', '',$sk->getClientOriginalName());
            $nama_file_sk = time()."_".$text_sk;

            $text_foto = str_replace(' ', '',$foto->getClientOriginalName());
            $nama_file_foto = time()."_".$text_foto;

            $text_bukti = str_replace(' ', '',$bukti_tf->getClientOriginalName());
            $nama_file_bukti = time()."_".$text_bukti;


            //tail wa
            $wa = $request->wa;
            if(substr($wa,0,1) == 0) {
                $wa = '62'.substr($wa, 1);
            }
            if(substr($wa,0,1) == '+') {
                $wa = substr($wa, 1);
            }

            // tail kode
            // 1 pengda ,2 no sk,4 digit id
            $id = Pendaftar::max('id');
            $id = $id+1;
            if( strlen($id) == 1){
                $ids = '000'.$id;
            }
            else if(strlen($id) == 2){
                $ids = '00'.$id;
            }
            else if(strlen($id) == 2){
                $ids = '0'.$id;
            }
            else {
                $ids = $id;
            }
            $pengda = Pengda::where('id',$request->pengda)->first();
            if(!empty($pengda)){
                $pengda = $pengda->nama;
            }
            else {
                $pengda = 'Z';
            }
            $kode = strtoupper(substr($pengda,0,1)).strtoupper(substr($request->no_sk,-4)).$ids;

            // get name 
            $gelar = Data::where('nick_name',strtolower($request->nama))->first();
            if(!empty($gelar)){
                $nama = $gelar->nama;
            }
            else {
                $nama = $request->nama;
            }
            // store
            Pendaftar::create([
                'kode' => $kode,
                'pengda_id' => $request->pengda,
                'wa' => Crypt::encryptString($wa),
                'email' => Crypt::encryptString($request->email),
                'nama' => $nama,
                'nick_name' => strtolower($request->nama),
                'ktp' => Crypt::encryptString($request->ktp),
                'no_sk' => Crypt::encryptString($request->no_sk),
                'img_sk' => $nama_file_sk,
                'img_foto' => $nama_file_foto,
                'img_bukti' => $nama_file_bukti,
            ]);

          
            $details = [
                'name' =>  Crypt::decryptString($gelar->nama),
            ];
            Mail::to($request->email)->send(new SendEmail($details));
            DB::commit();
            $sk->move(public_path('upload/sk'),$nama_file_sk);
            $foto->move(public_path('upload/foto'),$nama_file_foto);
            $bukti_tf->move(public_path('upload/bukti'),$nama_file_bukti);
            return response()->json(['status' => 'success', 'message' => 'Berhasil Registrasi']);
        } catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
