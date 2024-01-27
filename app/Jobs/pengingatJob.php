<?php

namespace App\Jobs;

use App\Mail\pengingatMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class pengingatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $nama;
    private $email;
    private $kegiatan;
    private $deskripsi;

    public function __construct($nama, $email, $kegiatan,$deskripsi)
    {
        $this->nama = $nama;
        $this->email = $email;
        $this->kegiatan = $kegiatan;
        $this->deskripsi = $deskripsi;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail = new pengingatMail($this->nama, $this->kegiatan, $this->deskripsi);
        Mail::to($this->email)->queue($mail);
    }
}
