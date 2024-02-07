<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domanda</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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

    // $id = $_GET["id"];
    $id = $_POST["id"];

    // chache id, if theme is changed using another form
    if (!isset($id)) {
        $id = $_SESSION["id"];
    } else {
        $_SESSION["id"] = $id;
    }

    if ($bonus = isset($_POST["bonus"])) {
        $_SESSION["bonus"] = $_POST["bonus"];
        $_SESSION["bonusUtil"][$id] = true;
    } else if ($_SESSION["bonusUtil"][$id]) {
        $bonus = true;
    }

    if ($id == 21) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'risultati.php';
        header("Location: http://$host$uri/$extra");
        exit;
    }

    if (isset($_POST["oldId"]))
        getPost($_POST["oldId"]);

    $domande = $_SESSION["domande"];
    $domanda = $domande[$id - 1];

    $aiuto = $domanda["desc"];

    // print header
    include("header.php");
    ?>


    <div class="container-md d-flex cont-g ">
        <form action="domanda.php" method="post">
            <?php

            echo '<input type="hidden" name="oldId" value="' . $id . '">';
            ?>
            <div class="shadow card">
                <div class="d-links card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <?php
                        foreach ($domande as $i => $d) {
                            $e = $i + 1;
                            $c = "";
                            if ($e == $id) {
                                $c = "active";
                            }
                            if ($_SESSION["risposte"][$e] != null) {
                                $c .= " done";
                            }
                            echo '<li class="nav-item"><button class="nav-link ' . $c . '" type="submit" name="id" value="' . $e . '">' . $e . "</button></li>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-4">
                            <img class="rounded img domanda-img" src="<?php echo $domanda["img"]; ?>">
                        </div>
                        <div class="m-4 d-flex flex-column justify-content-between">

                            <div>
                                <h1>
                                    Indovina il personaggio famoso
                                </h1>

                                <div class="form-check">
                                    <?php
                                    $ris = [$domanda["A"], $domanda["B"], $domanda["C"], $domanda["D"]];

                                    for ($i = 0; $i < count($ris); $i++) {
                                        $ck = "";
                                        if ($_SESSION["risposte"][$id] != null) {
                                            if ($_SESSION["risposte"][$id] == $ris[$i]) {
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
                                <div class="card mt-5">
                                    <div class="card-body">
                                        <h5 class="card-title">Bonus <span class="
                                        <?php
                                        if ($_SESSION["bonus"] == 0) {
                                            echo "text-danger";
                                        } else {
                                            echo "text-success";
                                        }
                                        ?>
                                        ">
                                                <?php
                                                echo $_SESSION["bonus"] . "/" . $_SESSION["maxBonus"];
                                                ?>
                                            </span></h5>
                                        <p class="card-text">
                                            <?php
                                            if ($bonus) {
                                                echo $aiuto;
                                            } else
                                                echo "Serve per ottenere la descrizione del personaggio, ne possiedi una quantità limitata";
                                            ?>
                                        </p>
                                        <?php
                                        if (!$bonus) {
                                            $c = "";
                                            if ($_SESSION["bonus"] == 0)
                                                $c = " disabled";
                                            echo '<button type="submit" name="bonus" value="' . $_SESSION["bonus"] - 1 . '"  class="btn btn-primary' . $c . '">Utizza il Bonus</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <nav aria-label="...">
                                    <ul class="pagination pagination-lg" style="margin: 0;">
                                        <?php
                                        $c = "";
                                        if ($id == 1) {
                                            $c = "disabled";
                                        }

                                        $pid = $id - 1;
                                        echo '<li class="page-item ' . $c . '"><button type="submit" name="id" value="' . $pid . '"  class="page-link">&laquo; Domanda Precedente</button></li>';
                                        ?>

                                        <li class="page-item">
                                            <button type="submit" name="id" value="<?php echo $id + 1 ?>"
                                                class="page-link">
                                                <?php
                                                if ($id == 20) {
                                                    echo "Invia Le Risposte";
                                                } else {
                                                    echo "Domanda Successiva";
                                                }
                                                ?> &raquo;
                                            </button>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    </div>
    <div id="mainWrap"></div>
    <div id="main"></div>
</body>
</html>