<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateKegiatanStatus extends Command
{
    protected $signature = 'app:update-kegiatan-status';
    protected $description = 'Update status kegiatan';

    public function __construct(){
        parent::__construct();
    }
    
    public function handle(){
        $kegiatans = Kegiatan::all();
        foreach ($kegiatans as $kegiatan) {
            $today = now()->format('Y-m-d');
            if ($today >= $kegiatan->tanggal_kegiatan && $today <= $kegiatan->tanggal_selesai) {
                $kegiatan->status = 'Sedang Berlangsung';
                $kegiatan->save();
            } elseif ($today > $kegiatan->tanggal_selesai) {
                $kegiatan->status = 'Selesai';
                $kegiatan->save();
            } elseif ($today < $kegiatan->tanggal_kegiatan) {
                $kegiatan->status = 'Pendaftaran';
                $kegiatan->save();
            }
            
        }
        $this->info('Status kegiatan telah diperbarui.');
    }
}
