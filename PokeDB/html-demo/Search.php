<?php
  require_once '../libs/common.php';
  require_once '../libs/models/user.php';
  require_once '../libs/models/Pokemon.php';
  require_once '../libs/models/trainer_pokemon.php';

  
  
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
  
    if($_POST){
        session_start();
        if(isset($_POST['idToAdd']) && isset($_SESSION['kirjautunut'])) {
            $user = $_SESSION['kirjautunut'];
            $usid = $user->getId();
            addToUser($_POST['idToAdd'], $usid);
        }
    }  
  naytaNakyma("Search.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));
  

function addToUser($pokeToAdd, $uid) {    
    $lisatty = trainer_pokemon::addToTrainer(intval($pokeToAdd), $uid);
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
    if($lisatty == true) {
        naytaNakyma("Search.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));
    }
    naytaNakyma("Search.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));

}