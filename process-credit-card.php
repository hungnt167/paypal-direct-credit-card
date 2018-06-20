<?php

// Include config file
require_once('includes/config.php');

// Store request params in an array
$request_params = array
                    (
                    'METHOD' => 'DoDirectPayment', 
                    'USER' => $api_username, 
                    'PWD' => $api_password, 
                    'SIGNATURE' => $api_signature, 
                    'VERSION' => $api_version, 
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                    'CREDITCARDTYPE' => 'MasterCard', 
                    'ACCT' => '5522340006063638',                        
                    'EXPDATE' => '022013',           
                    'CVV2' => '456', 
                    'FIRSTNAME' => 'Tester', 
                    'LASTNAME' => 'Testerson', 
                    'STREET' => '707 W. Bay Drive', 
                    'CITY' => 'Largo', 
                    'STATE' => 'FL',                     
                    'COUNTRYCODE' => 'US', 
                    'ZIP' => '33770', 
                    'AMT' => '100.00', 
                    'CURRENCYCODE' => 'USD', 
                    'DESC' => 'Testing Payments Pro'
                    );

// Loop through $request_params array to generate the NVP string.
$nvp_string = '';
foreach($request_params as $var=>$val)
{
    $nvp_string .= '&'.$var.'='.urlencode($val);    
}


// Send NVP string to PayPal and store response
$curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
 
$result = curl_exec($curl);     
curl_close($curl);


// Parse the API response
$nvp_response_array = parse_str($result);

// Function to convert NTP string to an array
function NVPToArray($NVPString)
{
    $proArray = array();
    while(strlen($NVPString))
    {
        // name
        $keypos= strpos($NVPString,'=');
        $keyval = substr($NVPString,0,$keypos);
        // value
        $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
        $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
        // decoding the respose
        $proArray[$keyval] = urldecode($valval);
        $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
    }
    return $proArray;
}

var_dump(NVPToArray($result));

die;