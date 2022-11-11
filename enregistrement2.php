<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style/normalizer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Entrée des donnateurs</title>
</head>

<body>

    <?php

    $typeDon = 3;

    if (!empty($_GET) && array_key_exists("type", $_GET)) {
        $typeDon = intval($_GET["type"]);
    }

    // On va chercher les données locales

    include dirname(__FILE__) . '/fonctions/recupeHeure.php';

    // On remplace le ":" par un "h" pour avoir une heure lisible

    $newHour = searchHour($typeDon);

    /* recuperer heure et minute */
    $recupeHeure = recupeHeure(str_replace("h", ":", $newHour));

    /* Si le donneur n'a pas de rendez vous on affiche ce formulaire */

    if ($_GET["rdv"] == "false" && $newHour != "0h0") {

    ?>
        <form action="exec/execAddDonneur.php" method="post">
            <input type="hidden" name="typeDon" value="<?php echo $typeDon ?>" />
            <input type="hidden" name="typeRDV" value="2" />
            <input type="hidden" name="heure" value="<?php echo $recupeHeure["heure"] ?>" />
            <input type="hidden" name="minute" value="<?php echo $recupeHeure["minute"] ?>" />
            <div id="logo">
                <img src="img/EFS-logo.png" alt="logo EFS" />
            </div>
            <legend>Formulaire de rentrée</legend>

            <fieldset id="rdv">

                <legend class="secondTitle">Un rendez-vous est disponible pour <?php echo $newHour; ?>, acceptez vous le rendez vous ?</legend>

                <div>
                    <input type="radio" id="oui" name="rdv" value="oui" checked>
                    <label for="oui">Oui</label>
                </div>

                <div>
                    <input type="radio" id="non" name="rdv" value="non">
                    <label for="non">Non</label>
                </div>

            </fieldset>

            <fieldset id="rdv-code-barre">

                <legend>Le code barre du donneur est le</legend>

                <div>
                    <input type="text" id="codeBar" name="codeBar">
                </div>

            </fieldset>

            <input type="submit" name="submit2" />
        </form>

        <script src="./js/enregistrementSRDV.js"></script>

    <?php
    } else if ($_GET["rdv"] == "false" && $newHour == "0h0") {
    ?>
        <form action="exec/execAddDonneur.php" method="post">
        <input type="hidden" id="non" name="rdv" value="non">
            <div id="logo">
                <img src="img/EFS-logo.png" alt="logo EFS" />
            </div>
            <legend>Formulaire de rentrée</legend>

            <fieldset id="rdv">

                <legend class="secondTitle">Aucune heure disponible dans la journée.</legend>

            </fieldset>

            <input type="submit" name="submit2" />
        </form>

        <script src="./js/enregistrementSRDV.js"></script>
    <?php
    } else {
        /* Sinon on affiche celui la */
    ?>
        <form action="exec/execAddDonneur.php" method="post">
            <input type="hidden" name="typeDon" value="<?php echo $typeDon ?>" />
            <input type="hidden" id="oui" name="rdv" value="oui">
            <input type="hidden" name="typeRDV" value="1" />
            <div id="logo">
                <img src="img/EFS-logo.png" alt="logo EFS" />
            </div>
            <legend>Formulaire de rentrée</legend>

            <fieldset id="rdv">
                <legend>Heure de rendez-vous</legend>

                <div>
                    <input type="number" name="heure" value="" /> : <input type="number" name="minute" value="" />
                </div>

            </fieldset>

            <fieldset id="rdv-code-barre">
                <legend>Le code barre du donneur est le</legend>

                <div>
                    <input type="text" id="codeBar" name="codeBar">
                </div>

            </fieldset>

            <input type="submit" name="submit2" />
        </form>

        <script src="./js/enregistrementRDV.js"></script>

    <?php } ?>


</body>

</html>