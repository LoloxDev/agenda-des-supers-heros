<?php 

/* lire le fichier de configuration */
include dirname(__FILE__) . '/configMain.php';
/* lire le fichier pour configurer le code de passage */
include dirname(__FILE__) . '/code_generation.php';

/* lire le fichier de l'agenda (provisoire) */
/*
retourne le tableau {
    [0]="heure:minute", 
    [1]="type de don en chiffre", 
    [2]="type de passage en chiffre(RDV ou NON)",
    [3]="ordre d'inscription (0 si la place est disponible)"
}
Merci de ne pas modifier $nameFile.
*/
function loadFile(?string $nameFile = null):array {
    /* si on souhaite entrer l'emplacement sans passer par la config */
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_DEF;
    }
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    /* creation du tableau */
    $data = array();
    $section = str_replace("\r", "\n", $section);
    $tabAllDonneur = explode("\n", $section);
    /* trier les lignes */
    sort($tabAllDonneur);
    /* entrer les valeurs dans le tableau */
    foreach ($tabAllDonneur as $value) {
        $tabDonneur = explode(";", $value);
        array_push($data, $tabDonneur);
    }
    return $data;
}

/**
 * Travailler avec le fichier de code pour creer l'ordre de passage.
 * Ligne sous le format : "code de passage"; "code-barre"; passe (false par defaut).
 * passe = true quand le donneur est passe.
 */
/*
Ajouter un passage dans la liste.
$timeCode = construit a partir de generate_code
$codeDoneur = le type de don
$passe = le type de passage
Merci de ne pas modifier $nameFile.
*/
function saveLine(?string $timeCode, ?string $codeDoneur, bool $passe = false, ?string $nameFile = null):void {
    /* si on souhaite entrer l'emplacement sans passer par la config */
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_CODE;
    }
    $section = file_get_contents($nameFile, true);
    $tabsplit = str_split($section);
    $codecourt = "";
    file_put_contents($nameFile, $section."\n".$timeCode . ";" . $codeDoneur . ";" .($passe?"true":"false"));
}

/*
Recuperer la liste de passage.
Merci de ne pas modifier $nameFile.
*/
function listePassage(?string $nameFile = null):?array {
    /* si on souhaite entrer l'emplacement sans passer par la config */
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_CODE;
    }
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    /* creation du tableau de passage */
    $data = array();
    /* couper les ligne pour creer lordre de passage */
    $section = str_replace("\r", "\n", $section);
    $tabAllDonneur = explode("\n", $section);
    sort($tabAllDonneur);
    foreach ($tabAllDonneur as $value) {
        $tabDonneur = explode(";", $value);
        if(count($tabDonneur) > 2) {
            /* recupere les dons qui ne sont pas passes */
            if($tabDonneur[2] == "false") {
                array_push($data, $tabDonneur);
            }
        }
    }
    return $data;
}

/*
Pour signaler que le donneur est passe.
$timeCode = construit a partir de generate_code
Merci de ne pas modifier $nameFile.
*/
function donneurPasser(?string $timeCode, ?string $nameFile = null):void {
    /* si on souhaite entrer l'emplacement sans passer par la config */
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_CODE;
    }
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    /* conception du tableau */
    $data = array();
    $section = str_replace("\r", "\n", $section);
    $tabAllDonneur = explode("\n", $section);
    sort($tabAllDonneur);
    /* recuperer le bon donneur */
    foreach ($tabAllDonneur as $value) {
        $tabDonneur = explode(";", $value);
        if(count($tabDonneur) > 2) {
            if($tabDonneur[0] == $timeCode) {
                /* signaler qu'il est passe */
                $tabDonneur[2] = "true";
            }
            array_push($data, $tabDonneur);
        }
    }
    /* refaire le fichier */
    file_put_contents($nameFile, "");
    foreach ($data as $value) {
        saveLine($value[0], $value[1], $value[2]=="true");
    }
}

/*
effacer les valeur, pour repartir sur du codage propre en debut de journee.
*/
function clearFile():void {
    file_put_contents(FILE_COUNTER, "0000");
    file_put_contents(FILE_DATA_DEF, "");
    file_put_contents(FILE_DATA_CODE, "");
}
