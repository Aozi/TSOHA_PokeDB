<?php
  session_start();
  /* Näyttää näkymätiedoston ja lähettää sille muuttujat */
  function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
    require '../libs/Views/pohja.php';
    exit();
  }
  
  function isUserLogged() {
    if (isset($_SESSION['kayttaja'])) {
      return true;
    }
  }