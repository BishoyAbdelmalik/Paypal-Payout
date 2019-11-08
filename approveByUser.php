<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require 'php_dependancy/config.php';
if(!array_key_exists("id",$_SESSION)){
    $login=true;
    echo "access denied";

    die();
}else{
    $user=$_SESSION["id"]; 
}
if(!($user=="Siteadmin")){
    echo "access denied";
    die();
}
$now = new DateTime('now', new DateTimeZone('America/Los_Angeles'));
require "gettokenlive.php";
require "php_dependancy/mysql.php";
$userInput=$_GET["user"];
//echo $userInput;
$rows=pull($userInput);
$cmd='curl -v -X POST https://api.paypal.com/v1/payments/payouts \
-H "Content-Type: application/json" \
-H "Authorization: Bearer '.$token.'" \
-d ';
$cmd.="'{";
$cmd.='"sender_batch_header": {
    "sender_batch_id": "Payouts'.strtotime($now->format('Y-m-d h:i A')).'",
    "email_subject": "You have a payout!",
    "email_message": "You have received a payout! Thanks for using our service!"
  },';
$cmd.='"items": [
    ';
$send=false;
while($row=mysqli_fetch_array($rows)){
    if($row["Status"]==0){
    $cmd.='{
          "recipient_type": "EMAIL",
          "amount": {
            "value": "'.$row["Dollar-Amount"].'",
            "currency": "USD"
          },
          "note": "'.$row["Notes"].'",
          "sender_item_id": "'.$row["user"].strtotime($row["Date"]).'",
          "receiver": "'.$row["Recipient-Email"].'"
        },';
 
        
        delete($row["id"]);

        $rowUpdate = array(
            "id"=>$row["id"],
            "Date"=>$row["Date"],
            "user"=>$row["user"],
            "Recipient-Email"=>$row["Recipient-Email"],
            "Dollar-Amount"=>$row["Dollar-Amount"],
            "Notes"=>$row["Notes"],
            "Status"=>1,
        ); 
        insert($rowUpdate);
        $send=true;
    }else{

        
    }
    
}
if($send){
    $cmd=substr($cmd,0,strlen($cmd)-1);
    $cmd.= "]
}'";
    echo $cmd;

    $output = shell_exec($cmd);
    $outputArray=json_decode ($output,true);
    echo "<br>";
    echo "<br>";
    echo "<pre>".var_dump($outputArray)."</pre>";
}else{
    echo "nothing to approve";

}

?>