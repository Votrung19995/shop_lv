<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Bill;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $bill;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Thông tin đơn đặt hàng số #ĐHMS'.$this->bill->id)->markdown('mail')->with('bill', $this->bill);
    }
}
