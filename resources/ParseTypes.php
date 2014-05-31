<?php
    require_once "../libs/tietokantayhteys.php";
    $counter = 1;
    $sql = "INSERT INTO poke_type (poke_id, type1,type2) VALUES(?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql);

    $type1_id = null;
    $type2_id = null;
    
    while($counter <= 718 ) {
        $current_pokeGET = ('http://pokeapi.co/api/v1/pokemon/'.$counter.'/');
        $current_poke = file_get_contents($current_pokeGET);
        $pokeread = json_decode($current_poke,TRUE);
        $type1 = $pokeread['types'][0]['name'];
        switch ($type1) {
            case 'normal':
                $type1_id = 1;
                break;
            case 'fighting':
                $type1_id = 2;
                break;
            case 'flying':
                $type1_id = 3;
                break;
            case 'poison':
                $type1_id = 4;
                break;
            case 'ground':
                $type1_id = 5;
                break;
            case 'rock':
                $type1_id = 6;
                break;
            case 'bug':
                $type1_id = 7;
                break;
            case 'ghost':
                $type1_id = 8;
                break;
            case 'steel':
                $type1_id = 9;
                break;
            case 'fire':
                $type1_id = 10;
                break;
            case 'water':
                $type1_id = 11;
                break;
            case 'grass':
                $type1_id = 12;
                break;
            case 'electric':
                $type1_id = 13;
                break;
            case 'psychic':
                $type1_id = 14;
                break;
            case 'ice':
                $type1_id = 15;
                break;
            case 'dragon':
                $type1_id = 16;
                break;
            case 'dark':
                $type1_id = 17;
                break;
            case 'fairy':
                $type1_id = 18;
                break;
            case 'unknown':
                $type1_id = 19;
                break;
            case 'shadow':
                $type1_id = 20;
                break;
        }
        if (isset($pokeread['types'][1])) {
            $type2 = $pokeread['types'][1]['name'];
            switch ($type2) {
                case 'normal':
                    $type2_id = 1;
                    break;
                case 'fighting':
                    $type2_id = 2;
                    break;
                case 'flying':
                    $type2_id = 3;
                    break;
                case 'poison':
                    $type2_id = 4;
                    break;
                case 'ground':
                    $type2_id = 5;
                    break;
                case 'rock':
                    $type2_id = 6;
                    break;
                case 'bug':
                    $type2_id = 7;
                    break;
                case 'ghost':
                    $type2_id = 8;
                    break;
                case 'steel':
                    $type2_id = 9;
                    break;
                case 'fire':
                    $type2_id = 10;
                    break;
                case 'water':
                    $type2_id = 11;
                    break;
                case 'grass':
                    $type2_id = 12;
                    break;
                case 'electric':
                    $type2_id = 13;
                    break;
                case 'psychic':
                    $type2_id = 14;
                    break;
                case 'ice':
                    $type2_id = 15;
                    break;
                case 'dragon':
                    $type2_id = 16;
                    break;
                case 'dark':
                    $type2_id = 17;
                    break;
                case 'fairy':
                    $type2_id = 18;
                    break;
                case 'unknown':
                    $type2_id = 19;
                    break;
                case 'shadow':
                    $type2_id = 20;
                    break;
            }
        } else {
            $type2_id = null;
        }
        $ok = $kysely->execute(array($counter,$type1_id,$type2_id));
        echo $counter," - ", $pokeread['name']," - ",$type1_id," - ",$type2_id,"\n";
        $counter = $counter+1;
    }
    echo "DONE!\n";