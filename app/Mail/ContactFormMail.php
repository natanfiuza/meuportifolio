<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address; // Para o remetente e destinatário


class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData; // Propriedade pública para passar os dados para a view do e-mail

    /**
     * Create a new message instance.
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->formData['email'], $this->formData['name']), // O e-mail e nome de quem preencheu o formulário
            replyTo: [                                                            // Para que você possa responder diretamente para quem enviou
                new Address($this->formData['email'], $this->formData['name']),
            ],
            subject: 'Nova Mensagem de Contato - ' . $this->formData['subject'],
        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Usaremos uma view Markdown para o e-mail.
// Os dados em $this->formData estarão disponíveis na view.
        return new Content(
            markdown: 'emails.contact-form',
            with: [ // Opcional: se quiser passar dados de forma mais explícita para a view,
                        // mas as propriedades públicas do Mailable (como $formData) já são passadas automaticamente.
                'data' => $this->formData,
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
