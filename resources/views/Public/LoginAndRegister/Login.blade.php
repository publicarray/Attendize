@extends('Shared.Layouts.MasterWithoutMenus')

@section('title', trans("User.login"))

@section('content')
    {!! Form::open(['url' => route("login"), 'id' => 'login-form']) !!}
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        {!!Html::image('assets/images/logo-dark.png')!!}
                    </div>

                    @if(Session::has('failed'))
                        <h4 class="text-danger mt0">@lang("basic.whoops")! </h4>
                        <ul class="list-group">
                            <li class="list-group-item">@lang("User.login_fail_msg")</li>
                        </ul>
                    @endif

                    <div class="form-group">
                        {!! Form::label('email', trans("User.email"), ['class' => 'control-label']) !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'autofocus' => true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', trans("User.password"), ['class' => 'control-label']) !!}
                        (<a class="forgotPassword" href="{{route('forgotPassword')}}" tabindex="-1">@lang("User.forgot_password?")</a>)
                        {!! Form::password('password',  ['class' => 'form-control']) !!}
                    </div>
                    @if(config('attendize.recaptcha_site'))
                        <input id="captcha" type="hidden" name="grecaptcha">
                        <script src="https://www.recaptcha.net/recaptcha/api.js?render={{config('attendize.recaptcha_site')}}"></script>
                        <script>
                        grecaptcha.ready(function() {
                            grecaptcha.execute('{{config('attendize.recaptcha_site')}}', {action: 'login'}).then(function(token) {
                                document.getElementById('captcha').value = token
                            });
                        });
                        </script>
                    @endif
                    <div class="form-group">
                        @if(config('attendize.hcaptcha_site_key'))
                            <script src="https://hcaptcha.com/1/api.js" async defer></script>
                            <button type="submit" class="btn btn-block btn-success h-captcha" data-sitekey="{{config('attendize.hcaptcha_site_key')}}" data-callback="onSubmit">@lang("User.login")</button>
                            <script type="text/javascript">
                               function onSubmit(token) {
                                  document.getElementById("login-form").submit();
                               };
                            </script>
                            <br>
                            This site is protected by hCaptcha and its <a href="https://hcaptcha.com/privacy">Privacy Policy</a> and <a href="https://hcaptcha.com/terms">Terms of Service</a> apply.
                        @else
                            <button type="submit" class="btn btn-block btn-success">@lang("User.login")</button>
                        @endif
                    </div>

                    @if(Utils::isAttendize())
                    <div class="signup">
                        <span>@lang("User.dont_have_account_button", ["url"=> route('showSignup')])</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
