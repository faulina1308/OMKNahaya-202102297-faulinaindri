<?php

namespace App\Http\Controllers;

use App\Http\Middleware\KetuaOMK;
use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('Base.dashboard', [
            'judul' => 'Dashboard',
            'page' => 'Dashboard',
            'user' => Auth::user(),
            'dataKegiatan' => Kegiatan::where('status','Pendaftaran')
                ->orWhere('status','Sedang Berlangsung')
                ->get(),
        ]);
    }
    public function userTeraktif(){
        return view('Base.anggotaTeraktif', [
            'judul' => 'Anggota Teraktif',
            'page' => 'Anggota Teraktif',
            'user' => Auth::user(),
            'userTeraktif' => User::where('akun_aktif',1)
                ->with('stasi')
                ->orderBy('partisipasi','desc')
                ->get(),
        ]);
    }
    public function riwayatSelesai(){
        $user = Auth::user();
        if ($user->peran==='KetuaOMK') {
            $kegiatans = Kegiatan::where('status','Selesai')->get();
        }elseif ($user->peran==='KetuaStasi') {
            $kegiatans = Kegiatan::where('status','Selesai')->get();
        }else{
            $kegiatans = Kegiatan::with(['absensi' => function ($query) {
                $query->where('id_user', auth()->user()->id);}])->whereHas('absensi', function ($query) {
                $query->where('id_user', auth()->user()->id);})
                ->orderBy('tanggal_kegiatan', 'desc')
                ->where('status', 'Selesai')
                ->get();
        }
        return view('Base.riwayatKegiatanSelesai', [
            'judul' => 'Riwayat',
            'page' => 'Riwayat Kegiatan Selesai',
            'user' => Auth::user(),
            'dataKegiatan' => $kegiatans
        ]);
    }
    public function riwayatDibatalkan(){
        $user = Auth::user();
        if ($user->peran==='KetuaOMK') {
            $kegiatans = Kegiatan::where('status','Dibatalkan')->get();
        }elseif ($user->peran==='KetuaStasi') {
            $kegiatans = Kegiatan::where('status','Dibatalkan')->get();
        }else{
            $kegiatans = Kegiatan::with(['absensi' => function ($query) {
                $query->where('id_user', auth()->user()->id);}])->whereHas('absensi', function ($query) {
                $query->where('id_user', auth()->user()->id);})
                ->orderBy('tanggal_kegiatan', 'desc')
                ->where('status', 'Dibatalkan')
                ->get();
        }
        return view('Base.riwayatKegiatanBatal', [
            'judul' => 'Riwayat',
            'page' => 'Riwayat Kegiatan Dibatalkan',
            'user' => Auth::user(),
            'dataKegiatan' => $kegiatans
        ]);
    }
    public function detail(Kegiatan $kegiatan){
        $auth = User::where('id',auth()->user()->id)->first();
        if ($auth->peran==="KetuaOMK") {
            $absen = Absensi::with('user','user.stasi')
                ->where('id_kegiatan',$kegiatan->id)
                ->get();
        }else{
            $absen = Absensi::with('user','user.stasi')
                ->whereHas('user', function ($query) use ($auth) {
                    $query->where('stasi_id', $auth->stasi_id);
                })
                ->where('id_kegiatan', $kegiatan->id)
                ->get();
        }
        return view('Base.detailRiwayatAbsensi', [
            'judul' => 'Riwayat',
            'page' => 'Detail Riwayat Absensi',
            'user' => Auth::user(),
            'kegiatan' => $kegiatan,
            'dataAbsen' => $absen
        ]);
    }
}