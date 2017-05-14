<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        //

        $this->order=$post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('example@example.com')->view('emails.orders.shipped',['post'=>$this->order]);

    }
}
