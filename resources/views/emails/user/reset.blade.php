@extends('emails.layouts.layout')
@section('content')
<table class="x_-1952022034m_1290543836343082458inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box;background-color: rgb(255,255,255);border-color: rgb(232,229,239);border-radius: 2.0px;border-width: 1.0px;margin: 0 auto;padding: 0;width: 570.0px;">
	<tbody>
		<tr>
			<td style="box-sizing: border-box;padding: 32.0px;">
				<h1 style="box-sizing: border-box;color: rgb(61,72,82);font-size: 18.0px;font-weight: bold;margin-top: 0;text-align: left;">Hello!</h1>
				<p style="box-sizing: border-box;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">You are receiving this email because we received a password reset request for your account.</p>
				<table align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;margin: 30.0px auto;padding: 0;text-align: center;width: 100.0%;">
					<tbody>
						<tr>
							<td align="center" style="box-sizing: border-box;">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="box-sizing: border-box;">
									<tbody>
										<tr>
											<td align="center" style="box-sizing: border-box;">
												<table border="0" cellpadding="0" cellspacing="0" style="box-sizing: border-box;">
													<tbody>
														<tr>
															<td style="box-sizing: border-box;">
																<a href="{{ route('admin.password.reset', $token) }}" class="x_-1952022034m_1290543836343082458button" style="box-sizing: border-box;border-radius: 4.0px;color: #FFFFFF;display: inline-block;overflow: hidden;text-decoration: none;background-color: #c36d5f;border-bottom: 8.0px solid #c36d5f;border-left: 18.0px solid #c36d5f;border-right: 18.0px solid #c36d5f;border-top: 8.0px solid #c36d5f;" target="_blank">Reset Password</a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<p style="box-sizing: border-box;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">This password reset link will expire in 60 minutes.</p>
				<p style="box-sizing: border-box;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">If you did not request a password reset, no further action is required.</p>
				<p style="box-sizing: border-box;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">Regards,<br>
					Bonica Team
				</p>
				<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;border-top: 1.0px solid rgb(232,229,239);margin-top: 25.0px;padding-top: 25.0px;">
					<tbody>
						<tr>
							<td style="box-sizing: border-box;">
								<p style="box-sizing: border-box;line-height: 1.5em;margin-top: 0;text-align: left;font-size: 14.0px;">If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below
									into your web browser: <span style="box-sizing: border-box;"><a href="{{ route('admin.password.reset', $token) }}" style="box-sizing: border-box;color: rgb(56,105,212);" target="_blank">{!! route('admin.password.reset', $token) !!}</a></span>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
@stop
