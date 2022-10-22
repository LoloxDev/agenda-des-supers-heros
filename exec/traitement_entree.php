<?php

// On récupère l'heure actuel

$dt = new \DateTime();


include dirname(__FILE__) . '/../fonctions/code_generation.php';


// On traite les données du formulaire

if ( isset( $_POST['submit'] ) ) {

    // On récupère l'heure le type de sang et si le donneur à un rdv ou non

    $heure = $dt->format('H:i:s');
    $type = $_POST['blood'];
    $rdv = $_POST['rdv'];

    // On vérifie s'il à un rendez vous pour modifier l'affichage du second formulaire

    if ($rdv == "oui") {
        $rdv = true;
        header('Refresh: 0;../enregistrement2.php?rdv=true&type='.$type);
        exit();
    } else {
        $rdv = false;
        header('Refresh: 0;../enregistrement2.php?rdv=false&type='.$type);
        exit();
    }
    
    

}

if ( isset( $_POST['submit2'] ) ) {
    $rdv = $_POST['rdv'];
}