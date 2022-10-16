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

include dirname(__FILE__) . '/fonctions/dataFile.php';
$file = loadFile();

function search($tab){

    foreach ($tab as $key => $value) {
        if (count($value)>3) {
            if ($value[3] == 0) {
                return $value[0];
            }
        }
    }

    return "0:0";
}

$newHour = search($file);
$newHour = str_replace(":","h", $newHour);


    if ($_GET["rdv"] == "false") {

    echo '  
            <form action="exec/traitement_entree.php" method="post">
                <legend>Formulaire de rentré</legend>

                    <fieldset id="rdv">

                        <legend>Un rendez-vous est disponible pour ' . $newHour . ', acceptez vous le rendez vous ?</legend>

                        <div>
                          <input type="radio" id="oui" name="rdv" value="oui"
                                 checked>
                          <label for="oui">Oui</label>
                        </div>

                        <div>
                          <input type="radio" id="non" name="rdv" value="non">
                          <label for="non">Non</label>
                        </div>

                    </fieldset>

                    <input type="submit" name="submit2" />
            </form>';


    } else {

        echo '
        <form action="exec/traitement_entree.php" method="post">
            <legend>Formulaire de rentré</legend>
        
            <fieldset id="rdv">

                <legend>Le code barre du donneur est le :</legend>

                <div>
                  <input type="text" id="codeBar" name="code">
                </div>

            </fieldset>

            <input type="submit" name="submit2" />
        </form>';

    } ?>
    
    
</body>
</html>