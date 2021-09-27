<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function index()
    {
        $data = Pendaftar::count();
        return view('live',compact('data'));
    }
}
