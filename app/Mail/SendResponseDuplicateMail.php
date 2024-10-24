<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendResponseDuplicateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(private readonly array $quest, private readonly array $answers)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your ' . config('app.name') . ' Form Submission Duplicate',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.response_template',
            with: [
                'quest' => $this->quest,
                'answers' => $this->answers,
            ]
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
