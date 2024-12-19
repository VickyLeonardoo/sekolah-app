<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    public $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function build()
    {
        return $this->view('mail.notification-mail')
                    ->with([
                        'student_name' => $this->student->name,
                        'student_identity' => $this->student->identity_no,
                    ])
                    ->subject('Pemberitahuan Pembayaran SPP untuk Siswa ' . $this->student->name);
    }
}
