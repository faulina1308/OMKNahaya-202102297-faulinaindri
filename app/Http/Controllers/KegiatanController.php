<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index(){
        return view('Base.semuaKegiatan', [
            'judul' => 'Kegiatan',
            'page' => 'List Kegiatan',
            'user' => Auth::user(),
            'dataKegiatan' => Kegiatan::where('status','Pendaftaran')
            ->orWhere('status','Sedang Berlangsung')
            ->orderBy('tanggal_kegiatan', 'asc')
            ->get(),
        ]);
    }
    public function tambahKegiatanView(){
        return view('Base.tambahKegiatan', [
            'judul' => 'Kegiatan',
            'page' => 'Tambah Kegiatan',
            'user' => Auth::user(),
        ]);
    }
    public function tambahKegiatan(Request $request){
        $datas = $request->validate([
            'nama_kegiatan' => 'required|unique:kegiatans',
            'tanggal_kegiatan' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_kegiatan',
            'pendaftaran' => ['required',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggalKegiatan = $request->input('tanggal_kegiatan');
                    if ($value >= $tanggalKegiatan) {
                        $fail('Tanggal tutup pendaftaran tidak boleh lewat/sama dengan tanggal kegiatan.');
                    }
                },
            ],
            'anggaran' => 'required',
            'max_partisipasi' => 'required',
            'deskripsi' => 'required',
        ]);
        $datas['anggaran'] = str_replace('.', '', $request->anggaran);
        $datas['slug'] = Str::slug($request->nama_kegiatan, '-');
        Kegiatan::create($datas);
        return redirect('/kegiatan-omk')->with('success', 'Kegiatan berhasil ditambahkan');
    }
    public function editKegiatanView(Kegiatan $kegiatan){
        return view('Base.editKegiatan', [
            'judul' => 'Kegiatan',
            'page' => 'Edit Kegiatan',
            'user' => Auth::user(),
            'dataKegiatan' => $kegiatan
        ]);
    }
    public function editKegiatan(Request $request, Kegiatan $kegiatan){
        $datas = $request->validate([
            'nama_kegiatan' => 'required|unique:kegiatans,nama_kegiatan,'.$kegiatan->id,
            'tanggal_kegiatan' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_kegiatan',
            'pendaftaran' => ['required',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggalKegiatan = $request->input('tanggal_kegiatan');
                    if ($value >= $tanggalKegiatan) {
                        $fail('Tanggal tutup pendaftaran tidak boleh lewat/sama dengan tanggal kegiatan.');
                    }
                },
            ],
            'anggaran' => 'required',
            'max_partisipasi' => 'required',
            'deskripsi' => 'required',
        ]);
        $datas['anggaran'] = str_replace('.', '', $request->anggaran);
        $datas['slug'] = Str::slug($request->nama_kegiatan,'-');
        $kegiatan->update($datas);
        return redirect('/kegiatan-omk')->with('success', 'Kegiatan berhasil diupdate');
    }
    public function batalKegiatan(Kegiatan $kegiatan){
        $kegiatan->status = 'Dibatalkan';
        $kegiatan->save();
        return redirect('/kegiatan-omk')->with('success', 'Kegiatan berhasil dibatalkan');
    }
}
