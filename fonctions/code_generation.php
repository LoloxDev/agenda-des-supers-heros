<?php

/* recupere les configurations */
include dirname(__FILE__) . '/configMain.php';

function generate_code($heure, $type, $rdv) {
    // Commence par noter l'heure du rendez vous
    // enlever 8 ou 9 minutes si le rendez vous est special
    if ($type == 1) {
        $result = date('Hi', strtotime($heure. ' -9 minutes'));
    } elseif ($type == 2) {
        $result = date('Hi', strtotime($heure. ' -8 minutes'));
    } else {
        $result = $heure;
    }
    // Ajoute le code du type de rendez vous
    $result = $result.strval($type);
    // Ajoute un code pour dire si le donneur a un rendez vous ou non
    if ($rdv == false) {
        $result = $result."2";
    } else {
        $result = $result."1";
    }
    // Ajoute le numero du rendez vous de la journée pour les cas speciaux
    $counter = (int) file_get_contents(FILE_COUNTER) +1 ;
  
    $counter = str_pad($counter , 4 , "0" , STR_PAD_LEFT);
    file_put_contents(FILE_COUNTER,$counter);
    
    $result = $result.$counter;

    return $result;
    
}

