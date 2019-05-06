<style type="text/css">
    .page-break {
      page-break-after: always;
    }

    .ticket {
        border-color: {{$event->ticket_border_color}};
        background: {{$event->ticket_bg_color}};
        color: {{$event->ticket_text_color}};
        margin-bottom: 20px;
        border: 1px dashed #ccc;
    }

    .ticket strong, h1, h2 {
        color: {{$event->ticket_sub_text_color}};
    }

    .ticket-checkin {
        border-color: {{$event->ticket_border_color}};
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
        padding: 0 5px;
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


        <div class="ticket">
            <div class="ticket-checkin">
                <h3>@lang("Ticket.demo_order_ref")</h3>
                <img class="qrcode" alt="QR Code" width="130" height="130" src="data:image/png;base64,{!! DNS2D::getBarcodePNG('hello', "QRCODE", 6, 6) !!}"/>

                <h4>@lang("Ticket.demo_attendee_ref")</h4>

                @if($event->is_1d_barcode_enabled)
                    <img alt="Barcode" width="130" src="data:image/png;base64,{!! DNS1D::getBarcodePNG(12211221, "C39+", 1, 50) !!}"/>
                @endif

                <div class="organiser_info">
                    <p><strong>@lang("Ticket.organiser"):</strong> @lang("Ticket.demo_organiser")</p>
                    {!! HTML::image(asset($image_path)) !!}
                </div>
            </div>

            <div class="ticket-content">
                <div class="ticket-box">
                    <h1>@lang("Ticket.demo_event")</h1>
                    <div class="ticket-box-col">
                        <ul class="ticket-info">
                            <li class="venue_col">
                                <strong>@lang("Ticket.venue")</strong>
                                @lang("Ticket.demo_venue")
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.start_date_time")</strong>
                                @lang("Ticket.demo_start_date_time")
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.end_date_time")</strong>
                                @lang("Ticket.demo_end_date_time")
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.name")</strong>
                                @lang("Ticket.demo_name")
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.ticket_type")</strong>
                                @lang("Ticket.demo_ticket_type")
                            </li>
                            <li class="venue_col">
                                <strong>@lang("Ticket.price")</strong>
                                @lang("Ticket.demo_price")
                            </li>
                        </ul>
                    </div>
                    <div class="ticket-box-col">
                            {!! HTML::image(asset($image_path)) !!}
                            <img class="ticket-image" src=""/>
                    </div>
                </div>
            </div>
        </div>

<div class="bottom_info">
    {{--Attendize is provided free of charge on the condition the below hyperlink is left in place.--}}
    {{--See https://www.attendize.com/license.html for more information.--}}
    @include('Shared.Partials.PoweredBy')
</div>
