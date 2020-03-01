<!DOCTYPE html>
<html>
<head>
    <!-- Keep this page lean as possible.-->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{$order->event->title}}
    </title>
    <style type="text/css">
        body, html {
            width: 100%;
            text-align: center;
            padding: 0;
        }
        p {
            font-family: sans-serif;
            margin: 2px 0;
            color: {{$order->event->ticket_text_color}};
        }
        .small {
            font-size: 10px;
        }
        .ticket {
            width: 95%;
            border: 2px dashed #{{$order->event->ticket_border_color}};
            padding: 10px;
            margin: 40px 0;
            background: #{{$order->event->ticket_bg_color}};
        }
        .ticket:after {
            clear: both;
        }
        .left-col {
            width: 120px;
            float: left;
        }
        .right-col {
            width: 540px;
            float: left;
        }
        .price-container, .event-container {
            background: rgba(255,255,255,0.8);
        }
        .price-container{
            float: right;
            width: 80px;
            margin: 5px;
        }
        .event-container {
            background: rgba(255,255,255,0.8);
            float: left;
            width: 100%;
            margin: 215px 7px 5px 7px;
            text-align: left;
            padding: 0 10px;
        }
        .banner {
            width: 100%;
            height: auto;
        }
        .organiser {
            max-width: 120px;
            max-height: 61px;
            padding: 3px;
            margin: 5px 0;
        }
        .barcode {
            margin: 15px 0;
        }
        .barcode .c39 {
            width: 100px;
            height: auto;
        }
        .ticket-sub-text {
            color: {{$order->event->ticket_sub_text_color}};
        }
        .bottom_info {
            margin-top: 20px;
        }
        a {
            color: #000000 !important;
            text-decoration: none;
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@php
    $ticket_per_page = 3;
    $current_page_tickets = 0;
@endphp

@foreach($order->attendees as $attendee)

<div class="ticket">
    <div class="left-col">
        <img class="organiser" src="{{public_path($order->event->organiser->full_logo_path)}}" alt="">
        <div class="barcode">
            <img src="data:image/svg+xml;base64,{{base64_encode(DNS2D::getBarcodeSVG($attendee->private_reference_number, "QRCODE", 4, 4))}}"/>
            {{-- {!! DNS2D::getBarcodeHTML($attendee->private_reference_number, "QRCODE", 4, 4) !!} --}}
            {{-- <img src="data:image/png;base64,'{{ DNS2D::getBarcodePNG($attendee->private_reference_number, "QRCODE", 4, 4) }}"/> --}}
            @if ($order->event->is_1d_barcode_enabled) {
                {{-- {!! DNS1D::getBarcodeHTML($attendee->private_reference_number, "C39+", 1, 40) !!} --}}
                <img class="c39" src="data:image/svg+xml;base64,{{base64_encode(DNS1D::getBarcodeSVG($attendee->private_reference_number, "C39+", 1, 40, 'black', false))}}"/>
                {{-- <img src="data:image/png;base64,'{{ DNS1D::getBarcodePNG($attendee->private_reference_number, "C39+", 1, 40) }}"/> --}}
            @endif
        </div>
        <p><strong>{{$attendee->reference}}</strong></p>
        <p class="small">{{$order->event->organiser->name}}</p>
        <p class="small">{{$order->event->title}}</p>
        {{-- <p class="small">{{$attendee->private_reference_number}}</p> --}}

    </div>
    <div class="right-col">
        <div class="price-container">
            @php
                $grand_total = $attendee->ticket->total_price;
                $tax_amt = ($grand_total * $order->event->organiser->tax_value) / 100;
                $grand_total = $tax_amt + $grand_total;
            @endphp
            <p class="price">{{money($grand_total, $order->event->currency)}}</p>
        </div>
        <div class="event-container">
            <p class="small">
                <span>{{$attendee->first_name}} {{$attendee->last_name}} &middot;</span>
                <span>{{$attendee->ticket->title}}</span>
            </p>
            <p class="ticket-sub-text small">
                <span>{{$order->event->venue_name}} &middot;</span>
                <span>{{$order->event->startDateFormatted()}} &middot; {{$order->event->endDateFormatted()}}</span>
            </p>

        </div>
        <img class="banner" src="{{$banner}}" alt="">
    </div>
</div>
    @php
        $current_page_tickets++
    @endphp

    @if($current_page_tickets % $ticket_per_page === 0)
        <div class="page-break"></div>
    @endif

@endforeach

<div class="bottom_info">
    {{--Attendize is provided free of charge on the condition the below hyperlink is left in place.--}}
    {{--See https://www.attendize.com/license.html for more information.--}}
    @include('Shared.Partials.PoweredBy')
</div>
</body>
</html>
