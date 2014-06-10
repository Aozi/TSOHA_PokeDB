<?php
  require_once '../libs/common.php';
  require_once '../libs/models/user.php';
  require_once '../libs/models/trainer_pokemon.php';
  
  if (isUserLogged() == 2 || isUserLogged() == 1) {
    $sivu = 1;
      if (isset($_GET['sivu'])) {
        $sivu = (int)$_GET['sivu'];

        //Sivunumero ei saa olla pienempi kuin yksi
        if ($sivu < 1) {$sivu = 1;}
      }
    session_start();
    $user = $_SESSION['kirjautunut'];
    $uid = $user->getId();
    $PokemonPerSivu= 30;
    
    if($_POST){
        if(isset($_POST['idToDelete'])) {
            deleteFromUser($_POST['idToDelete'], $uid);
        } elseif(isset($_POST['pokeToShow'])) {
            
        } elseif(isset($_POST['pokeToMod'])) {
            
        }
    }  
    
    $monit = trainer_pokemon::getAll($uid,$PokemonPerSivu,($sivu-1)*$PokemonPerSivu);

    $Mon_maara = trainer_pokemon::lukumaara($uid);
    $sivuja = ceil($Mon_maara/$PokemonPerSivu);
    naytaNakyma("MyPage.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));
    } else {
        naytaNakyma("Etusivu.php");
    }
