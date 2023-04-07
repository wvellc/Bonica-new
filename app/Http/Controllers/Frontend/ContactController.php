<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use App\Jobs\SendEmail;
use App\Commonhelper;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
	{

	}
    public function contactSave(ContactRequest $request)
    {
        $input = $request->only(['name', 'email', 'mobile', 'message']);
        $input['ip_address'] = request()->ip();
        $data  = Contact::create($input);

        //$data = $data->toArray();
        //$data['messages'] = $data['message'];
        /*Send To admin with Contact Form Details*/
        //SendEmail::dispatch(trim(Config::get('constants.APP_EMAIL')),$data,'emails.contactForm','New Contact');

        /*Send To customer with thank you message*/
       /*  $data = array('email_content' => '
            <p>Hello '.$data['name'].',</p>
            <p>Thank you for contacting us, We have received your enquiry and will respond to you as soon.</p>');
        SendEmail::dispatch(trim($request->email),$data,'emails.common-email-layout',' Thank you for contacting us'); */

        //return redirect()->route('frontend.appointment')->with('success', __('messages.enquiry_fprm_message', []));
        return response(['status' => 'success']);
    }
}
