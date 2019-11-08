<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require 'php_dependancy/config.php';
$login=false;
if(!array_key_exists("id",$_SESSION)){
    $login=true;
    header("Location: /login.php");
}else{
    $user=$_SESSION["id"];
    
}
require "php_dependancy/mysql.php";
$a=$_GET["a"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="<?php echo $siteICO; ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php css();?>


    <title><?php echo $siteName;?></title>
    <?php Mixpanel();?>
</head>

<body>
    <header>
        <?php
            require 'php_dependancy/header.php';
        ?>
    </header>
    <main>
        <div class="wrapper">
            <div id="formContent" class="mymaxwidth">
                <form action="/submitData.php" method="post">
                    <input type="text" class="text-align-left" name="email" placeholder="Recipient Email" required>
                    <input type="number" class="text-align-left" name="amount" placeholder="Dollar Amount"  step="0.01" min="0" max="35" required>
                    <!-- <input type="text"  id="notes" name="notes" placeholder="Notes" required>-->
                    <textarea class="text-align-left" rows="4" cols="50" name="notes" placeholder="Notes"></textarea>

                    <input type="submit" value="Submit">

                </form>

            </div>
        </div>
        <?php
        $rows=pull($user);
        if($user=="Siteadmin"){
            $rows=pullAll();
        }
//        $rowsNumb=mysqli_num_rows($rows);
//        $rows=mysqli_fetch_array($rows);
        ?>
        <div class="wrapper ">
            <div id="formContent" class="mytable">
                <h2 class="text-decoration-underline">Previous Entries</h2>
                <table style="width:100%">
                    <tr>
                        <?php
                        if($user=="Siteadmin"){
                            echo "<th>User Name</th>";
                        }?>
                        <th>Date</th>
                        <th>Recipient Email</th>
                        <th>Amount</th>
                        <th>Notes</th>
                        <th>Status</th>
                    </tr>
                    <?php 
                        $lines="";
                        if($user=="Siteadmin"){
                            $users=array();
                            
                        }
                        while($row=mysqli_fetch_array($rows)){
                            $lines.= "<tr>";
                            if($user=="Siteadmin"){
                                $lines.= "<td>".$row["user"]."</td>"; 
                                if(!in_array($row["user"], $users, true)){
                                    array_push($users, $row["user"]);
                                }
                            }
                            $lines.= "<td>".$row["Date"]."</td>";
                            $lines.= "<td>".$row["Recipient-Email"]."</td>";
                            $lines.= "<td> $".$row["Dollar-Amount"]."</td>";
                            $lines.= "<td>".$row["Notes"]."</td>";
                            if($row["Status"]==0){
                                $status="Processing";
                            }else{
                                $status="Completed";
                                
                            }
                            $lines.= '<td class="'.$status.'">'.$status."</td>";
                            $lines.= "</tr>";
                        }
                        echo $lines;
                    ?>
                </table>
                <?php
                if($user=="Siteadmin"){

                    $select="";
                    $select.='<div class="form-group">
                        <label for="approve">Select User to approve:</label>
                        <select class="form-control" id="approve">';
                    foreach($users as $u){
                        $select.='<option>';
                        $select.=$u;
                        $select.='</option>';
                    }

                    $select.='</select></div>';
                    echo $select;
                    echo '<a  class="btn m-3 btnShadow" href="javascript:approve()" style="width: 40%; min-width: 200px;">Approve Slected</a>';
                }
                ?>
                <div id="results"></div>
            </div>
        </div>
    </main>
    <?php        
        require 'php_dependancy/footer.php';
    ?>
    <!--Javascrpits-->

    <?php
        jquery();
        bootstrap();
    ?>



</body>
<script>
    <?php
if($a==1){
    echo "alert('Maximum amount is $35');";
}  
    if($user=="Siteadmin"){
        echo "function approve() {";
        echo '$( "#results" ).html( "Loading.." );';
        echo 'var user=$( "#approve" ).val();';
        echo 'var url="https://userlog.freebottle.org/approveByUser.php?user="+user;';
        echo '$.ajax(url).done(function( html ) {$( "#results" ).html( html );});';
        
        echo "}";

    }
?>

</script>

</html>
