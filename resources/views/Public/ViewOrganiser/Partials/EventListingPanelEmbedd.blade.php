
<div class="row">
    <div class="col-md-12">
        <h1 class="event-listing-heading">{{ $panel_title }}</h1>
        <ul class="event-list">

            @if(count($events))

                @foreach($events->where('is_live', 1) as $event)
                    <li>
                        <time datetime="{{ $event->start_date }}">
                            <span class="day">{{ $event->start_date->format('d') }}</span>
                            <span class="month">{{ explode("|", trans("basic.months_short"))[$event->start_date->format('n')] }}</span>
                            <span class="year">{{ $event->start_date->format('Y') }}</span>
                            <span class="time">{{ $event->start_date->format('h:i') }}</span>
                        </time>
                        <div class="info">
                            <h2 class="title ellipsis">
                               <a href="{{$event->event_url }}">{{ $event->title }}</a>
                               <p class="desc ellipsis">{{ $event->venue_name }}</p>
                            </h2>
                            @if($event->images->count())
                            <a target="_blank" href="{{$event->event_url }}"><img alt="{{ $event->title }}" src="{{ asset($event->images->first()['image_path']) }}"/></a>
                            @else
                            <ul>
                                <li style="width:50%;"><a target="_blank" href="{{$event->event_url }}">@lang("Public_ViewOrganiser.tickets")</a></li>
                                <li style="width:50%;"><a target="_blank" href="{{$event->event_url }}">@lang("Public_ViewOrganiser.information")</a></li>
                            </ul>
                            @endif
                        </div>
                        @if($event->images->count())
                        <ul>
                            <li style="width:50%;"><a target="_blank" href="{{$event->event_url }}">@lang("Public_ViewOrganiser.tickets")</a></li>
                            <li style="width:50%;"><a target="_blank" href="{{$event->event_url }}">@lang("Public_ViewOrganiser.information")</a></li>
                        </ul>
                        @endif
                    </li>
                @endforeach
            @else
                <div class="alert alert-info">
                    @lang("Public_ViewOrganiser.no_events", ["panel_title"=>$panel_title])
                </div>
            @endif

        </ul>
    </div>
</div>
