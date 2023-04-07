@extends('emails.layouts.layout')
@section('content')
<div class="x_-1952022034m_1290543836343082458inner-body"  width="600" cellpadding="0" cellspacing="0" style="box-sizing: border-box;background-color: rgb(255,255,255);border-color: rgb(232,229,239);border-radius: 2.0px;border-width: 1.0px;margin: 0 auto;padding: 0;width: 570.0px;">
    <div style="padding: 20px;">
	{!!$email_content !!}
	<p>&nbsp;</p>
	<p style="box-sizing: border-box;line-height: 1.5em;margin-top: 0;text-align: left;">Regards,<br>
        {{ Config::get('constants.APP_NAME') }} Team
    </p>
	</div>
</div>
@stop
