<?php 

/* lire le fichier de configuration */
include dirname(__FILE__) . '/configMain.php';

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
function loadFile():array {
    $nameFile = FILE_DATA_DEF;
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    /* creation du tableau */
    $data = array();
    $section = str_replace("\r", "\n", $section);
    $tabAllDonneur = explode("\n", $section);
    /* trier les lignes */
    sort($tabAllDonneur);
    /* entrer les valeurs dans le tableau */
    if(!empty($tabAllDonneur)) {
        foreach ($tabAllDonneur as $value) {
            $tabDonneur = explode(";", $value);
            array_push($data, $tabDonneur);
        }
    }
    return $data;
}

/* modifier le fichier de l'agenda (provisoire) */
/**
 * $date = "H:i"
 * $type = le type de don
 */
function retireDate(?string $date, int $type):void {
    /* si on souhaite entrer l'emplacement sans passer par la config */
    $nameFile = FILE_DATA_DEF;

    $tabAllDonneur = loadFile();
    $valueCSV = "";

    if(!empty($tabAllDonneur)) {
        foreach ($tabAllDonneur as $value) {
            if($value[0]==$date && intval($value[3])==0 && intval($value[1]) == $type) {
                $value[3] = 1;
            }
            $valueCSV .= implode(";",$value)."\n";
        }
    }

    file_put_contents($nameFile, $valueCSV);
}

function addDate(?string $date, int $type):void {
    $nameFile = FILE_DATA_DEF;
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    $section = str_replace("\r", "\n", $section);
    file_put_contents($nameFile, str_replace("\n\n", "\n", $section."\n".$date . ";" . $type . ";1;0"));
}

/* afficher les 4 dernier chiffre du code-barre */
function display($text) {
    if(strlen($text) > 4) {
        return substr($text, strlen($text)-4, 4);
    }
 return $text;
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
function saveLine(?string $timeCode, ?string $codeDoneur, bool $passe = false):void {
    $nameFile = FILE_DATA_CODE;
    $section = file_get_contents($nameFile, true);
    file_put_contents($nameFile, $section."\n".$timeCode . ";" . display($codeDoneur) . ";" .($passe?"true":"false"));
}

/*
Recuperer la liste de passage.
Merci de ne pas modifier $nameFile.
*/
function listePassage():?array {
    $nameFile = FILE_DATA_CODE;
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    /* creation du tableau de passage */
    $data = array();
    /* couper les ligne pour creer lordre de passage */
    $section = str_replace("\r", "\n", $section);
    $tabAllDonneur = explode("\n", $section);
    sort($tabAllDonneur);
    if(!empty($tabAllDonneur)) {
        foreach ($tabAllDonneur as $value) {
            $tabDonneur = explode(";", $value);
            if(count($tabDonneur) > 2) {
                /* recupere les dons qui ne sont pas passes */
                if($tabDonneur[2] == "false") {
                    array_push($data, $tabDonneur);
                }
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
function donneurPasser(?string $timeCode):void {
    $nameFile = FILE_DATA_CODE;
    /* lire le fichier */
    $section = file_get_contents($nameFile, true);
    /* conception du tableau */
    $data = array();
    $section = str_replace("\r", "\n", $section);
    $tabAllDonneur = explode("\n", $section);
    /* recuperer le bon donneur */
    if(!empty($tabAllDonneur)) {
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
    }
    /* refaire le fichier */
    file_put_contents($nameFile, "");
    if(!empty($data)) {
        foreach ($data as $value) {
            saveLine($value[0], $value[1], $value[2]=="true");
        }
    }
}

/**
 * Ajouter 1 au nombre qui est dans le fichier count.txt
 */
function addAppointmentNumber():?string {
    // Ajoute le numero du rendez vous de la journée pour les cas speciaux
    $counter = (int) file_get_contents(FILE_COUNTER) +1 ;
  
    $counter = str_pad($counter , 4 , "0" , STR_PAD_LEFT);
    file_put_contents(FILE_COUNTER,$counter);
    return $counter;
}

/*
effacer les valeur, pour repartir sur du codage propre en debut de journee.
*/
function clearFile():void {
    file_put_contents(FILE_COUNTER, "0000");
    file_put_contents(FILE_DATA_DEF, "");
    file_put_contents(FILE_DATA_CODE, "");
}

/*
mettre en place une base de test.
*/
function baseDeTest():void {
    file_put_contents(FILE_COUNTER, file_get_contents(FILE_COUNTER_DEF, true));
    file_put_contents(FILE_DATA_DEF, file_get_contents(FILE_DATA_DEF_DEF, true));
    file_put_contents(FILE_DATA_CODE, file_get_contents(FILE_DATA_CODE_DEF, true));
}
