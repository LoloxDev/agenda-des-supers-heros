<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style/normalizer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <style>
        .list-tab {
            display: flex;
            flex-direction: column;
        }

        a {
            padding: 10px 30px;
            background-color: #e20020;
            color: white;
            transition: 0.2s;
            cursor: pointer;
            box-shadow: inset 0px 0px 5px white;
        }

        a:hover {
        transform: scale(1.05);
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div id="form">
        <div id="logo">
            <img src="img/EFS-logo.png" alt="logo EFS"/>
        </div>
        <legend class="title">Choisir la page à afficher</legend>
        <div class="table list-tab">
            <a class="btn btn-primary" href="./enregistrement.php">accueil</a>
            <a class="btn btn-primary" href="./ordrePassage.php">la salle d'attente</a>
            <a class="btn btn-primary" href="./donneurPasser.php">le donneur est passé</a>
            <a class="btn btn-primary" href="./troisEcran.php">les trois</a>
            <a class="btn btn-primary" href="./config.php">config</a>
            <a class="btn btn-primary" href="./quatreEcran.php">les quatre</a>
        </div>
        <legend class="title">Choisir le fichier à afficher</legend>
        <div class="table list-tab">
            <a class="btn btn-primary" href="./data/counter.txt">counter.txt</a>
            <a class="btn btn-primary" href="./data/data.csv">data.csv</a>
            <a class="btn btn-primary" href="./data/dataCode.csv">dataCode.csv</a>
        </div>
    </div>
</body>
</html>