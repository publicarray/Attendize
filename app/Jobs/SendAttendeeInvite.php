<?php

namespace App\Jobs;

use App\Mailers\AttendeeMailer;
use App\Models\Attendee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAttendeeInvite extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    public $attendee;

    /**
     * Create a new job instance.
     *
     * @param  Attendee  $attendee
     */
    public function __construct(Attendee $attendee)
    {
        $this->attendee = $attendee;
    }

    /**
     * Execute the job.
     *
     * @param  AttendeeMailer  $attendeeMailer
     *
     * @return void
     */
    public function handle(AttendeeMailer $attendeeMailer)
    {
        $this->dispatchNow(new GenerateTicket($this->attendee->order, $this->attendee));
        $attendeeMailer->sendAttendeeInvite($this->attendee);
    }
}
