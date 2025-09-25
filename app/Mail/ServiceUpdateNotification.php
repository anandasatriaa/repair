<?php

namespace App\Mail;

use App\Models\ProductService;
use App\Models\SparePart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceUpdateNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $service;
    public $updateType;
    public $sparePart; // Bisa null

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProductService $service, string $updateType, SparePart $sparePart = null)
    {
        $this->service = $service;
        $this->updateType = $updateType;
        $this->sparePart = $sparePart;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notifikasi Update Service: ' . $this->updateType,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.service_update',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
