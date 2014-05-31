<?php
    require_once "../libs/tietokantayhteys.php";
    //parse moves
    $counter2 = 1;
    $sql2 = "INSERT INTO moves (move_id, move_name, description,power,move_PP,accuarcy) VALUES(?,?,?,?,?,?)";
    $kysely2 = getTietokantayhteys()->prepare($sql2);
    while($counter2 <= 625) {        
        $current_move = ('http://pokeapi.co/api/v1/move/'.$counter2.'/');
        $move_content = file_get_contents($current_move);
        $moveread = json_decode($move_content,TRUE);
        $ok2 = $kysely2->execute(array(intval($moveread['id']),$moveread['name'],$moveread['description'],intval($moveread['power']),intval($moveread['pp']),intval($moveread['accuracy'])));
        echo $counter2," - ", $moveread['name'],"\n";
        $counter2 = $counter2+1;
    }
    echo "DONE!";