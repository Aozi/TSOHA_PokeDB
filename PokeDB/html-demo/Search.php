<?php
  require_once '../libs/common.php';
  require_once '../libs/models/user.php';
  require_once '../libs/models/Pokemon.php';
  require_once '../libs/models/trainer_pokemon.php';

  
   if($_POST){
        session_start();
        if(isset($_POST['idToAdd']) && isset($_SESSION['kirjautunut'])) {
            $user = $_SESSION['kirjautunut'];
            $usid = $user->getId();
            addToUser($_POST['idToAdd'], $usid);
        }
    } 
  $sivu = 1;
  if (isset($_GET['sivu'])) {
    $sivu = (int)$_GET['sivu'];

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1) {$sivu = 1;}
  }
  $PokemonPerSivu= 30;
  
  $monit = Pokemon::getAll($PokemonPerSivu,($sivu-1)*$PokemonPerSivu);

  $Mon_maara = Pokemon::lukumaara();
  $sivuja = ceil($Mon_maara/$PokemonPerSivu); 
  naytaNakyma("Search.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));
  

function addToUser($pokeToAdd, $uid) {    
    trainer_pokemon::addToTrainer(intval($pokeToAdd), $uid);
}