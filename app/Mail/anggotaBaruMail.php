<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class anggotaBaruMail extends Mailable
{
    use Queueable, SerializesModels;

    private $nama;
    private $stasi;
    private $email;
    private $waktu;

    public function __construct($nama, $stasi, $email, $waktu)
    {
        $this->nama = $nama;
        $this->stasi = $stasi;
        $this->email = $email;
        $this->waktu = $waktu;
    }

    public function build()
    {
        return $this->subject('Aktivasi Anggota Baru')
            ->view('email.emailAktivasi')
            ->with('nama', $this->nama)
            ->with('stasi', $this->stasi)
            ->with('email', $this->email)
            ->with('waktu', $this->waktu);
    }
}
