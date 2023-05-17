<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Mail\Mailables\Address;

class testMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $sample_message;
    public $hoge;
    public $boke;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->sample_message = "さんぷるですぜ";
        $this->hoge = "ホゲータ可愛すぎて草";
        $this->boke = "ボケータアホ過ぎて草";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            replyTo: [
                new Address('taylor@example.com', 'Taylor Otwell'),
            ],
            subject: 'Test Mailerだよ～ん',
            tags: ['shipment'],
            metadata: [
                'metameta' => "metaknight",
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sample',
            with: [
                'hoge' => $this->hoge,
                'boke' => $this->boke,
            ],
        );
    }

    /**
     * メッセージヘッダの取得
     *
     * @return \Illuminate\Mail\Mailables\Headers
     */
    public function headers()
    {
        return new Headers(
            messageId: 'custom-message-id@example.com',
            references: ['previous-message@example.com'],
            text: [
                'X-Custom-Header' => 'Custom Value',
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
