<?php

    require_once '../libs/common.php';
    include '../libs/models/user.php';

    session_start();
    
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
        naytaNakyma("SignIn.php");
        exit(); // Lopetetaan suoritus tähän. Kutsun voi sijoittaa myös naytaNakyma-funktioon, niin sitä ei tarvitse toistaa joka paikassa
    }
    if (empty($_POST["username"])) {
        naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta"));
    }
    $kayttaja = $_POST["username"];

    if (empty($_POST["password"])) {
        naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa"));
    }
    $salasana = $_POST["password"];
    $nimi = $_POST['nimi'];
    //$user = etsiKayttajaTunnuksilla($kayttaja,$salasana);
    $user = 1;
    if(is_null($user)) {
        naytaNakyma("SignIn.php", array('kayttaja' => $kayttaja, 'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request));
    } else {
        $_SESSION['kirjautunut'] = $user;   
        naytaNakyma("Etusivu.php");
    }