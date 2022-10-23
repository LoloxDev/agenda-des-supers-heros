<?php
/**
 * Quand le donneur est passer, le retirer de la liste d'attente
 */

/* pour travailler sur l'un des fichiers */
include dirname(__FILE__) . '/../fonctions/dataFile.php';

/* signale que le donneur est passe */
donneurPasser($_GET['id']);

/* rafraichit la page */
header('Location: ./../donneurPasser.php');
exit();
