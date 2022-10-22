<?php

include dirname(__FILE__) . '/../fonctions/code_generation.php';
include dirname(__FILE__) . '/../fonctions/dataFile.php';

if(!empty($_POST) && array_key_exists('rdv', $_POST)) {

    if($_POST['rdv'] == "oui") {

        if(!empty($_POST) && array_key_exists('typeDon', $_POST) && array_key_exists('typeRDV', $_POST) && 
            array_key_exists('heure', $_POST) && array_key_exists('minute', $_POST) && array_key_exists('codeBar', $_POST)) {
                $typeDon = intval($_POST['typeDon']);
                $typeRDV = $_POST['typeRDV'] == "1";
                $heure = str_pad(intval($_POST['heure']), 2, "0", STR_PAD_LEFT) . ":" . str_pad(intval($_POST['minute']), 2, "0", STR_PAD_LEFT);
                $timeCode = generate_code($heure, $typeDon, $typeRDV);
                saveLine($timeCode, $_POST['codeBar']);
                header('Refresh: 0;../enregistrement.php');
        } else {
            echo "Une erreur s'est produite, merci de recommencer.";
        }
    } else {
        header('Refresh: 0;../enregistrement.php');
    }

} else {
    echo "Une erreur s'est produite, merci de recommencer.";
}