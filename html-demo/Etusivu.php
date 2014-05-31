<?php
  require_once '../libs/common.php';
  session_start();
  if (isset($_SESSION['kayttaja'])) {
    $kayttaja = $_SESSION['kayttaja'];
    naytaNakyma("Etusivu.php",array('kayttaja' => "Onneksi olkoon kirjauduit sisään!"));
  }

  naytaNakyma("Etusivu.php");