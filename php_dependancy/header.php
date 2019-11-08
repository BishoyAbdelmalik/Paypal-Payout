<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/images/luxsuplogo.jpg" alt="LUX Logo" width="333" /></a>
        <?php
        $logout='<a href="/logout.php">logout</a>';
        ?>
        <span class="navbar-text white-text">
            <h4 class="text-white m-0"><strong><?php
                if(array_key_exists("id",$_SESSION)){
                    echo $logout;
                }
                ?></strong></h4>
        </span>

    </div>

</nav>
