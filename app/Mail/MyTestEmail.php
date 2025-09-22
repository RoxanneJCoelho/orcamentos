<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $name;
    public $pdfName='Orçamento';

    /**
     * Create a new message instance.
     */
    public function __construct( $pdf, $name)
    {
        $this->pdf = $pdf;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'O seu Orçamento está pronto',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.email',
        );
    }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [Attachment::fromData(fn () => $this->pdf, "Pdf-name.pdf")];
    // }

    public function build()
    {
        return $this->subject('O seu Orçamento está pronto')
            ->view('pdf.orcamento')
            ->with([
                'name' => $this->name,
            ])
            ->attachData(
                $this->pdf, "{$this->pdfName}.pdf", [
                'mime' => 'application/pdf',
            ]);
    }
}
