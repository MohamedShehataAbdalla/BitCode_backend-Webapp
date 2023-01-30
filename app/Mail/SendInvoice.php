<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('تم أنشاء الفاتورة بنجاح')->view('emails.send_invoice')
        ->attach(public_path('storage/uploads/invoices/'.$this->invoice->id.'/').$this->invoice->id.'.pdf')
        ->wiht(['invoice' => $this->invoice ]);
    }
}
