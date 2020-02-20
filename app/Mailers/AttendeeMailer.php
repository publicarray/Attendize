<?php

namespace App\Mailers;

use App\Generators\TicketGenerator;
use App\Mail\SendAttendeeInvite;
use App\Mail\SendAttendeeTicket;
use App\Models\Attendee;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class AttendeeMailer extends Mailer
{

    /**
     * Send the PDF ticket to the attendee
     *
     * @param  Attendee  $attendee
     */
    public function sendAttendeeTicket(Attendee $attendee): void
    {
        Mail::to($attendee->email)->send(new SendAttendeeTicket($attendee));
    }

    /**
     * Sends the attendees a message
     *
     * @param  Message  $message_object
     */
    public function sendMessageToAttendees(Message $message_object)
    {
        $event = $message_object->event;

        $attendees = ($message_object->recipients === 'all')
            ? $event->attendees // all attendees
            : Attendee::where('ticket_id', '=', $message_object->recipients)
                ->where('account_id', '=', $message_object->account_id)
                ->get();

        foreach ($attendees as $attendee) {

            if ($attendee->is_cancelled) {
                continue;
            }

            $data = [
                'attendee'        => $attendee,
                'event'           => $event,
                'message_content' => $message_object->message,
                'subject'         => $message_object->subject,
                'email_logo'      => $attendee->event->organiser->full_logo_path,
            ];

            Mail::send(
                'Emails.messageReceived',
                $data,
                static function (Mailable $message) use ($attendee, $data) {
                    $message->to($attendee->email, $attendee->full_name)
                        ->from(config('attendize.outgoing_email_noreply'), $attendee->event->organiser->name)
                        ->replyTo($attendee->event->organiser->email, $attendee->event->organiser->name)
                        ->subject($data['subject']);
                }
            );
        }

        $message_object->is_sent = 1;
        $message_object->sent_at = Carbon::now();
        $message_object->save();
    }

    /**
     * Send an invitation to attendee
     *
     * @param  Attendee  $attendee
     */
    public function sendAttendeeInvite(Attendee $attendee): void
    {
        Mail::to($attendee->email)->send(new SendAttendeeInvite($attendee));
    }


}
