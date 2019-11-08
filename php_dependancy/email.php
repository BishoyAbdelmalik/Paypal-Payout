<?php
$to= '';

$error=array();
$first_name=trim(addslashes($_POST[fname]));
$last_name=trim(addslashes($_POST[lname]));
$email=trim(addslashes($_POST[email]));
$number=trim(addslashes($_POST[phone]));
$msg=trim(addslashes($_POST[paragraph_text]));

$headers = 'From: webmaster@webmaster.com' . "\r\n" .
    'Reply-To: '.$email.' '. "\r\n" .
    'X-Mailer: PHP/' . phpversion();


if (isset($first_name)){
    if (is_numeric($first_name)){
        array_push($error, "First Name Can't be numeric");
    }
}
if(!isset($first_name)||is_null($first_name) || $first_name==""){array_push($error," First Name is Required");}
if (isset($last_name)){
    if (is_numeric($last_name)){
        array_push($error, "Last Name Can't be numeric");
    }
}if(!isset($last_name)||is_null($last_name)  || $last_name==""){array_push($error," Last Name is Required");}
    

if(!isset($email)||is_null($email) || $email==""){array_push($error,"Email field is required");}

//if(isset($number)){if(is_numeric($number)){if(strlen($number)<11 && strlen($number)>5){}else{array_push($error,"The phone number is not valid");}}}
if (!isset($msg)){array_push($error," Message field is required");}

if(!isset($msg)||is_null($msg) || $msg==""){array_push($error,"Message field can't be empty");}
if (!$error){
    $subject= "Website Contact us form";
    $message = 'First Name: '. $first_name . "\r\n";
    $message .= 'Last Name: '. $last_name . "\r\n";
    $message .= 'Phone Number: '. $number . "\r\n";
    $message .= 'Message: '. "\r\n";
    $message .= $msg;
    
    
    
    $success = mail($to, $subject, $message, $headers);
    echo "your message has been sent";

    if (!$success) {
        $errorMessage = error_get_last()['message'];
    }
}else{
    $errorMessage="";
    $errorMessage .= "<ul>";
    foreach ($error as $err){
        $errorMessage .= "<li>". $err ."</li>";
    }
    $errorMessage .= "</ul>";
    echo  $errorMessage ;
}



?>
