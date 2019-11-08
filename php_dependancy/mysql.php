<?php
$db='table name';

//    global  $connection;
$dbhost="host";
$dbuser="DB user";
$dbpass='DB pass';
$dbname="DB name";
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(mysqli_connect_errno()){
die("Database connection failes: ".
mysqli_connect_error(). " (" . mysqli_connect_errno().")"
);
}


function insert($info){
    $query="INSERT INTO `".$GLOBALS['db']."` (";
    $keys = array_keys($info);
    $last = end($keys);
    foreach ($info as $key => $value){
       if($key==$last){$query.='`'.$key.'`';}
       else{$query.='`'.mysqli_real_escape_string($GLOBALS['connection'],$key).'`, ';}
    }
    $query.=") ";
    $query.='VALUES (';
    foreach ($info as $key => $value){
        if($key=="id"&&$value==" "){$query.="NULL,";} 
        else if($key==$last){$query.="'".$value."'";}
        else{$query.="'".mysqli_real_escape_string($GLOBALS['connection'],$value)."', ";}
    }
    $query.=');';
    mysqli_query($GLOBALS['connection'],$query); 

}

function delete($id){
    $query="DELETE FROM `".$GLOBALS['db']."` WHERE id='";
    $query .=$id;
    $query .="';";
    mysqli_query($GLOBALS['connection'],$query); 

}

function pull($user){
    mysqli_free_result($result);
    $query="SELECT * FROM `".$GLOBALS['db']."` where user='";
    $query .=$user;
    $query .="';";
    $result=mysqli_query($GLOBALS['connection'],$query);
    return $result;

}
function pullAll(){
    mysqli_free_result($result);
    $query="SELECT * FROM `".$GLOBALS['db']."` ORDER BY `payouts`.`Date` DESC";
    $query .=";";
    $result=mysqli_query($GLOBALS['connection'],$query);
    return $result;

}

function closeConnection(){
    mysqli_close($connection); 
}


?>
