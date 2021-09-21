<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class CardController extends Controller
{
    public function index($id){
        $kode = Crypt::decryptString($id);
        $data = Pendaftar::where('kode',$kode)->first();
        if(empty($data)){
            return 'Maaf Anda Tidak Terdaftar';
        }
        return view('card',compact('data'));
    }
}
