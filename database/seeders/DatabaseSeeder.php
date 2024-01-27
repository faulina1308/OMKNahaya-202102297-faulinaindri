<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\Stasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Stasi::create([
            'nama_stasi' => 'Nahaya',
            'slug' => 'nahaya'
        ]);
        Stasi::create([
            'nama_stasi' => 'Pontianak',
            'slug' => 'pontianak'
        ]);
        Stasi::create([
            'nama_stasi' => 'Sebua',
            'slug' => 'sebua'
        ]);
        User::create([
            'nama' => 'Faulina Indri',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => now(),
            'alamat' => 'Sebua',
            'no_telepon' => '081251213356',
            'stasi_id' => 3,
            'email' => 'indrifaulina17@gmail.com',
            'keanggotaan' => 'Aktif',
            'tanggal_bergabung' => now(),
            'password' => bcrypt('12345678'),
            'peran' => 'KetuaOMK',
            'akun_aktif' => true
        ]);
        User::create([
            'nama' => 'Only One',
            'jenis_kelamin' => 'Laki-Laki',
            'tanggal_lahir' => now(),
            'alamat' => 'Sanggau Ledo',
            'no_telepon' => '0895377343571',
            'stasi_id' => 1,
            'email' => 'onlyone08482@gmail.com',
            'tanggal_bergabung' => now(),
            'password' => bcrypt('12345678'),
            'peran' => 'KetuaStasi',
            'akun_aktif' => true
        ]);
        User::factory()->count(50)->create();
        Kegiatan::create([
            'nama_kegiatan' => 'EKM',
            'slug' => 'ekm',
            'tanggal_kegiatan' => now(),
            'tanggal_selesai' => now(),
            'pendaftaran' => now(),
            'max_partisipasi' => 30,
            'anggaran' => 300000,
            'status' => 'Sedang Berlangsung',
            'deskripsi' => '<p>Bawa Perlengkaoan mandi, baju sendiri, dan jangan lupa keperluan lainnya</p>'
        ]);
        Kegiatan::create([
            'nama_kegiatan' => 'Kunjungan di Bengkayang',
            'slug' => 'kunjungan dibengkayang',
            'tanggal_kegiatan' => now(),
            'tanggal_selesai' => now(),
            'pendaftaran' => now(),
            'max_partisipasi' => 30,
            'anggaran' => 300000,
            'status' => 'Sedang Berlangsung',
            'deskripsi' => '<p>Bawa Perlengkaoan mandi, baju sendiri, dan jangan lupa keperluan lainnya</p>'
        ]);
        Absensi::factory()->count(40)->create();
    }
}
