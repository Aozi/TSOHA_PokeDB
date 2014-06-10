<?php
  require_once '../libs/common.php';
if (isUserLogged() == 2) {
    naytaNakyma("AdminPage.php");;
} else {
    naytaNakyma("Etusivu.php");
}