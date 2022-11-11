<?php
/* pour lire les fichier */
include dirname(__FILE__) . '/fonctions/code_generation.php';

$fileCount = file_get_contents(FILE_COUNTER, true);
$fileData = file_get_contents(FILE_DATA_DEF, true);
$fileDataCode = file_get_contents(FILE_DATA_CODE, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style/normalizer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <style>
        button {
            width: 100%;
        }

        .all-value {
            display: flex;
            flex-direction: row;
            margin-bottom: unset !important;
            width: unset !important;
            height: unset;
            background-color: unset;
            box-shadow: unset;
            border-radius: unset;
            padding: unset;
            text-align: unset;
        }

        .all-value * {
            margin-bottom: unset !important;
            width: unset !important;
        }

        .mod-value {
            display: flex;
            flex-direction: column;
            margin-bottom: unset !important;
            width: unset !important;
        }

        .heur-value {
            display: flex;
            flex-direction: row;
            margin-bottom: unset !important;
            width: unset !important;
        }

        label {
            min-width: 86px;
            text-align: right;
            padding-right: 5px;
            margin-bottom: unset !important;
            width: unset !important;
        }

        body #form {
            max-height: unset;
        }

        select, input {
            max-width:100px;
        }

        .display-file, .textarea {
            margin: unset !important;
            width: unset !important;
            margin-bottom: unset !important;
        }

        .display-file {
            display: flex;
            justify-content: space-around;
        }

        .textarea {
            display: flex;
            flex-direction: column;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div id="form">
        <div id="logo">
            <img src="img/EFS-logo.png" alt="logo EFS"/>
        </div>
        <legend class="title">Configuration</legend>
        <div class="table passe">
            <table>
                <body>
                    <tr>
                        <td>
                            Le nombre
                        </td>
                        <td>
                            <?= $fileCount ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Actualiser la page
                        </td>
                        <td>
                            <button id="actualiser">Actualiser</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Initialiser les fichiers
                        </td>
                        <td>
                            <button id="initFile">Initialiser</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Valeurs par défaut
                        </td>
                        <td>
                            <button id="defautFile">Défaut</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ajouter une heure disponible
                        </td>
                        <td>
                            <form class="all-value" action="exec/addHeure.php" method="post" name="test">
                                <div class="mod-value">
                                    <div class="heur-value">
                                        <label for="heur">heure</label>
                                        <input type="number" name="heure" value="" />
                                    </div>
                                    <div class="heur-value">
                                        <label for="heur">minute</label>
                                        <input type="number" name="minute" value="" />
                                    </div>
                                    <div class="heur-value">
                                        <label for="blood">Choisissez<br />un type<br />de sang :</label>
                                        <select name="blood" id="bloodList">
                                            <option value=""></option>
                                            <option value="3">Sang total</option>
                                            <option value="2">Plasma</option>
                                            <option value="1">Plaquette</option>
                                        </select>
                                    </div>
                                </div>
                                <button id="valider">Valider</button>
                            </form>
                        </td>
                    </tr>
                </body>
            </table>
        </div>
        <div class="display-file">
            <div class="textarea">
                <p>data.csv</p>
                <textarea id="file1" name="file1"
                rows="10" readonly><?= $fileData ?></textarea>
            </div>
            <div class="textarea">
                <p>dataCode.csv</p>
                <textarea id="file2" name="file2"
                rows="10" readonly><?= $fileDataCode ?></textarea>
            </div>
        </div>
    </div>
        <script>
            document.getElementById("actualiser").addEventListener("click", function(event) {
                location.reload(true);
            });

            document.getElementById("initFile").addEventListener("click", function(event) {
                window.location.href = './exec/initFile.php';
            });

            document.getElementById("defautFile").addEventListener("click", function(event) {
                window.location.href = './exec/defaultFile.php';
            });
        </script>
</body>
</html>