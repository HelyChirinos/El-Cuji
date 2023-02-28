<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class CondominioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $attach, $nombre, $mes_ano, $dolar_BCV, $total, $saldo_dolar, $saldo_bs;

    public function __construct($attach, $mes_ano, $nombre, $dolar_BCV, $total)
    {
        $this->attach = $attach;
        $this->nombre = $nombre;
        $this->mes_ano = $mes_ano;
        $this->dolar_BCV = $dolar_BCV;
        $this->total = $total;

    }


    public function envelope()
    {
        return new Envelope(
            subject: 'Relación de Gastos '.$this->mes_ano,
        );
    }


    public function content()
    {
        return new Content(
            view: 'emails.factura_email',           
        );
    }

    public function attachments()
    {
        return [
            Attachment::fromPath($this->attach),
        ];
    }
}
