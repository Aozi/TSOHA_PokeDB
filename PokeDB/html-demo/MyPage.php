<?php
  require_once '../libs/common.php';
  require_once '../libs/models/user.php';
  require_once '../libs/models/trainer_pokemon.php';
  
  
  
  if (isUserLogged() == 2 || isUserLogged() == 1) {
    session_start();
    $user = $_SESSION['kirjautunut'];
    $uid = $user->getId();
    if($_POST){
        if(isset($_POST['idToDelete'])) {
            if(deleteFromUser($_POST['idToDelete'], $uid) == false) { naytaNakyma("Etusivu.php"); }
        }
    }
    $sivu = 1;
      if (isset($_GET['sivu'])) {
        $sivu = (int)$_GET['sivu'];

        //Sivunumero ei saa olla pienempi kuin yksi
        if ($sivu < 1) {$sivu = 1;}
      }
    $PokemonPerSivu= 30;
    $monit = trainer_pokemon::getAll($uid,$PokemonPerSivu,($sivu-1)*$PokemonPerSivu);

    $Mon_maara = trainer_pokemon::lukumaara($uid);
    $sivuja = ceil($Mon_maara/$PokemonPerSivu);
    naytaNakyma("MyPage.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));
    } else {
        naytaNakyma("Etusivu.php");
    }
    
    function deleteFromUser($d_id, $u_id) {
        $ok = trainer_pokemon::deletePoke(intval($d_id), intval($u_id));
        if(isset($_POST['idToDelete'])) {
            unset($_POST['idToDelete']);
        }
        if($ok) {
            return true;
        } else {
            return false;
        }
    }

    
