<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domanda</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("getPost.php");
        session_start();

        $id = $_GET["id"];
        getPost($id-1);

        $domande = $_SESSION["domande"];
        $domanda = $domande[$id-1];
        // if(!isset($domanda)){
        //     // wrong id
        //     var_dump($_SERVER);
        //     echo $_SERVER['HTTP_HOST'] . "/domanda.php?id=1";
        //     header('Location: http://'. $_SERVER['HTTP_HOST'] . "/domanda.php?id=1");
        // }

        $query = urlencode($domanda["nome"]);

        $response = file_get_contents("https://kgsearch.googleapis.com/v1/entities:search?languages=it&query=" . $query . "&key=AIzaSyAz65f_5fNhV7wFpguCMBlD5m5BCTtteVg&limit=1&indent=True");
        $response = json_decode($response, true);

        // print header
        include("header.php");
    ?>


    <div class="container-md d-flex cont-g ">
        <div class="shadow-lg card">
            <div class="d-links card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <?php
                    foreach($domande as $i => $d){
                        $e = $i + 1;
                        $c = "";
                        if($e == $id){
                            $c = "active";
                        }
                        echo '<li class="nav-item"><a  class="nav-link ' . $c . '" href="/domanda.php?id=' . $e . '">' . $e . "</a></li>";
                    }
                ?>
                </ul>
            </div>
        
            <div class="card-body">
                <?php
                    if(isset($response["itemListElement"][0]["result"]["description"])){
                        $aiuto = $response["itemListElement"][0]["result"]["description"];
                        // echo $aiuto;
                    }
                ?>

                <form 
                    <?php
                        if($id < count($domande)){
                            $nid = $id+1;
                            echo 'action="domanda.php?id=' . $nid . '"';
                        }else {
                            echo 'action="risultati.php"';
                        }
                    ?>
                    method="post" >

                    <div class="d-flex">
                        <div class="m-4">    
                            <img class="rounded img" src="<?php echo $domanda["img"]; ?>">
                        </div>
                        <div class="m-4">
                            <h1>
                                Indovina il personaggio famoso
                            </h1>
                            
                            <div class="form-check">
                                <?php 
                                    $ris = [$domanda["A"], $domanda["B"], $domanda["C"]];
                                    
                                    for($i = 0; $i < count($ris); $i++){
                                        $ck = "";
                                        if($_SESSION["risposte"][$id] != null){
                                            if($_SESSION["risposte"][$id] == $ris[$i]){
                                                $ck = "checked";
                                            }
                                        }
                                        
                                        echo <<<EOL
                                        <div class="form-check my-in">
                                            <input class="form-check-input" type="radio" id="sel_$i" name="sel" value="$ris[$i]" $ck>
                                            <label class="fs-4 form-check-label" for="sel_$i">$ris[$i]</label>
                                        </div>
                                        EOL;
                                    }
                                ?>
                            </div>
                            <div class="mt-4">
                                <nav aria-label="...">
                                    <ul class="pagination pagination-lg">  
                                        <?php
                                            $c = "";
                                            if($id == 1){
                                                $c = "disabled";
                                            }

                                            $pid = $id-1;
                                            echo '<li class="page-item ' . $c . '"><a href="domanda.php?id=' . $pid . '" class="page-link">&laquo; Domanda Precedente</a></li>';
                                        ?>
                                        
                                        <li class="page-item">
                                            <button type="submit" class="page-link" ><?php 
                                                if($id == 20) {
                                                    echo "Invia Le Risposte";
                                                } else {
                                                    echo "Domanda Successiva";
                                                }                                            
                                            ?> &raquo;</button>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script src="bootstrap.bundle.min.js"></script>