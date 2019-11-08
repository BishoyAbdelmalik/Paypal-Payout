<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require 'php_dependancy/config.php';
if(!array_key_exists("id",$_SESSION)){
    $login=true;
    header("Location: /login.php");
    die();
}else{
    $user=$_SESSION["id"]; 
}
if(count($_POST)==0){
    header("Location: /");
    die();
}
require "php_dependancy/mysql.php";
$now = new DateTime('now', new DateTimeZone('America/Los_Angeles'));


$rEmail=trim(addslashes($_POST["email"]));
if(strlen ($rEmail)<2){
    header('Location: /?');
    die();
}
$amount=trim(addslashes($_POST["amount"]));
if(!($amount>0&&$amount<=35)){
    header('Location: /?a=1');
    die();
}
$notes=trim(addslashes($_POST["notes"]));

$row = array(
    "id"=>" ",
    "Date"=>$now->format('Y-m-d h:i A'),
    "user"=>$user,
    "Recipient-Email"=>$rEmail,
    "Dollar-Amount"=>$amount,
    "Notes"=>$notes,
    "Status"=>0,
); 
insert($row);







header("Location: /");
?>
