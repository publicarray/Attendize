<div role="dialog"  class="modal fade " style="display: none;">
   {!! Form::model($attendee, array('url' => route('postCancelAttendee', array('event_id' => $event->id, 'attendee_id' => $attendee->id)), 'class' => 'ajax')) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-cancel"></i>
                    @lang("ManageEvent.cancel_attendee_title") <b>{{$attendee->full_name}}</b></h3>
            </div>
            <div class="modal-body">
                <p>
                    @lang("ManageEvent.cancel_description")
                </p>

                <p>
                    {!! @trans("ManageEvent.cancel_refund", ["url"=>route('showEventOrders', ['event_id' => $attendee->event->id, 'q' => $attendee->order->order_reference])]) !!}
                </p>
                <br>
                <div class="form-group">
                    <div class="checkbox custom-checkbox">
                        <input type="checkbox" name="notify_attendee" id="notify_attendee" value="1">
                        <label for="notify_attendee">@lang("ManageEvent.cancel_notify_p1") <b>{{$attendee->full_name }}</b>@lang("ManageEvent.cancel_notify_p2")</label>
                    </div>
                </div>
                @if(config('attendize.default_payment_gateway') == config('attendize.payment_gateway_stripe'))
                    <div class="form-group">
                            <div class="checkbox custom-checkbox">
                                <input type="checkbox" name="refund_attendee" id="refund_attendee" value="1">
                                <label for="refund_attendee">@lang("ManageEvent.cancel_refund_user_p1") <b>{{ $attendee->full_name }}</b> @lang("ManageEvent.cancel_refund_user_p2")</label>
                            </div>
                    </div>
                @endif
            </div> <!-- /end modal body-->
            <div class="modal-footer">
               {!! Form::hidden('attendee_id', $attendee->id) !!}
               {!! Form::button(trans("basic.cancel"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
               {!! Form::submit(trans("ManageEvent.confirm_cancel"), ['class'=>"btn btn-success"]) !!}
            </div>
        </div><!-- /end modal content-->
       {!! Form::close() !!}
    </div>
</div>

