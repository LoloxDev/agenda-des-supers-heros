<?php

/* verifier qu'on n'a pas deja lu le fichier de configuration */
if (!defined('FILE_COUNTER') && !defined('FILE_DATA_DEF') && !defined('FILE_DATA_CODE')) {
    /* lire de fichier de configuration */
    include dirname(__FILE__) . '/../config/config.php';
}

/* verifier qu'on n'a pas deja lu le fichier de configuration */
if (!defined('DURAT_PLASMA') && !defined('DURAT_PLAQUETTE') && !defined('DURAT_NO_RDV')) {
    /* lire de fichier de configuration */
    include dirname(__FILE__) . '/../config/configDuration.php';
}
