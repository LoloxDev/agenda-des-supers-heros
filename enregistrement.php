<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style/normalizer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Entrée des donnateurs</title>
</head>
<body>
    <!-- Debut du formulaire -->
    <form enctype="multipart/form-data" action="exec/traitement_entree.php" method="post" name="test">
        <div id="logo">
            <img src="img/EFS-logo.png" alt="logo EFS"/>
        </div>
            <legend class="title">Formulaire de rentrée</legend>
                
                <div id="bloodChoice">
                    <label for="blood">Choisissez un type de sang :</label>
                    <select name="blood" id="bloodList">

                        <option value="">-- Choisissez une option --</option>
                        <option value="3">Sang total</option>
                        <option value="2">Plasma</option>
                        <option value="1">Plaquette</option>

                    </select>
                </div>

                <fieldset id="rdv">

                    <legend class="secondTitle">Le donneur a-t-il un rendez-vous?</legend>

                    <div>
                      <input type="radio" id="oui" name="rdv" value="oui"
                             checked>
                      <label for="oui">Oui</label>
                    </div>

                    <div>
                      <input type="radio" id="non" name="rdv" value="non">
                      <label for="non">Non</label>
                    </div>

                </fieldset>

                <input type="submit" name="submit" />
    </form>
    <!-- Fin du formulaire -->
</body>
</html>