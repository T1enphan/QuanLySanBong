<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KichHoatTaiKhoanMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Kích Hoạt Tài Khoản')
                    ->view('user.page.mail.mailDangKy', [
                        'data'   => $this->data,
                    ]);
    }


}
