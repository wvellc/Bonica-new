<?php
return [
	'APP_URL'  => env('APP_URL'),

	'APP_NAME' => env('APP_NAME'),
	'DISK' => env('FILESYSTEM_DRIVER'),
    'APP_EMAIL' => 'hiteshwvelabs@gmail.com',  /* hiteshwvelabs@gmail.com*/

    'META_TITLE'  => "LATEST COLLECTION",
    'META_KEYWORDS'  => "LATEST | COLLECTION",
    'META_DESCRIPTION'  => "LATEST COLLECTION Lab Grown Diamonds Stunning selection and the option to choose from a wide range of diamondContinue Reading 'Bonica Jewels'",


    'RAZORPAY_ID'  => env('RAZORPAYID'),
    'RAZORPAY_KEY'  => env('RAZORPAYKEY'),

    /* role id */
	'ROLE_USER' => 'User',


    'ROLE_USER_ID' => 1,

	/* End role id */

	'STRIPE_KEY' => env('STRIPE_KEY','pk_test_51JGK2bSJXJEx1lX2BTftuD2oOETHxkSYtKpakP89YKuYqDhjglJOSdOCF5Jepm519xnR2XDhGEJuSGCV9l72L84b00jwJHOswg'),
    'STRIPE_SECRET' => env('STRIPE_SECRET','sk_test_51JGK2bSJXJEx1lX2aBixhkR9lXhCaW65brE4NpsR5kY932NId2Cu6oUyMog5noLRG4ZBVHDq35QFiPlHdECILDUF001h7EUXe3'),
    'STRIPE_EXPRESS_LINK' => env('STRIPE_EXPRESS_URL').'?client_id='.env('STRIPE_CLIENT_ID').'&'. env('STRIPE_REDIRECT_URL').'&stripe_user[business_type]=individual&state=',
    'STRIPE_AUTH' => env('STRIPE_AUTH'),

    'PAYMENT_SUCCESS_URL' => env('PAYMENT_SUCCESS_URL'),
    'PAYMENT_FAILURE_URL' => env('PAYMENT_FAILURE_URL'),


]
?>
