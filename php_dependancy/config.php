<?php

$siteICO="/images/ico.png";
$siteName="Paypal Payout";


function jquery() {
    $jquery_cdn='<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
    echo $jquery_cdn;
}
function Mixpanel() {
    $Mixpanel='';
    echo $Mixpanel;
}
function bootstrap() {
    $bootstrap_cdn ='';
    $bootstrap_cdn .='<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>';

    echo $bootstrap_cdn;

}
function css() {
    $css ='<!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" >

    <link async rel="stylesheet" href="/css/styles.css" />';

    echo $css;

}

?>