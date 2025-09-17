<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as Dompdf;

class PDFController extends Controller
{
    // Generate/find and download PDF for a participant in an event
    // public function certificateDownload(Event $event, Participant $participant)
    // {
    //     if (! $event->participants()->whereKey($participant->id)->exists()) {
    //         abort(403, 'Participante não está vinculado a este evento.');
    //     }

    //     $certificate = Certificate::firstOrCreate(
    //         ['event_id' => $event->id, 'participant_id' => $participant->id],
    //         ['ref' => strtoupper(Str::random(12)), 'issued_at' => now()]
    //     );

    //     $data = [
    //         'name' => $participant->name,
    //         'course' => $event->title,
    //         'date' => $event->end_at->format('d/m/Y'),
    //         'ref' => $certificate->ref,
    //     ];

    //     $pdf = Dompdf::loadView('certificates.pdf', $data)->output();

    //     return response()->streamDownload(
    //         fn() => print($pdf),
    //         "certificate-{$participant->name}.pdf"
    //     );
    // }

    public function downloadBudget () {
        $pdf = Dompdf::loadView('budget.form');
        return $pdf->download('budget.pdf');
    }

    public function sendBudget() {
        $pdf = Pdf::loadView('budget.form', [
            'data' => $dataOfBudget
        ]);

        $pdfContent = $pdf->output();

        Mail::to('client@example.com')->send(new BudgetMail($pdfContent));

        return "PDF sent to your email";
    }

    public function sendCertificate(Request $request)
    {
        $data = $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $participant = Participant::findOrFail($data['participant_id']);
        $event = Event::findOrFail($data['event_id']);

        // Create or get existing certificate
        $certificate = Certificate::firstOrCreate(
            ['event_id' => $event->id, 'participant_id' => $participant->id],
            ['ref' => strtoupper(Str::random(12)), 'issued_at' => now()]
        );

        $pdfData = [
            'name' => $participant->name,
            'course' => $event->title,
            'date' => $event->end_at->format('d/m/Y'),
            'ref' => $certificate->ref,
        ];

        $pdf = Dompdf::loadView('certificates.pdf', $pdfData)->output();

        Mail::to($participant->email)->send(new CertificateMail($pdf, $participant->name));

        return back()->with('success', 'Certificado enviado com sucesso para ' . $participant->email);
    }

    // Do a loop on the previous function and
    // send a certificate by email to each and all participants in the event
    // (there is a different, specific route do call for it)
    // public function sendAll(Event $event)
    // {
    //     $participants = $event->participants;

    //     if ($participants->isEmpty()) {
    //         return back()->with('error', 'Não há participantes para este evento.');
    //     }

    //     foreach ($participants as $participant) {
    //         // tries to find an existing certificate for the participant. If it cant find one, creates one
    //         $certificate = Certificate::firstOrCreate(
    //             ['event_id' => $event->id, 'participant_id' => $participant->id],
    //             ['ref' => strtoupper(Str::random(12)), 'issued_at' => now()]
    //         );

    //         // Data for the PDF
    //         $pdfData = [
    //             'name'  => $participant->name,
    //             'course'=> $event->title,
    //             'date'  => $event->end_at->format('d/m/Y'),
    //             'ref'   => $certificate->ref,
    //         ];

    //         // Generate PDF
    //         $pdf = Dompdf::loadView('certificates.pdf', $pdfData)->output();

    //         // Send email if participant has a valid email
    //         if (!empty($participant->email)) {
    //             Mail::to($participant->email)->send(new CertificateMail($pdf, $participant->name));
    //         }
    //     }

    //     return back()->with('success', 'Certificados enviados com sucesso para todos os participantes.');
    // }
}
