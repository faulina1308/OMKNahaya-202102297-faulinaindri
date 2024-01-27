<?php

namespace App\Jobs;

use App\Mail\anggotaBaruMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class anggotaBaruJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $nama;
    private $stasi;
    private $email;
    private $emailKetua;
    
    public function __construct($nama, $stasi, $email, $emailKetua)
    {
        $this->nama = $nama;
        $this->stasi = $stasi;
        $this->email = $email;
        $this->emailKetua = $emailKetua;
    }


    public function handle(): void
    {
        $mail = new anggotaBaruMail($this->nama, $this->stasi, $this->email, now());
        Mail::to($this->emailKetua)->queue($mail);
    }
}
