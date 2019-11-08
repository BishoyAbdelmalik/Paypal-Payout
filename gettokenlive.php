<?php

$cmd='curl -v https://api.paypal.com/v1/oauth2/token \
   -H "Accept: application/json" \
   -H "Accept-Language: en_US" \
   -u "<client-id>:<client secret>" \
   -d "grant_type=client_credentials"';
$output = shell_exec($cmd);
$outputArray=json_decode ($output,true);
$token=$outputArray["access_token"];

