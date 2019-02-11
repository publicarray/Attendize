@extends('Public.ViewOrganiser.Layouts.EmbeddedOrganiserPage')

@section('head')
     <style>
          section#intro {
               background-color: {{$organiser->page_header_bg_color}} !important;
               color: {{$organiser->page_text_color}} !important;
          }
          .event-list > li > time {
               color: {{$organiser->page_text_color}};
               background-color: {{$organiser->page_header_bg_color}};
          }
     </style>
     @if($organiser->google_analytics_code)
          @include('Public.Partials.ga', ['analyticsCode' => $organiser->google_analytics_code])
     @endif
@stop

@section('content')
    <section id="events" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('Public.ViewOrganiser.Partials.EventListingPanelEmbedd',
                [
                    'panel_title' => trans("Public_ViewOrganiser.upcoming_events"),
                    'events'      => $upcoming_events
                ]
            )
            @include('Public.ViewOrganiser.Partials.EventListingPanelEmbedd',
                [
                    'panel_title' => trans("Public_ViewOrganiser.past_events"),
                    'events'      => $past_events
                ]
            )
        </div>
    </div>
</section>
@stop

