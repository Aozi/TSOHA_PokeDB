<?php
    require_once "../libs/tietokantayhteys.php";
    $counter = 1;
    $sql = "INSERT INTO Pokemon (poke_id, poke_name, height,weight,hp,attack,defense,sp_atk,sp_def,speed,ev_yield) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql);

    while($counter <= 718 ) {
        $current_pokeGET = ('http://pokeapi.co/api/v1/pokemon/'.$counter.'/');
        $current_poke = file_get_contents($current_pokeGET);
        $pokeread = json_decode($current_poke,TRUE);
        $ok = $kysely->execute(array($counter,$pokeread['name'],intval($pokeread['height']),intval($pokeread['weight']),intval($pokeread['hp']),intval($pokeread['attack']),intval($pokeread['defense']),intval($pokeread['sp_atk']),intval($pokeread['sp_def']),intval($pokeread['speed']),intval($pokeread['ev_yield'])));
        echo $counter," - ", $pokeread['name'],"\n";
        $counter = $counter+1;
    }
    echo "DONE!";