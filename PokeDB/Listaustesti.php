<?php 
//require_once sisällyttää annetun tiedoston vain kerran
require_once "libs/tietokantayhteys.php";
require_once "libs/models/user.php";

//Lista asioista array-tietotyyppiin laitettuna:
$lista = user::etsiKaikkiKayttajat();
?>
<!DOCTYPE HTML>
<html>
    <head><title>Listatesti</title></head>
    <body>
        <h1>Listaustesti</h1>
        <ul>
            <?php foreach ($lista as $item) { ?>
            <li><?php echo $item->getUsername(); ?></li>
            <?php } ?>
        </ul>
    </body>
</html>