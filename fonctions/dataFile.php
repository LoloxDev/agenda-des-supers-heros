<?php 

include dirname(__FILE__) . '/config.php';

function loadFile(?string $nameFile = null):array {
    if(empty($nameFile)) {
        $nameFile = DATA_FILE_DEF;
    }
    $section = file_get_contents($nameFile, true);
    $data = array();
    $tabAllDonneur = explode("\n", $section);
    foreach ($tabAllDonneur as $value) {
        $tabDonneur = explode(",", $value);
        array_push($data, $tabDonneur);
    }
    return $data;
}

function saveLine(?string $timeCode, ?string $codeDoneur, bool $passe = false, ?string $nameFile = null):void {
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_CODE;
    }
    $section = file_get_contents($nameFile, true);
    file_put_contents($nameFile, $section."\n".$timeCode . "," . $codeDoneur . "," .($passe?"true":"false"));
}

function listePassage(?string $nameFile = null):?array {
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_CODE;
    }
    $section = file_get_contents($nameFile, true);
    $data = array();
    $tabAllDonneur = explode("\n", $section);
    foreach ($tabAllDonneur as $value) {
        $tabDonneur = explode(",", $value);
        if($tabDonneur[2] == "false") {
            array_push($data, $tabDonneur);
        }
        
    }
    return $data;
}

function donneurPasser(?string $timeCode, ?string $codeDoneur, ?string $nameFile = null):void {
    if(empty($nameFile)) {
        $nameFile = FILE_DATA_CODE;
    }
    $section = file_get_contents($nameFile, true);
    $data = array();
    $tabAllDonneur = explode("\n", $section);
    foreach ($tabAllDonneur as $value) {
        $tabDonneur = explode(",", $value);
        if($tabDonneur[2] == "false") {
            array_push($data, $tabDonneur);
        }
        
    }
    file_put_contents($nameFile, "");
    foreach ($data as $value) {
        saveLine($value[0], $value[1], $value[2]=="true");
    }
}

function clearFile():void {
    file_put_contents(FILE_COUNTER, "0000");
    file_put_contents(FILE_DATA_DEF, "");
    file_put_contents(FILE_DATA_CODE, "");
}
