<?php

namespace App\Mailers;

use App\Models\Order;
use Illuminate\Mail\Mailable;
use App\Mail\SendOrderTickets;
use App\Mail\OrderNotification;
use App\Mail\SendAttendeeInvite;
use App\Generators\TicketGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderMailer
{
    /**
     * Send a new-order notification to the organizer
     *
     * @param  Order  $order
     */
    public function sendOrderNotification(Order $order)
    {
        Mail::to($order->account->email)->send(new OrderNotification($order));
    }

    /**
     * Send all PDF tickets to the order owner
     *
     * @param  Order  $order
     */
    public function sendOrderTickets(Order $order)
    {
        Mail::to($order->email)->send(new SendOrderTickets($order));
    }
}
