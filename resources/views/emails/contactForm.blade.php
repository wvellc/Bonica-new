@extends('emails.layouts.layout')
@section('content')
<table class="x_-1952022034m_1290543836343082458inner-body" align="center" width="600" cellpadding="0" cellspacing="0" style="box-sizing: border-box;background-color: rgb(255,255,255);border-color: rgb(232,229,239);border-radius: 2.0px;border-width: 1.0px;margin: 0 auto;padding: 0;width: 570.0px;">
	<tbody>
		<tr>
			<td style="box-sizing: border-box;padding: 32.0px;">
				<h1 style="box-sizing: border-box;color: rgb(61,72,82);font-size: 18.0px;font-weight: bold;margin-top: 0;text-align: left;">Following is contact details</h1>
			</td>
		</tr>
	</tbody>
</table>
<table class="x_-1952022034m_1290543836343082458inner-body" align="center" width="600" cellpadding="0" cellspacing="0" style="box-sizing: border-box;background-color: rgb(255,255,255);border-color: rgb(232,229,239);border-radius: 2.0px;border-width: 1.0px;margin: 0 auto;padding: 0;width: 570.0px;font-size: 14px;">
	<tbody>		
		<tr>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				<b>Name</b>
			</td>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				{{$name}}
			</td>
		</tr>
		<tr>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				<b>Email</b>
			</td>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				{{$email}}
			</td>
		</tr>
		<tr>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				<b>Reason</b>
			</td>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				{{$reason}}
			</td>
		</tr>
		<tr>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				<b>Subject</b>
			</td>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				{{$subject}}
			</td>
		</tr>
		<tr>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				<b>Message</b>
			</td>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				{{$messages}}
			</td>
		</tr>
		<tr>
			<td style="box-sizing: border-box;padding-left:32px;padding-bottom: 15px">
				<p style="box-sizing: border-box;line-height: 1.5em;margin-top: 0;text-align: left;">Regards,<br>
					{{ Config::get('constants.APP_NAME') }} Team
				</p>
			</td>
		</tr>
	</tbody>
</table>
@stop