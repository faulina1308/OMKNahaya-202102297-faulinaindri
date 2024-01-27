<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(){
        return view('Base.riwayatKegiatan', [
            'judul' => 'Kegiatan',
            'page' => 'Riwayat Kegiatan',
            'user' => Auth::user(),
            'dataKegiatan' => Kegiatan::with(['absensi' => function ($query) {
                $query->where('id_user', auth()->user()->id);}])->whereHas('absensi', function ($query) {
                $query->where('id_user', auth()->user()->id);})
                ->orderBy('tanggal_kegiatan', 'desc')
                ->where('status', 'Selesai')
                ->get()
        ]);
    }
    public function berlangsung(){
        return view('Base.kegiatanBerlangsung', [
            'judul' => 'Kegiatan',
            'page' => 'Kegiatan Sedang Berlangsung',
            'user' => Auth::user(),
            'dataKegiatan' => Kegiatan::with(['absensi' => function ($query) {
                $query->where('id_user', auth()->user()->id);}])->whereHas('absensi', function ($query) {
                $query->where('id_user', auth()->user()->id);})
                ->orderBy('tanggal_kegiatan', 'desc')
                ->where('status', 'Sedang Berlangsung')
                ->get()
        ]);
    }
    public function pendaftaran(){
        return view('Base.pendaftaranKegiatan', [
            'judul' => 'Kegiatan',
            'page' => 'Pendaftaran Kegiatan',
            'user' => Auth::user(),
            'dataKegiatan' => Kegiatan::where('status','Pendaftaran')
                ->with('absensi')
                ->orderBy('tanggal_kegiatan', 'desc')
                ->get()
        ]);
    }
}
