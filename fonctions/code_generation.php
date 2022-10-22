<?php

/* recupere les configurations */
include dirname(__FILE__) . '/configMain.php';

function recupeHeure(?string $newHour):array {
    $recupeHeure = ["heure" => 0, "minute" => 0];
    $tabHeure = explode(":", $newHour);
    if($tabHeure > 1) {
        $recupeHeure["heure"] = intval($tabHeure[0]);
        $recupeHeure["minute"] = intval($tabHeure[1]);
    }
    return $recupeHeure;
}

/*
Pour generer le code 
$heure = "H:i"
$type = "type de don" (3 = "Sang total", 2 = "Plasma", 1 = "Plaquette")
$rdv = "type de rendez-vous" (1 = "avec rendez-vous", 2 = "sans rendez-vous")
*/
function generate_code(?string $heure, int $type, bool $rdv):?string {
    // Commence par noter l'heure du rendez vous
    // enlever 8 ou 9 minutes si le rendez vous est special
    //$recupeHeure = intval(codeHeure(recupeHeure($heure)));
    if(empty($heure)) {
        $dt = new \DateTime();
        $heure = $dt->format('H:i');
    }
    if ($type == 1) {
        $result = date('Hi', strtotime($heure. ' -9 minutes'));
    } elseif ($type == 2) {
        $result = date('Hi', strtotime($heure. ' -8 minutes'));
    } else {
        $result = date('Hi', strtotime($heure));
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

