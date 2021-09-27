<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json(['status' => 'warning', 'message' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            if ($this->attemptLogin($request)) {
                $request->session()->regenerate();

                DB::commit();
                return ['status' => 'success', 'message' => 'Berhasil masuk.'];
            }

            DB::rollback();
            return ['status' => 'error', 'message' => 'Nama Pengguna atau Kata Sandi yang Anda masukkan salah.'];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }

    protected function attemptLogin(Request $request, $guard = 'web')
    {
        if ($guard == 'web') {
            return $this->guard($guard)->attempt($this->credentials($request), $request->filled('remember'));
        }
        return $this->guard($guard)->attempt($this->credentials($request));
    }

    protected function credentials(Request $request)
    {
        $data = ['username' => $request->username,'password' => $request->password];
        return $data;
    }

    protected function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }

    protected function validator(array $data)
    {
        $rules = [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus berupa String'
        ];

        return Validator::make($data, $rules, $messages);
    }

    public function dashboard()
    {
        $admin = User::count();
        $pendaftar = Pendaftar::count();
        $peserta = Data::count();
        return view('dashboard',compact('admin','pendaftar','peserta'));
    }
}