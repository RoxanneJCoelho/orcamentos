<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($pdf, $name)
    {
        $this->pdf = $pdf;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Segue o seu Orçamento')
            ->view('budget.form')
            ->attachData(
                $this->pdfContent, 'pdf.orcamento.pdf', [
                'mime' => 'application/pdf',
            ]);
    }



}
