<?php
  /* Näyttää näkymätiedoston ja lähettää sille muuttujat */
  function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
    require '../libs/Views/pohja.php';
    exit();
  }
  
  function isUserLogged() {
        if(session_id() == '') {
            session_start();
        }
    if (isset($_SESSION['admin'])) {
        return 2;
    }
    else if (isset($_SESSION['kirjautunut'])) {
        return 1;
    } else {
        return 0;
    }
  }
  
  function userLogout() {
    session_start();
    if (isset($_SESSION['admin'])) {
        unset($_SESSION["admin"]);
    }
    else {
        unset($_SESSION["kirjautunut"]);
    } 
    header('Location: Etusivu.php');
}