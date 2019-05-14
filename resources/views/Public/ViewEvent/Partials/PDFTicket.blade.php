<!DOCTYPE html>
<html>
<head>
    <!-- Keep this page lean as possible.-->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Ticket(s)</title>
    <style type="text/css">
        .page-break {
          page-break-after: always;
        }

        .ticket {
            border-color: {{$event->ticket_border_color}}  !important;
            background: {{$event->ticket_bg_color}}  !important;
            color: {{$event->ticket_text_color}}  !important;
            margin-bottom: 20px;
            border: 1px dashed #ccc;
        }

        .ticket-checkin {
            border-color: {{$event->ticket_border_color}}  !important;
        }

        .ticket-content .ticket-box .ticket-box-col ul li:first-child {
            border-color: {{$event->ticket_border_color}}  !important;
        }

        .ticket-content .ticket-box .ticket-box-col ul li {
            border-color: {{$event->ticket_border_color}}  !important;
        }

        .ticket-content .ticket-box .ticket-box-col ul li strong {
            color: {{$event->ticket_sub_text_color}}  !important;
        }

        .ticket-checkin {
            display: inline-block;
            width: 20%;
            vertical-align: top;
            text-align: center;
            padding: 2px 15px;
            border-right: 5px dashed #cecece;
        }
        .ticket-checkin img {
            width: 130px;
        }

        .ticket-content {
            display: inline-block;
            width: 73%;
            vertical-align: top;
        }

        .ticket-box-col {
            display: inline-block;
            width: 48%;
            vertical-align: top;
            padding: 0 0.4%;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        body {
            font-family: Helavista, sans-serif;
        }

        h1 {
            text-align: center;
            text-transform: uppercase;
            padding: 0 0 20px;
            margin: 0;
            /*text-overflow: ellipsis;*/
            /*white-space: nowrap;*/
            /*overflow: hidden;*/
        }

        h3 {
            font-size: 0.8em;
            padding: 3%;
            margin: 0;
        }

        h4 {
            font-size: 0.7em;
            padding: 1%;
            margin: 0;
        }
        .ticket-content .ticket-box .ticket-box-col ul {
          margin: 0;
          padding: 0;
          font-size: 1em;
        }

        .ticket-content .ticket-box .ticket-box-col ul li:first-child {
          border-top: 1px solid #cecece;
        }

        .ticket-content .ticket-box .ticket-box-col ul li {
          padding: 5px 0;
          list-style: none;
          border-bottom: 1px solid #cecece;
        }

        .bottom_info {
          margin-top: 10px;
          text-align: center;
          width: 100%;
          font-size: small;
        }

        .bottom_info a {
          color: #000 !important;
          text-decoration: none;
          font-weight: bold;
        }
    </style>
</head>
<body>

@php
    $ticket_per_page = 2;
    $current_page_tickets = 0;
@endphp

@foreach($attendees as $attendee)
    @if(!$attendee->is_cancelled)
        <div class="ticket">
            <div class="ticket-checkin">
                <h3>{{$order->order_reference}}</h3>
                <img class="qrcode" alt="QR Code" width="130" height="130" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($attendee->private_reference_number, "QRCODE", 6, 6) !!}"
                    />

                <h4>{{$attendee->reference}}</h4>

                @if($event->is_1d_barcode_enabled)
                    <img alt="Barcode" width="130" src="data:image/png;base64,{!! DNS1D::getBarcodePNG($attendee->private_reference_number, "C39+", 1, 50) !!}"/>
                @endif

                <div class="organiser_info">
                    <p><strong>@lang("Ticket.organiser"):</strong> {{$event->organiser->name}}</p>
                    <img class="organiser_logo" alt="{{$event->organiser->full_logo_path}}" src="data:image/png;base64,{{$image}}"/>
                </div>
            </div>

            <div class="ticket-content">
                <div class="ticket-box">
                    <h1>{{$event->title}}</h1>
                    <div class="ticket-box-col">
                        <ul class="ticket-info">
                            <li class="venue_col">
                                <strong>@lang("Ticket.venue")</strong>
                                {{$event->venue_name}}
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.start_date_time")</strong>
                                {{$event->startDateFormatted()}}
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.end_date_time")</strong>
                                {{$event->endDateFormatted()}}
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.name")</strong>
                                {{$attendee->first_name.' '.$attendee->last_name}}
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.ticket_type")</strong>
                                {{$attendee->ticket->title}}
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.price")</strong>
                                @php
                                    // Calculating grand total including tax
                                    $grand_total = $attendee->ticket->total_price;
                                    $tax_amt = ($grand_total * $event->organiser->tax_value) / 100;
                                    $grand_total = $tax_amt + $grand_total;
                                @endphp
                                {{money($grand_total, $order->event->currency)}}
                            </li>
                        </ul>
                    </div>
                    <div class="ticket-box-col">
                        @if(isset($images) && count($images) > 0)
                            @foreach($images as $img)
                                <img class="ticket-image" src="data:image/png;base64,{{$img}}"/>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($current_page_tickets % 2)
            <div class="page-break"></div>
        @endif

        @php
            $current_page_tickets++
        @endphp
    @endif
@endforeach

</body>
</html>

