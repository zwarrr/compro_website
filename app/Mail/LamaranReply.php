<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LamaranReply extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $nama;
    public $perusahaan;
    public $tanggal;
    public $catatan;

    /**
     * Create a new message instance.
     */
    public function __construct($nama, $perusahaan, $tanggal, $catatan)
    {
        $this->nama = $nama;
        $this->perusahaan = $perusahaan;
        $this->tanggal = $tanggal;
        $this->catatan = $catatan;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Undangan Interview dari ' . $this->perusahaan)
                    ->view('emails.lamaran_reply')
                    ->with([
                        'nama' => $this->nama,
                        'perusahaan' => $this->perusahaan,
                        'tanggal' => $this->tanggal,
                        'catatan' => $this->catatan,
                    ]);
    }
}
