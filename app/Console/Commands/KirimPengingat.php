<?php

namespace App\Console\Commands;

use App\Jobs\pengingatJob;
use App\Models\Kegiatan;
use Illuminate\Console\Command;
use Carbon\Carbon;

class KirimPengingat extends Command
{
    protected $signature = 'app:kirim-pengingat';
    protected $description = 'Kirim Pengingat';
    public function __construct(){
        parent::__construct();
    }
    public function handle(){
        $kegiatans = Kegiatan::where('status','Pendaftaran')
            ->with('absensi','absensi.user')
            ->get();
        $tomorrow = now()->addDay()->format('Y-m-d');
        foreach ($kegiatans as $kegiatan) {
            if ($tomorrow == $kegiatan->tanggal_kegiatan) {
                foreach ($kegiatan->absensi as $dataTest) {
                    dispatch(new pengingatJob($dataTest->user->nama, $dataTest->user->email, $kegiatan->nama_kegiatan, $kegiatan->deskripsi));
                }
            }
        }
        $this->info('Pengingat berhasil dikirim');
    }
}
