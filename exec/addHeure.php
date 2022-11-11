<?php
include dirname(__FILE__) . '/../fonctions/code_generation.php';

if(!empty($_POST) && array_key_exists('heure', $_POST) && array_key_exists('minute', $_POST) && array_key_exists('blood', $_POST)) {
    $heure = str_pad(intval($_POST['heure']), 2, "0", STR_PAD_LEFT) . ":" . str_pad(intval($_POST['minute']), 2, "0", STR_PAD_LEFT);
    $typeDon = intval($_POST['blood']);
    addDate($heure, $typeDon);
    header('Refresh: 0;../config.php');
} else {
    echo "Une erreur s'est produite, merci de recommencer.";
}
