<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class pengingatMail extends Mailable
{
    use Queueable, SerializesModels;

    private $nama;
    private $kegiatan;
    private $deskripsi;

    public function __construct($nama, $kegiatan, $deskripsi)
    {
        $this->nama = $nama;
        $this->kegiatan = $kegiatan;
        $this->deskripsi = $deskripsi;
    }

    public function build()
    {
        return $this->subject('Pengingat Kegiatan')
            ->view('email.emailPengingat')
            ->with('nama', $this->nama)
            ->with('kegiatan', $this->kegiatan)
            ->with('deskripsi', $this->deskripsi);
    }
}
