<?php
require_once '../libs/tietokantayhteys.php';
require_once '../libs/models/move.php';

class Pokemon {

    private $poke_id;
    private $poke_name;
    private $height;
    private $weight;
    private $hp;
    private $attack;
    private $defense;
    private $sp_atk;
    private $sp_def;
    private $speed;
    private $ev_yield;
    private $type1;
    private $type2;
    
    public function __construct($poke_id, $poke_name, $height, $weight, $hp, $attack, $defense, $sp_atk, $sp_def, $speed, $ev_yield, $type1, $type2 = null) {

        $this->poke_id = $poke_id;
        $this->poke_name = $poke_name;
        $this->height = $height;
        $this->weight = $weight;
        $this->hp = $hp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->sp_atk = $sp_atk;
        $this->sp_def = $sp_def;
        $this->speed = $speed;
        $this->ev_yield = $ev_yield;
        $this->type1 = $type1;
        $this->type2 = $type2;

    }
    
    /*
     * PAlauttaa pokemonin tiedot ID:n avulle
     
    
    public function getPokemon($q_id) {
        $sql = "SELECT Pokemon.poke_id,Pokemon.poke_name,Pokemon.height,Pokemon.weight,Pokemon.hp,Pokemon.attack,Pokemon.defense,Pokemon.sp_atk,Pokemon.sp_def,Pokemon.speed, poke_type.type1, poke_type.type2,(SELECT array(SELECT DISTINCT move_id FROM poke_moves WHERE Pokemon.poke_id = poke_moves.poke_id)) AS moves FROM Pokemon, poke_type WHERE Pokemon.poke_id = ? AND poke_type.poke_id = Pokemon.poke_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($q_id));
        $poke_data = $kysely->fetchObject();
        if ($poke_data == null) { return null;}
        $Pokemon = new Pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $poke_data->type1, $poke_data->type2, $poke_data->moves
        );
        return $Pokemon;
    }
*/
    public static function lukumaara() {
        $sql = "SELECT count(*) FROM Pokemon";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }
    /*
     * Palauttaa kaikki pokemonit ja niiden tiedot, paitsi liikelistan
     * 
     */
    public function getAll($limit, $offset) {
        $sql = "SELECT Pokemon.poke_id, Pokemon.poke_name,Pokemon.height,Pokemon.weight,Pokemon.hp,Pokemon.attack,Pokemon.defense,Pokemon.sp_atk,Pokemon.sp_def,Pokemon.speed,Pokemon.ev_yield,poke_type.type1,poke_type.type2 FROM Pokemon, poke_type WHERE poke_type.poke_id = Pokemon.poke_id ORDER BY Pokemon.poke_id ASC LIMIT ? OFFSET ?";   
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($limit,$offset));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $poke_data) {
            $poke_data = new Pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, self::typeToString($poke_data->type1), self::typeToString($poke_data->type2)
        );
            $tulokset[] = $poke_data;
        }
        return $tulokset;           
    }

    /*
     * Palauttaa Pokemonin tiedot
     */
    
    public function getSimplePoke($p_id) {
        $sql = "SELECT Pokemon.poke_id,Pokemon.poke_name,Pokemon.height,Pokemon.weight,Pokemon.hp,Pokemon.attack,Pokemon.defense,Pokemon.sp_atk,Pokemon.sp_def,Pokemon.speed,Pokemon.ev_yield, poke_type.type1,poke_type.type2 FROM Pokemon, poke_type WHERE Pokemon.poke_id = ? AND poke_type.poke_id = Pokemon.poke_id";  
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($p_id));
        $poke_data = $kysely->fetchObject();
        if ($poke_data == null) { return null;}
        $palautus = new Pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $poke_data->type1, $poke_data->type2
        );
        return $palautus;
    }
    
    public function getMoveList() {
        $sql = "SELECT DISTINCT move_id FROM poke_moves WHERE poke_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->poke_id));
        $move_ids = $kysely->fetchAll();
        $moves = array();
        foreach ($move_ids as $mo) {
             $current = move::getMove(intval($mo));
             $moves = $current;
        }
        return $moves;
    }
    
    public function getTypes() {
        $sql = "SELECT type_id FROM types";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $type_ids = $kysely->fetchAll();
        return $type_ids;
    }
    
    public function getAllPokemon($limit, $offset) {
        $sql = "SELECT Pokemon.poke_id,Pokemon.poke_name,Pokemon.height,Pokemon.weight,Pokemon.hp,Pokemon.attack,Pokemon.defense,Pokemon.sp_atk,Pokemon.sp_def,Pokemon.speed, poke_type.type1, poke_type.type2,(SELECT array(SELECT DISTINCT move_id FROM poke_moves WHERE Pokemon.poke_id = poke_moves.poke_id)) AS moves FROM Pokemon, poke_type WHERE poke_type.poke_id = Pokemon.poke_id ORDER BY Pokemon.poke_id ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulokset = array($limit, $offset);
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $poke_data) {
            $poke_data = new Pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $poke_data->type1, $poke_data->type2, $poke_data->moves
        );
            $tulokset[] = $poke_data;
        }
        return $tulokset;        
    }

    public static function deletePoke($p_id) {
        $sql = "DELETE FROM Pokemon WHERE poke_id = ? RETURNING poke_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($p_id));
        if($ok) {
            return true;
        } else {
            return false;
        }
    }   
    
    public function updateMon($p_id) {
        $sql = "UPDATE Pokemon SET poke_name = ?, height = ?, weight = ?, hp = ?, attack = ?,defense = ?, sp_atk = ?, sp_def = ?, speed = ?, ev_yield = ? WHERE poke_id = ? RETURNING poke_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->poke_name, $this->height, $this->weight, $this->hp, $this->attack, $this->defense, $this->sp_atk, $this->sp_def, $this->speed, $this->ev_yield, $this->poke_id));
        if($ok) {
            return true;
        } else {
            return false;
        }
    }

    
    public function getType() {
       if(is_null($this->type2)) {
           return $this->type1;
       } else {
           return "$this->type1 / $this->type2";
       }
    }
    public function typeToString($t_id) {
        switch($t_id) {
            case 1: return "normal";
            case 2: return "fighting"; 
            case 3: return "flying";
            case 4: return "poison";
            case 5: return "ground";
            case 6: return"rock";
            case 7: return "bug";
            case 8: return "ghost";
            case 9: return "steel";
            case 10: return "fire";
            case 11: return "water";
            case 12: return "grass";
            case 13: return "electric";
            case 14: return "psychic";
            case 15: return "ice";
            case 16: return "dragon";
            case 17: return "dark";
            case 18: return "fairy";
            case 19: return "unknown";
            case 20: return "shadow";
            default: return null;
        }
    }

    public function setPoke_name($poke_name) {
        $this->poke_name = $poke_name;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function setDefense($defense) {
        $this->defense = $defense;
    }

    public function setSp_atk($sp_atk) {
        $this->sp_atk = $sp_atk;
    }

    public function setSp_def($sp_def) {
        $this->sp_def = $sp_def;
    }

    public function setSpeed($speed) {
        $this->speed = $speed;
    }

    public function setEv_yield($ev_yield) {
        $this->ev_yield = $ev_yield;
    }

    public function getPoke_id() {
        return $this->poke_id;
    }

    public function getPoke_name() {
        return $this->poke_name;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getHp() {
        return $this->hp;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function getSp_atk() {
        return $this->sp_atk;
    }

    public function getSp_def() {
        return $this->sp_def;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function getEv_yield() {
        return $this->ev_yield;
    }

    public function getType1() {
        return $this->type1;
    }

    public function getType2() {
        return $this->type2;
    }

    public function getMoves() {
        return $this->moves;
    }
}
