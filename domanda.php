<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domanda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
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
    ?>

    <div class="d-flex cont-g">
        <div class="d-links">
            <?php
                foreach($domande as $i => $d){
                    $e = $i + 1;
                    echo '<div><a href="/domanda.php?id=' . $e . '">' . $e . "</a></div>";
                }
            ?>
        </div>
    
        <div class="container-md">

            <h1>
                Indovina il personaggio famoso
            </h1>

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
                        <img class="img-fluid" src="<?php echo $domanda["img"]; ?>">
                    </div>
                    <div class="m-4">
                        <p>Please select your favorite Web language:</p>
                        
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
                                <input type="radio" id="sel_$i" name="sel" value="$ris[$i]" $ck>
                                <label for="sel_$i">$ris[$i]</label><br>
                                EOL;
                            }
                        ?>
                        
                        <button type="submit" class="btn btn-primary" >Sub</button>
                
                        <?php
                            if($id > 1){
                                $pid = $id-1;
                                echo '<a href="domanda.php?id=' . $pid . '" class="btn btn-primary">Domanda Precedente</a>';
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script src="bootstrap.bundle.min.js"></script>