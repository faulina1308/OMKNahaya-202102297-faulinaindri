<?php

namespace App\Http\Controllers;

use App\Jobs\anggotaBaruJob;
use App\Models\Stasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('Auth.login', [
            'judul' => 'Login',
        ]);
    }

    public function cekLogin(Request $request){
        $datas = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {   
            if ($user->akun_aktif === 1) {
                if (Auth::attempt($datas)) {
                    $request->session()->regenerate();
                    $request->session()->put('lengkapi_data', true);
                    return redirect()->intended('/dashboard');
                }
                return back()->with('error', 'Email atau Password anda salah!');
            }
            return back()->with('error', 'Akun kamu belum aktif!');
        }
        return back()->with('error', 'Akun kamu belum terdaftar!');      
    }

    public function register(){
        return view('Auth.register', [
            'judul' => 'Register',
            'daftarStasi' => Stasi::all()
        ]);
    }

    public function daftarAkun(Request $request){
        $dataUser = User::where('email', $request->email)
            ->first();
        if ($dataUser!==null) {
            if ($dataUser->akun_aktif===1) {
                $datas = $request->validate([
                    'nama' => 'required',
                    'email' => 'required|unique:users|email:dns',
                    'password' => 'required|min:8|max:20|same:password_confirmation',
                    'stasi_id' => 'required|exists:stasis,id',
                ]);
            }else {
                $dataUser->delete();
                $datas = $request->validate([
                    'nama' => 'required',
                    'email' => 'required|unique:users|email:dns',
                    'password' => 'required|min:8|max:20|same:password_confirmation',
                    'stasi_id' => 'required|exists:stasis,id',
                ]);
                $datas['password'] = bcrypt($datas['password']);
                User::create($datas);
                $dataStasi = Stasi::where('id', $request->stasi_id)->first();
                $ketuaOMK = User::where('peran', 'KetuaOMK')->first();
                $ketuaStasi = User::where('stasi_id', $request->stasi_id)->where('peran', 'KetuaStasi')->first();
                dispatch(new anggotaBaruJob($request->nama, $dataStasi->nama_stasi, $request->email, $ketuaOMK->email));
                if ($ketuaStasi!==null) {
                    dispatch(new anggotaBaruJob($request->nama, $dataStasi->nama_stasi, $request->email, $ketuaStasi->email));
                }
                $request->session()->put('registrasi_berhasil', true);
                return redirect('/registrasi-berhasil/'.$request->email);
            }
        }else{
            $datas = $request->validate([
                'nama' => 'required',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required|min:8|max:20|same:password_confirmation',  
                'stasi_id' => 'required|exists:stasis,id',
            ]);
            $datas['password'] = bcrypt($datas['password']);
            User::create($datas);
            $dataStasi = Stasi::where('id', $request->stasi_id)->first();
            $ketuaOMK = User::where('peran', 'KetuaOMK')->first();
            $ketuaStasi = User::where('stasi_id', $request->stasi_id)->where('peran', 'KetuaStasi')->first();
            dispatch(new anggotaBaruJob($request->nama, $dataStasi->nama_stasi, $request->email, $ketuaOMK->email));
            if ($ketuaStasi!==null) {
                dispatch(new anggotaBaruJob($request->nama, $dataStasi->nama_stasi, $request->email, $ketuaStasi->email));
            }
            $request->session()->put('registrasi_berhasil', true);
            return redirect('/registrasi-berhasil/'.$request->email);
        }
    }
    public function registrasiBerhasil(Request $request, User $user){
        if ($request->session()->has('registrasi_berhasil')) {
            $request->session()->forget('registrasi_berhasil');
            return view('Auth.success', [
                'user' => $user,
                'ketuaStasi' => User::where('stasi_id', $user->stasi_id)->where('peran', 'KetuaStasi')->first(),
                'ketuaOMK' => User::where('peran', 'KetuaOMK')->first()
            ]);
        }
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
