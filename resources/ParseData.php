<?php
    $poke_poke_id = null;
    $poke_poke_name = null;
    $poke_height = null;
    $poke_weight = null;
    $poke_hp = null;
    $poke_attack = null;
    $poke_defense = null;
    $poke_sp_atk = null;
    $poke_sp_def = null;
    $poke_speed = null;
    $poke_ev_yield = null;
    $poke_type1 = null;
    $poke_type2 = null;
    $counter = 1;
    //$con=mysqli_connect("example.com","peter","abc123","my_db");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    while($counter <= 718 ) {
        $current_poke = ('http://pokeapi.co./api/v1/pokemon/'.$counter.'/');
        $pokeread = json_decode($current_poke);
        $poke_poke_name = $pokeread['name'];
        $poke_height = $pokeread['height'];
        $poke_weight = $pokeread['weight'];
        $poke_hp = $pokeread['hp'];
        $poke_attack = $pokeread['attack'];
        $poke_sp_atk = $pokeread['sp_atk'];
        $poke_sp_def = $pokeread['sp_def'];
        $poke_speed = $pokeread['speed'];
        $poke_ev_yield = $pokeread['ev_yiel'];
        
        mysqli_query($con, "INSERT INTO Pokemon (poke_id, poke_name, height,weight,hp,attack,defense,sp_atk,sp_def,speed,ev_yield)
                            VALUES ($counter, $poke_poke_name, $poke_height, $poke_weight, $poke_hp, $poke_attack, $poke_defense, $poke_sp_atk, $poke_sp_def, $poke_speed, $poke_ev_yield");
        
        $counter = $counter+1;
    }
    
    //parse moves
    $move_id = null;
    $move_name = null;
    $description = null;
    $power = null;
    $move_PP = null;
    $accuarcy = null;
    $counter = 1;
    while(counter <= 625) {
        
        $current_move = ('http://pokeapi.co./api/v1/move/'.$counter.'/');
        $moveread = json_decode($current_move);
        $move_id = $moveread['id'];
        $move_name = $moveread['name'];
        $description = $moveread['description'];
        $power = $moveread['power'];
        $move_PP = $moveread['pp'];
        $accuarcy = $moveread['accuarcy'];
        
        mysqli_query($con, "INSERT INTO moves (move_id,move_name,description,power,move_pp,accuarcy)
                            VALUES($move_id,$move_name,$description,$power,$move_PP,$accuarcy");
    }