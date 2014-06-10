<?php

require_once '../libs/common.php';
require_once '../libs/models/user.php';

if (empty($_POST["username"])) {
    naytaNakyma("SignIn.php", array('kayttaja' => "", 'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta"));
}
$kayttaja = $_POST["username"];

if (empty($_POST["password"])) {
    naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa"));
}
$salasana = $_POST["password"];
session_start();

if (isset($_POST['register'])) {
    if (user::nameExist($kayttaja)) {
        naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Käyttäjänimi on jo olemassa", 'request'));
    }
    $uusi = user::uusiKayttaja($kayttaja, $salasana);
    if ($uusi == true) {
        naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Rekisteröityminen onnistui! Voit kirjautua sisään", 'request'));
    } elseif ($uusi == false) {
        naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Rekisteröityminen epäonnistui!", 'request'));
    }
}
$user = user::etsiKayttajaTunnuksilla($kayttaja, $salasana);
if (is_null($user)) {
    naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", 'request'));
} else {
    if ($user->getId() == 1) {
        $_SESSION['admin'] = $user;
        naytaNakyma("Etusivu.php");
    } else {
        $_SESSION['kirjautunut'] = $user;
        naytaNakyma("Etusivu.php");
    }
}