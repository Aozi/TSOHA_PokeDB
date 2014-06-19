<?php
  require_once '../libs/common.php';
  require_once '../libs/models/user.php';
  require_once '../libs/models/trainer_pokemon.php';
  require_once '../libs/models/Pokemon.php';
  require_once '../libs/common.php';
if (isUserLogged() == 2) {
    if($_POST){
        
        if(isset($_POST['idToDelete'])) {
            if(deleteFromDB($_POST['idToDelete']) == false) { naytaNakyma("Etusivu.php"); }
        }
        elseif(isset ($_POST['Save'])) {
            $load_poke = Pokemon::getSimplePoke(intval($_POST['Save']));
            $vals = array();
            $vals = $_POST[$load_poke->getPoke_id()];
            modPoke($load_poke,$vals);
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
    naytaNakyma("AdminPage.php", array('Pokemonit' => $monit, 'sivu'=>$sivu, 'maara'=>$Mon_maara,'sivuja'=>$sivuja));
    } else {
        naytaNakyma("Etusivu.php");
    }
    
    function deleteFromUser($d_id, $u_id) {
        $ok = Pokemon::deletePoke(intval($d_id));
        if(isset($_POST['idToDelete'])) {
            unset($_POST['idToDelete']);
        }
        if($ok) {
            return true;
        } else {
            return false;
        }
    }
    
    function modPoke($poke,$args) {
        if(!empty($args[0])) {
            $poke->setPoke_name($args[0]);
        }
        if(!empty($args[1])) {
            $poke->setHeight(intval($args[1]));
        }
        if(!empty($args[2])) {
            $poke->setWeight(intval($args[2]));
        }
        if(!empty($args[3])) {
            $poke->setHp(intval($args[3]));
        }
        if(!empty($args[4])) {
            $poke->setAttack(intval($args[4]));
        }       
        if(!empty($args[5])) {
            $poke->setDefense(intval($args[5]));
        }        
         if(!empty($args[6])) {
            $poke->setSp_atk(intval($args[6]));
        }       
         if(!empty($args[7])) {
            $poke->setSp_def(intval($args[7]));
        }       
         if(!empty($args[8])) {
            $poke->setSpeed(intval($args[8]));
        }       
         if(!empty($args[9])) {
            $poke->setEv_yield(intval($args[9]));
        }
        $poke->updateMon();
    }