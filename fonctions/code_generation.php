<?php
function generate_code($heure, $type, $rdv) {
    $result = $heure;
    $result = $result.strval($type);
    if ($rdv == false) {
        $result = $result."2";
    } else {
        $result = $result."1";
    }
    $counter = (int) file_get_contents("fonctions/counter.txt") + 1;
    $counter = str_pad($counter , 4 , "0" , STR_PAD_LEFT);
    file_put_contents("fonctions/counter.txt",$counter);
    $result = $result.$counter;
    return $result;
}
?> 