<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(){
        return view('Base.absensiKegiatan', [
            'judul' => 'Absensi',
            'page' => 'Absensi Kegiatan',
            'user' => Auth::user(),
            'dataKegiatan' => Kegiatan::where('status', 'Sedang Berlangsung')
            ->orderBy('tanggal_kegiatan', 'desc')
            ->get(),
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
        return view('Base.detailAbsensi', [
            'judul' => 'Absensi',
            'page' => 'Detail Kegiatan',
            'user' => Auth::user(),
            'kegiatan' => $kegiatan,
            'dataAbsen' => $absen
        ]);
    }
    public function updateAbsensi(Request $request){
        foreach ($request->absensi as $absensiId => $absensiValue) {
            $absensi = Absensi::find($absensiId);
            if ($absensi) {
                $absensi->absensi = $absensiValue;
                $absensi->keterangan = $request->keterangan[$absensiId];
                $absensi->save();
            }
        }
        return redirect()->back()->with('success', 'Data absensi berhasil diupdate');
    }

}
