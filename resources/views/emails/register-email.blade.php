@extends('emails.layouts.layout')
@section('content')
<div class="x_-1952022034m_1290543836343082458inner-body"  width="600" cellpadding="0" cellspacing="0" style="box-sizing: border-box;background-color: rgb(255,255,255);border-color: rgb(232,229,239);border-radius: 2.0px;border-width: 1.0px;margin: 0 auto;padding: 0;width: 570.0px;">
    <div style="padding: 20px;">
		<p>Hello {{$first_name}},</p>
        <p>Thanks for signing up, we just need you to verify your email address to complete setting up your account.</p>
        <a target="_blank" href="{{ route('frontend.user.verify',['token' => $confirmation_code]) }}" class="f-fallback button button--green" target="_blank" style="color: #FFF; border-color: #22bc66; border-style: solid; border-width: 10px 18px; background-color: #22BC66; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Verify email</a>
	<p>&nbsp;</p>
	<p style="box-sizing: border-box;line-height: 1.5em;margin-top: 0;text-align: left;">Regards,<br>
        {{ Config::get('constants.APP_NAME') }} Team
    </p>
	</div>
</div>
@stop
