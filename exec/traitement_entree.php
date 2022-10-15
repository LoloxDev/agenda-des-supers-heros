<?php

$dt = new \DateTime();

dirname(__FILE__) . '/../fonctions/code_generation.php';

if ( isset( $_POST['submit'] ) ) {

    if ($rdv == "oui") {
        $rdv = true;
    } else {
        $rdv = false;
    }

    $heure = $dt->format('H:i:s');
    $type = $_POST['blood'];
    $rdv = $_POST['rdv'];
    
    generate_code($heure, $type, $rdv);

    header('Refresh: 2;../enregistrement2.php');
    exit();
}

if ( isset( $_POST['submit2'] ) ) {
    $rdv = $_POST['rdv'];
}