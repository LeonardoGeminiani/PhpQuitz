<?php 
include_once("function.php"); 
include_once("themeGetter.php"); 

?>

<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Home</a>
        
        <div class="d-flex " id="navbarSupportedContent">
            <form class="d-flex" method="post">
                <button class="btn btn-primary" name="tema" value="<?php 
                    $nt;
                    if($THEME == "dark"){
                        $nt = "light";
                    } else {
                        $nt = "dark";
                    }

                    echo $nt;
                ?>" type="submit">Passa a tema <?php  echo ($nt == "light" ? "chiaro" : "scuro"); ?></button>
            </form>
        </div>
    </div>
</nav>