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
                "D" => $data[4],
                "img" => $data[5],
                "desc" => $data[6],
            ]);
        }

        fclose($fileD);

        $rnd = range(0, count($domande)-1);
        shuffle($rnd);
        
        $domandeSel = [];
        $_SESSION["risposte"] = [];
        $_SESSION["bonusUtil"] = [];
        
        for($i = 0; $i < 20; $i++){
            array_push($domandeSel, $domande[$rnd[$i]]);
            $_SESSION["risposte"] [$i+1] = null;
            $_SESSION["bonusUtil"] [$i+1] = false;
        }

        $_SESSION["domande"] = $domandeSel;
        $_SESSION["bonus"] = $_SESSION["maxBonus"] = 6;

        // print header
        include("header.php");
    ?>

    <div class="container-sm">
        <div class="text-center m-5">
            <h1 class="m-5 fw-semibold lh-1" style="font-size:3.6em;">Inizia il Quiz!!</h1>

            <form method="post" action="domanda.php">
                <button type="submit" name="id" value="1" class="mx-auto btn btn-primary btn btn-lg bd-btn-lg d-flex align-items-center justify-content-center fw-semibold">Inizia</button>
            </form>
            
            <p class="m-4 lead">
                "Scopri i Giganti della Storia" è un quiz coinvolgente che ti porterà a esplorare le vite e le gesta di alcuni dei personaggi più influenti e iconici della storia umana. 
                <br>
                Dalla saggezza di Confucio alla genialità di Leonardo da Vinci, dalla forza di Napoleone Bonaparte alla determinazione di Cleopatra, questo quiz ti sfiderà a testare la tua conoscenza su una vasta gamma di figure storiche.
                <br>
                Preparati a mettere alla prova la tua memoria e il tuo spirito d'osservazione mentre immergi nel passato e scopri le storie affascinanti di coloro che hanno plasmato il corso della storia mondiale.
            </p>
        </div>
    </div>
    
    <div id="mainWrap"></div>
    <div id="main"></div>
</body>
</html>