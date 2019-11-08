<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require 'php_dependancy/config.php';
if(array_key_exists("id",$_SESSION)){
    header("Location: /");
    
    die();
}

$users=array(
    "Siteadmin"=>"pass"
);
$invalid=false;
if(isset($_POST)&&array_key_exists("username",$_POST)){
    if(array_key_exists($_POST["username"],$users)){
        if($_POST["pass"]===$users[$_POST["username"]]){
            $_SESSION["id"]=$_POST["username"];
            header("Location: /");
            die();
        }else{
            $invalid=true;
        }
    }else{
        $invalid=true;
    }
}

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
        <div class="wrapper fadeInDown">
           

            <div id="formContent">
                <form action="/login.php" method="post">
                    <input type="text" id="login" class="fadeIn second" name="username" placeholder="login" required>
                    <input type="password" id="password" class="fadeIn third" name="pass" placeholder="password" required>
                    <input type="submit" class="fadeIn fourth" value="Log In">
                    <p class="text-danger"><?php
                        if($invalid){
                            echo "Invalid Login please try again";
                        }
                        ?></p>
                </form>
                
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

</html>
