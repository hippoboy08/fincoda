<?php

return [

	/*
		//These are the keys for the local host
   'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6LdhACkTAAAAALMn9JyiGDbcZbAy2O2zILM1YLoD'),
    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6LdhACkTAAAAAI0BdvIBXfX93h6ew8JS_otZ4KvW'),

		//These are the keys for the remote server
	'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6Lf6gikTAAAAAHokO4LZte_v3_isLrjKGPnaqPlt'),
    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6Lf6gikTAAAAAEhMV9VTPU1oEUkFCPDzathXwK9o'),
	
	*/


    /*
    |--------------------------------------------------------------------------
    | API Keys
    |--------------------------------------------------------------------------
    |
    | Set the public and private API keys as provided by reCAPTCHA.
    |
    | In version 2 of reCAPTCHA, public_key is the Site key,
    | and private_key is the Secret key.
    |
    */
	//These are the keys for the remote server
	'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6Lf6gikTAAAAAHokO4LZte_v3_isLrjKGPnaqPlt'),
    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6Lf6gikTAAAAAEhMV9VTPU1oEUkFCPDzathXwK9o'),


    /*
    |--------------------------------------------------------------------------
    | Template
    |--------------------------------------------------------------------------
    |
    | Set a template to use if you don't want to use the standard one.
    |
    */
    'template'    => '',

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Determine how to call out to get response; values are 'curl' or 'native'.
    | Only applies to v2.
    |
    */
    'driver'      => 'curl',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Various options for the driver
    |
    */
    'options'     => [

        'curl_timeout' => 1,

    ],

    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Set which version of ReCaptcha to use.
    |
    */

    'version'     => 2,

];
