<?php

namespace App\Jobs;

use App\Generators\TicketGenerator;
use App\Models\Attendee;
use App\Models\Order;
use App\Services\PDFGenerator\PDFFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateTicket extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Dispatchable;

    /**
     * @var Order $order
     */
    public $order;

    /**
     * @var Attendee $attendee
     */
    public $attendee;

    /**
     * @var PDFFile $pdf_file
     */
    public $pdf_file;

    /**
     * Create a new job instance.
     *
     * @param  Order  $order
     * @param  Attendee  $attendee
     */
    public function __construct(Order $order, Attendee $attendee = null)
    {
        $this->order = $order;
        $this->attendee = $attendee;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->pdf_file = TicketGenerator::createPDFTicket($this->order, $this->attendee);
        $this->pdf_file->error ?: $this->fail();
    }
}
