@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
    @lang("Installer.title")
@stop
@section('content')
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        <img src="{{cdn('/assets/images/logo-dark.png')}}" alt="">
                    </div>

                    <h1>@lang("Installer.setup_completed")</h1>
                    <p>{!! @trans("Installer.setup_completed_already_message") !!}</p>
                </div>
            </div>
        </div>
    </div>
@stop
