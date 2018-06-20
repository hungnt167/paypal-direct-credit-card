<?php

// Set sandbox (test mode) to true/false.
$sandbox = TRUE;
 
// Set PayPal API version and credentials.
$api_version = '85.0';
$api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
$api_username = $sandbox ? 'Demo-facilitator_api1.outlook.com' : 'LIVE_USERNAME_GOES_HERE';
$api_password = $sandbox ? 'PDRdd9FTWWU6FDBNKY' : 'LIVE_PASSWORD_GOES_HERE';
$api_signature = $sandbox ? 'ANGx9dddfhOMduIxwcbkuUqPMh-9L15RAO6JJD8BDCZSxcx8nbBWeDOIbzW1' : 'LIVE_SIGNATURE_GOES_HERE';

?>