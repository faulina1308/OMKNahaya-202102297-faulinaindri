<?php

namespace App\Http\Controllers;

use App\Models\Stasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaOMKController extends Controller
{
    public function index(){
        if (Auth::user()->peran==='KetuaOMK') {
            $data = User::where('peran','Anggota')
                ->where('akun_aktif',0)
                ->with('stasi')
                ->orderBy('updated_at', 'desc')
                ->filterByStasi(request('stasi'))
                ->get();
        }elseif(Auth::user()->peran==='KetuaStasi'){
            $data = User::where('stasi_id',auth()->user()->stasi_id)
                ->where('peran','Anggota')
                ->where('akun_aktif',0)
                ->with('stasi')
                ->orderBy('updated_at', 'desc')
                ->get();
        }else{
            $data = [];
        }
        return view('Base.requestAnggota', [
            'judul' => 'Anggota',
            'user' => Auth::user(),
            'page' => 'Aktivasi Anggota Baru',
            'dataUser' => $data
        ]);
    }
    public function akunAktif(Request $request){
        $user = User::where('id', $request->idUser)->first();
        if ($user) {
            $user->tanggal_bergabung = now();
            $user->akun_aktif = true;
            $user->save();
            return redirect('/request-anggota-baru')->with('success', 'Akun '.$user->nama.' berhasil diaktivasi');
        }
        return redirect('/request-anggota-baru')->with('error', 'User tidak ditemukan');
    }
    public function tolakAktif(Request $request){
        $user = User::where('id', $request->idUser)->first();
        if ($user) {
            $user->delete();
            return redirect('/request-anggota-baru')->with('success', 'Akun '.$user->nama.' berhasil dihapus');
        }
        return redirect('/request-anggota-baru')->with('error', 'User tidak ditemukan');
    }

    public function semua(){
        if (Auth::user()->peran==='KetuaOMK') {
            $data = User::where('peran','Anggota')
                ->where('akun_aktif', 1)
                ->with('stasi')
                ->orderBy('stasi_id', 'asc')
                ->filterByStasi(request('stasi'))
                ->get();
        }elseif(Auth::user()->peran==='KetuaStasi'){
            $data = User::where('stasi_id',auth()->user()->stasi_id)
                ->where('peran','Anggota')
                ->where('akun_aktif', 1)
                ->with('stasi')
                ->orderBy('stasi_id', 'desc')
                ->get();
        }else{
            $data = [];
        }
        return view('Base.semuaAnggota', [
            'judul' => 'Anggota',
            'user' => Auth::user(),
            'page' => 'Semua Anggota OMK',
            'dataUser' => $data,
            'dataStasi' => Stasi::all()
        ]);
    }
    public function semuaKetua(){
        $data = User::Where('peran','KetuaStasi')
            ->where('akun_aktif', 1)
            ->with('stasi')
            ->orderBy('stasi_id', 'asc')
            ->get();
        return view('Base.semuaKetua', [
            'judul' => 'Anggota',
            'user' => Auth::user(),
            'page' => 'Semua Ketua Stasi',
            'dataUser' => $data,
        ]);
    }
    public function hapusAkun(Request $request){
        $user = User::where('id', $request->idUser)->first();
        if ($user) {
            $user->delete();
            return redirect('/semua-anggota-omk')->with('success', 'Akun '.$user->nama.' berhasil dihapus');
        }
        return redirect('/semua-anggota-omk')->with('error', 'User tidak ditemukan');
    }
    public function updatePeran(Request $request){
        $user = User::where('id', $request->idUser)
        ->with('stasi')
        ->first();
        $ketuaStasi =  User::where('stasi_id', $user->stasi_id)
        ->where('peran','KetuaStasi')
        ->first();
        if ($user) {
            if ($request->peran==="Anggota") {
                if ($ketuaStasi!==null) {
                    return redirect('/semua-anggota-omk')->with('error', 'Ketua untuk stasi '.$user->stasi->nama_stasi. ' sudah ada');
                }
                $user->peran = "KetuaStasi";
                $user->save();
                return redirect('/semua-anggota-omk')->with('success', 'Peran berhasil diubah menjadi Ketua Stasi');
            }else{
                $user->peran = "Anggota";
                $user->save();
                return redirect('/semua-anggota-omk')->with('success', 'Peran berhasil diubah menjadi Anggota');
            }
            return redirect('/semua-anggota-omk')->with('success', 'Akun '.$user->nama.' berhasil dihapus');
        }
        return redirect('/semua-anggota-omk')->with('error', 'User tidak ditemukan');
    }
}
