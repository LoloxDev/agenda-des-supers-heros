<?php
// Concu a partir du code de Loris, qui etait sur la page "enregistrement2.php"

// On va chercher les données locales

if (!function_exists('recupeHeure')) {
    include dirname(__FILE__) . '/code_generation.php';
}

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');


// On récupère les données du jour

function search(?array $tab, int $type): ?string
{
    if (!empty($tab)) {
        foreach ($tab as $value) {
            if (count($value) > 3) {
                $heure = intval(str_replace(":", "", $value[0]));
                $dt = new \DateTime();
                $heureNow = $dt->format('H:i');
                $heureValueNow = intval(date('Hi', strtotime($heureNow . ' +'.DURAT_NO_RDV.' minutes')));
                if (intval($value[3]) == 0 && $heure > $heureValueNow && intval($value[1]) == $type) {
                    return $value[0];
                }
            }
        }
    }

    return "0:0";
}

// recherche une heure disponible
function searchHour(int $type): ?string {
    // Recuperer les valeurs du fichier
    $file = loadFile();
    $newHour = search($file, $type);

    // On remplace le ":" par un "h" pour avoir une heure lisible
    return str_replace(":", "h", $newHour);
}
