<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Services\Order as OrderService;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order
     *
     * @var Order
     */
    public $order;

    /**
     * order service containing the cost calculations
     *
     * @var OrderService
     */
    public $orderService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->orderService = new OrderService($this->order->amount, $this->order->organiser_booking_fee, $this->order->event);

        $this->orderService->calculateFinalCosts();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Emails.OrderNotification')
                    ->subject(trans('Controllers.new_order_received', [
                                'event' => $this->order->event->title,
                                'order' => $this->order->order_reference])
                            );
    }
}
