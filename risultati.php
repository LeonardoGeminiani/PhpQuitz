<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitz</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    Risultati!!

    <?php
        include("getPost.php");

        session_start();
        getPost(20);

        $ris = $_SESSION["risposte"];
        $domande = $_SESSION["domande"];


        foreach ($ris as $i => $value) {
            // i = question id
            // value = response, if null no response given

            var_dump($i);
            echo "<br>";
            var_dump($value);
            echo "<br>";

            // echo $value["val"], ($domande[$value["id"] -1]);
        }

        echo count($ris);
    ?>
</body>
</html>
<script src="bootstrap.bundle.min.js"></script>