<?php

include dirname(__FILE__) . '/fonctions/dataFile.php';

heurePresence();

function display($text) {
    if(strlen($text) > 4) {
        return substr($text, strlen($text)-4, 4);
    }
 return $text;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body  style="font-size: 5em;">
    <section class="container">
        <table class="table table-striped table-hover text-center">
            <body>
                <?php $values = listePassage();
                foreach ($values as $value) {
                    if(trim($value[2]) == "false") { ?>
                        <tr>
                            <td>
                                <?php echo display($value[1]); ?>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </body>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
<script>

</script>
</html>