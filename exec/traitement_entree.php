<?php

$dt = new \DateTime();


if ( isset( $_POST['submit'] ) ) {

    echo $dt->format('H:i:s');
    $typeBlood = $_POST['blood'];
    $rdv = $_POST['rdv'];

    echo($typeBlood);
    echo($rdv);

    header('Refresh: ../enregistrement2.php');
    exit();

}

if ( isset( $_POST['submit2'] ) ) {

    $rdv = $_POST['rdv'];

    echo($rdv);
    
}