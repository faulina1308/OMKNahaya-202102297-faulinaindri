<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function lengkapiDatas(Request $request){
        if ($request->session()->has('lengkapi_data')) {
            $user = Auth::user();
            return view('Auth.lengkapiData', [
                'judul' => 'Lengkapi Data',
                'user' => $user,
            ]);
        }
        return redirect('/');
    }
    public function kirimData(Request $request){
        if ($request->session()->has('lengkapi_data')) {
            $user = User::where('id',auth()->user()->id)->first();
            $datas = $request->validate([
                'no_telepon' => 'required|unique:users',
                'jenis_kelamin' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required|min:5',
            ]);
            $user->no_telepon = $datas['no_telepon'];
            $user->jenis_kelamin = $datas['jenis_kelamin'];
            $user->tanggal_lahir = $datas['tanggal_lahir'];
            $user->alamat = $datas['alamat'];
            $user->save();
            $request->session()->forget('lengkapi_data');
            return redirect('/dashboard');
        }
        return redirect('/');
    }
    public function daftarKegiatan(Request $request){
        $user = User::where('id',auth()->user()->id)->first();
        $kegiatan = Kegiatan::where('id',$request->kegiatan)->first();
        if($kegiatan){
            if ($kegiatan->partisipasi>=$kegiatan->max_partisipasi) {
                return redirect()->back()->with('error','Kegiatan ini sudah mencapai max partisipasi');
            }else{
                if (now()->format('Y-m-d')<=$kegiatan->pendaftaran) {
                    $kegiatan->partisipasi = $kegiatan->partisipasi+1;
                    $kegiatan->save();
                    Absensi::create([
                        'id_user' => $user->id,
                        'id_kegiatan' => $kegiatan->id,
                    ]);
                    $user->partisipasi = $user->partisipasi+1;
                    $user->save();
                    return redirect('/pendaftaran-kegiatan')->with('success','Berhasil mendaftar pada kegiatan'); 
                }
                return redirect()->back()->with('error','Waktu pendaftaran sudah ditutup'); 
            }
        } 
        return redirect()->back()->with('error','Kegiatan tidak di terdaftar'); 
    }
    public function batalDaftar(Request $request){
        $user = User::where('id',auth()->user()->id)->first();
        $kegiatan = Kegiatan::where('id',$request->kegiatan)->first();
        if($kegiatan){
            if (now()->format('Y-m-d')<=$kegiatan->pendaftaran) {
                $absensi = Absensi::where('id_user',$user->id)
                    ->where('id_kegiatan',$kegiatan->id)
                    ->first();
                if ($absensi) {
                    $kegiatan->partisipasi = $kegiatan->partisipasi-1;
                    $kegiatan->save();
                    $absensi->delete();
                    $user->partisipasi = $user->partisipasi-1;
                    $user->save();
                    return redirect('/pendaftaran-kegiatan')->with('success','Pendaftaran berhasil dibatalkan'); 
                }
                return redirect()->back()->with('error','Kegiatan tidak di terdaftar'); 
            }
            return redirect()->back()->with('error','Kegiatan sedang beralngsung tdiak dapat dibatalkan'); 
        } 
        return redirect()->back()->with('error','Kegiatan tidak di terdaftar'); 
    }
    public function profilUser(){
        return view('Base.profilUser', [
            'judul' => 'Profil',
            'page' => 'Profil User',
            'user' => User::where('id',auth()->user()->id)
                ->with('stasi')
                ->first(),
        ]);
    }
    public function updateUser(Request $request){
        $user = User::where('id',$request->idUser)->first();
        if ($user) {
            $datas = $request->validate([
                'nama' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required|min:5',
            ]);
            $user->nama = $datas['nama'];
            $user->tanggal_lahir = $datas['tanggal_lahir'];
            $user->alamat = $datas['alamat'];
            $user->save();
            return redirect('/pengaturan-profil')->with('success','Profil kamu berhasil diupdate'); 
        }
        return redirect()->back()->with('error','User tidak ditemukan'); 
    }
}
