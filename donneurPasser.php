<?php

/* pour lire les fichier */
include dirname(__FILE__) . '/fonctions/dataFile.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style/normalizer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <meta http-equiv="Refresh" content="300"> 
    <title>Document</title>
</head>
<body>
<div id="form">
        <div id="logo">
            <img src="img/EFS-logo.png" alt="logo EFS"/>
        </div>
        <legend class="title">Le prochain donneur à retirer de la liste</legend>
        <div class="table passe">
        <table>
            <body>
                <?php $values = listePassage();
                foreach ($values as $value) {
                    if(trim($value[2]) == "false") { ?>
                        <tr>
                            <td>
                                <?php echo $value[1]; ?>
                            </td>
                            <td>
                             <a class="btn btn-primary" href="./exec/executePatientPasse.php?id=<?php echo $value[0] ?>">passé</a>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </body>
        </table>
        </div>
    </div>
</body>
</html>