<?php
include dirname(__FILE__) . '/../fonctions/code_generation.php';

if(!empty($_POST) && array_key_exists('message', $_POST)) {
    saveMessage($_POST["message"]);
    header('Refresh: 0;../config.php');
} else {
    echo "Une erreur s'est produite, merci de recommencer.";
}