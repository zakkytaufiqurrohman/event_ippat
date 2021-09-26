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
        $data = Pendaftar::where('kode',$kode)->with('getPengda')->first();
        if(empty($data)){
            return view('404');
        }
        return view('card',compact('data'));
    }
}
