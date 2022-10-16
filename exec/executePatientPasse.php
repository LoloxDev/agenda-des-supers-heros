<?php

include dirname(__FILE__) . '/../fonctions/dataFile.php';

donneurPasser($_GET['id']);

header('Location: ./../patientPasser.php');
exit();
