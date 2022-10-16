<?php

$dt = new \DateTime();


include dirname(__FILE__) . '/../fonctions/code_generation.php';


if ( isset( $_POST['submit'] ) ) {

    $heure = $dt->format('H:i:s');
    $type = $_POST['blood'];
    $rdv = $_POST['rdv'];

    if ($rdv == "oui") {
        $rdv = true;
        generate_code($heure, $type, $rdv);
        header('Refresh: 0;../enregistrement2.php?rdv=true');
        exit();
    } else {
        $rdv = false;
        generate_code($heure, $type, $rdv);
        header('Refresh: 0;../enregistrement2.php?rdv=false');
        exit();
    }
    
    

}

if ( isset( $_POST['submit2'] ) ) {
    $rdv = $_POST['rdv'];
}