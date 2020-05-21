<?php

namespace App\Mailers;

use App\Generators\TicketGenerator;
use App\Mail\SendAttendeeInvite;
use App\Mail\SendOrderTickets;
use App\Models\Order;
use App\Services\Order as OrderService;
use Illuminate\Mail\Mailable;
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
        $orderService = new OrderService($order->amount, $order->organiser_booking_fee, $order->event);
        $orderService->calculateFinalCosts();

        Mail::send(
            'Emails.OrderNotification',
            [
                'order'        => $order,
                'orderService' => $orderService
            ],
            static function (Mailable $message) use ($order) {
                $message->to($order->account->email)
                    ->subject(
                        trans(
                            'Controllers.new_order_received',
                            [
                                'event' => $order->event->title,
                                'order' => $order->order_reference
                            ]
                        )
                    );
            }
        );
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
