<?php

return [

    'version' => file_get_contents(base_path('VERSION')),

    'enable_test_payments'         => env('ENABLE_TEST_PAYMENTS', false),
    'enable_dummy_payment_gateway' => false,
    'payment_gateway_dummy'        => 0,
    'payment_gateway_stripe'       => 1,
    'payment_gateway_paypal'       => 2,
    'fake_card_data'               => [
        'number'      => '4242424242424242',
        'expiryMonth' => '6',
        'expiryYear'  => '2030',
        'cvv'         => '123'
    ],
    'outgoing_email_noreply'       => env('MAIL_FROM_ADDRESS'),
    'outgoing_email'               => env('MAIL_FROM_ADDRESS'),
    'outgoing_email_name'          => env('MAIL_FROM_NAME'),
    'incoming_email'               => env('MAIL_FROM_ADDRESS'),

    'app_name'               => 'Attendize Event Ticketing',
    'event_default_bg_color' => '#B23333',
    'event_default_bg_image' => 'assets/images/public/EventPage/backgrounds/5.jpg',

    'event_images_path'      => 'user_content/event_images',
    'organiser_images_path'  => 'user_content/organiser_images',
    'event_pdf_tickets_path' => 'user_content/pdf_tickets',
    'event_bg_images'        => 'assets/images/public/EventPage/backgrounds',

    'fallback_organiser_logo_url' => '/assets/images/logo-dark.png',
    'cdn_url'                     => '',

    'single_organiser_mode' => env('SINGLE_ORGANISER_MODE', false),
    'checkout_timeout_after' => env('CHECKOUT_TIMEOUT_AFTER', 30), #minutes

    'ticket'                   => [
        'image'   => [
            // Default image for Ticket Generator
            'default' => 'assets/images/attendize-ticket-default.jpg',

            // JPG Quality for Ticket Generator
            'quality' => 80
        ],
        'booking' => [
            'fee_fixed'      => 0,
            'fee_percentage' => 0,
        ],
        'status'  => [
            'sold_out'         => 1,
            'after_sale_date'  => 2,
            'before_sale_date' => 3,
            'on_sale'          => 4,
            'off_sale'         => 5,
        ],
    ],

    /* Order statuses */
    'order'                    => [
        'complete'           => 1,
        'refunded'           => 2,
        'partially_refunded' => 3,
        'cancelled'          => 4,
        'awaiting_payment'   => 5,
    ],

    /* Attendee question types */
    'question_textbox_single'  => 1,
    'question_textbox_multi'   => 2,
    'question_dropdown_single' => 3,
    'question_dropdown_multi'  => 4,
    'question_checkbox_multi'  => 5,
    'question_radio_single'    => 6,


    'default_timezone'              => 30, #Europe/Dublin
    'default_currency'              => 2, #Euro
    'default_date_picker_format'    => env('DEFAULT_DATEPICKER_FORMAT', 'yyyy-MM-dd HH:mm'),
    'default_date_picker_seperator' => env('DEFAULT_DATEPICKER_SEPERATOR', '-'),
    'default_datetime_format'       => env('DEFAULT_DATETIME_FORMAT', 'Y-m-d H:i'),
    'default_query_cache'           => 120, #Minutes
    'default_locale'                => 'en',
    'default_payment_gateway'       => 1, #Stripe=1 Paypal=2

    'cdn_bypass'               => env('CDN_BYPASS', false),
    'cdn' => [
        "css|js|eot|woff|ttf" => env('CDN_ASSETS', ''),
        "jpg|jpeg|png|gif|svg|ico" => env('CDN_IMG', ''),
        "pdf" => env('CDN_PDF', ''),
        "" => env('CDN', ''),
    ],

    'google_analytics_id'       => env('GOOGLE_ANALYTICS_ID'),
    'google_maps_geocoding_key' => env('GOOGLE_MAPS_GEOCODING_KEY')
];
