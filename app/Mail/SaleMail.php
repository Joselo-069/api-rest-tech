<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SaleMail extends Mailable
{
    use Queueable, SerializesModels;


    public $sale;
    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sale, $products)
    {
        $this->sale = $sale;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tu recibo')
        ->view('emails.saleReceipt')
        ->with([
            'sale' => $this->sale,
            'products' => $this->products,
        ]);
    }
}
