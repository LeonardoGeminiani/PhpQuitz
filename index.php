<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<?php 
include("function.php");
include("themeGetter.php"); 
?>
<body data-bs-theme="<?php 
    echo $THEME
?>">
    <?php
        session_start();
        $domande = [];

        $fileD = fopen("domandeImg.csv", "r");
        fgets($fileD);
        while(($data = fgetcsv($fileD, null, ";"))){
            array_push($domande, [
                "nome" => $data[0],
                "A" => $data[1],
                "B" => $data[2],
                "C" => $data[3],
                "img" => $data[4]
            ]);
        }

        fclose($fileD);

        $rnd = range(0, count($domande)-1);
        shuffle($rnd);
        
        $domandeSel = [];
        $_SESSION["risposte"] = [];
        
        for($i = 0; $i < 20; $i++){
            array_push($domandeSel, $domande[$rnd[$i]]);
            $_SESSION["risposte"] [$i+1] = null;
        }

        $_SESSION["domande"] = $domandeSel;
        // var_dump($domandeSel);

        // print header
        include("header.php");
    ?>

    <h1>Inizia il Quiz!!</h1>
    <a href="domanda.php?id=1" class="btn btn-primary">Inizia</a>
    

    <div id="mainWrap"></div>
    <div id="main"></div>
</body>
</html>
<script src="bootstrap.bundle.min.js"></script>