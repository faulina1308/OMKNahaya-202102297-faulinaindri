<?php

namespace App\Http\Controllers;

use App\Models\Stasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StasiController extends Controller
{
    public function index(){
        return view('Base.semuaStasi', [
            'judul' => 'Stasi',
            'page' => 'List Stasi',
            'user' => Auth::user(),
            'dataStasi' => Stasi::withCount(['user' => function ($query) {
                $query->where('akun_aktif', 1);}])
                ->get(),
            'ketuaStasi' => User::where('peran','KetuaStasi')
                ->get()
        ]);
    }
    public function editStasi(Request $request, Stasi $stasi){
        $datas = $request->validate([
            'nama_stasi' => 'required|unique:stasis,nama_stasi,'.$stasi->id,
        ]);
        $datas['slug'] = Str::slug($request->nama_stasi,'-');
        $stasi->update($datas);
        return redirect('/stasi-view')->with('success', 'Stasi berhasil diupdate');
    }
    public function tambahStasi(Request $request){
        $datas = $request->validate([
            'nama_stasi' => 'required|unique:stasis'
        ]);
        $datas['slug'] = Str::slug($request->nama_stasi,'-');
        Stasi::create($datas);
        return redirect('/stasi-view')->with('success', 'Stasi '.$request->nama_stasi.' berhasil ditambahkan');
    }
}
