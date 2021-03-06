<?php

require_once '../libs/tietokantayhteys.php';
require_once '../libs/models/Pokemon.php';
require_once '../libs/models/trainer_pokemon.php';
class trainer_pokemon {

    private $cus_id;
    private $trainer_id;
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
    private $on_team;

    public function __construct($poke_id, $poke_name, $height, $weight, $hp, $attack, $defense, $sp_atk, $sp_def, $speed, $ev_yield, $on_team, $type1, $type2 = null, $trainer_id, $cus_id) {
        $this->cus_id = $cus_id;
        $this->trainer_id = $trainer_id;
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
        $this->on_team = $on_team;
        $this->type1 = $type1;
        $this->type2 = $type2;
    }
/*
    public function getAllTrainerPokemon($q_id) {
        $sql = "SELECT trainer_pokemon.trainer_id, trainer_pokemon.cus_id, trainer_pokemon.poke_id,trainer_pokemon.poke_name,trainer_pokemon.height,trainer_pokemon.weight,trainer_pokemon.hp,trainer_pokemon.attack,trainer_pokemon.defense,trainer_pokemon.sp_atk,trainer_pokemon.sp_def,trainer_pokemon.speed, poke_type.type1, poke_type.type2,(SELECT array(SELECT DISTINCT move_id FROM poke_moves WHERE trainer_pokemon.poke_id = poke_moves.poke_id)) AS moves FROM trainer_pokemon, poke_type WHERE poke_type.poke_id = trainer_pokemon.poke_id AND trainer_pokemon.trainer_id = ?";        
        $kysely = getTietokantayhteys()->prepare($sql);
        $tulos = $kysely->execute(array($q_id));
        if ($tulos == null) return null;
        foreach ($tulos->fetchAll(PDO::FETCH_OBJ) as $poke_data) {
            $t_pokemon = new trainer_pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $type_data->type1, $type_data->type2, $poke_data->moves, $poke_data->trainer_id, $poke_data->cus_id
        );
            $tulokset[] = $t_pokemon;
        }
        return $tulokset;
    }

    public function getTrainerPokemon($t_id, $c_id) {
        $sql = "SELECT trainer_pokemon.trainer_id, trainer_pokemon.cus_id, trainer_pokemon.poke_id,trainer_pokemon.poke_name,trainer_pokemon.height,trainer_pokemon.weight,trainer_pokemon.hp,trainer_pokemon.attack,trainer_pokemon.defense,trainer_pokemon.sp_atk,trainer_pokemon.sp_def,trainer_pokemon.speed, poke_type.type1, poke_type.type2,(SELECT array(SELECT DISTINCT move_id FROM poke_moves WHERE trainer_pokemon.poke_id = poke_moves.poke_id)) AS moves FROM trainer_pokemon, poke_type WHERE poke_type.poke_id = trainer_pokemon.poke_id AND trainer_pokemon.trainer_id = ? AND trainer_pokemon.cus_id = ?";
    
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($q_id));
        $poke_data = $kysely->fetchObject();
        if ($poke_data == null) return null;
            $t_pokemon = new trainer_pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $type_data->type1, $type_data->type2, $poke_data->moves, $poke_data->trainer_id, $poke_data->cus_id
        );
         return $t_pokemon;   
    }
*/

    public function getTypes() {
        $sql = "SELECT type_id FROM types";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $type_ids = $kysely->fetchAll();
        return $type_ids;
    }
    
    public function addToTrainer($p,$t_id) {
        $poke = Pokemon::getSimplePoke($p);
        $sql = "INSERT INTO trainer_pokemon(poke_id,trainer_id,poke_name,height,weight,hp,attack,defense,sp_atk,sp_def,speed,poke_level,ev_yield,on_team) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?) RETURNING cust_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($poke->getPoke_id(), $t_id, $poke->getPoke_name(), $poke->getHeight(), $poke->getWeight(), $poke->getHP(), $poke->getAttack(), $poke->getDefense(), $poke->getSp_atk(), $poke->getSp_def(), $poke->getSpeed(), 0, $poke->getEv_yield(), 0));
        if($ok) {
            return TRUE;
        } else {
            return false;
        } 
    }
    
    public function getAll($t_id,$limit, $offset) {
         $sql = "SELECT trainer_pokemon.cust_id, trainer_pokemon.poke_id, trainer_pokemon.poke_name,trainer_pokemon.height,trainer_pokemon.weight,trainer_pokemon.hp,trainer_pokemon.attack,trainer_pokemon.defense,trainer_pokemon.sp_atk,trainer_pokemon.sp_def,trainer_pokemon.speed,trainer_pokemon.ev_yield, trainer_pokemon.on_team, poke_type.type1,poke_type.type2 FROM trainer_pokemon, poke_type WHERE trainer_pokemon.trainer_id = ? AND poke_type.poke_id = trainer_pokemon.poke_id ORDER BY trainer_pokemon.poke_id ASC LIMIT ? OFFSET ?";     
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($t_id, $limit, $offset));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $poke_data) {
            $poke_data = new trainer_pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $poke_data->on_team, $t_id, $poke_data->type1, $poke_data->type2, $poke_data->cust_id);
            $tulokset[] = $poke_data;
        }
        return $tulokset;           
    }
    
    public static function lukumaara($t_id) {
        $sql = "SELECT count(*) FROM trainer_pokemon WHERE trainer_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($t_id));
        return $kysely->fetchColumn();
    }
  
        public static function getPoke($p_id, $u_id) {
        $sql = "SELECT trainer_pokemon.cust_id, trainer_pokemon.poke_id, trainer_pokemon.poke_name,trainer_pokemon.height,trainer_pokemon.weight,trainer_pokemon.hp,trainer_pokemon.attack,trainer_pokemon.defense,trainer_pokemon.sp_atk,trainer_pokemon.sp_def,trainer_pokemon.speed,trainer_pokemon.ev_yield, trainer_pokemon.on_team, poke_type.type1,poke_type.type2 FROM trainer_pokemon, poke_type WHERE trainer_pokemon.cust_id = ? AND trainer_pokemon.trainer_id = ? AND poke_type.poke_id = trainer_pokemon.poke_id LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($p_id, $u_id));
        $poke_data = $kysely->fetchObject();
        if ($poke_data == null) { return null;}
        $palautus = new trainer_pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $poke_data->on_team, $poke_data->type1,$poke_data->type2, $u_id, $p_id
        );
        return $palautus;
    }
    
    
    public static function deletePoke($p_id, $u_id) {
        $sql = "DELETE FROM trainer_pokemon WHERE cust_id = ? AND trainer_id = ? RETURNING cust_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($p_id, $u_id));
        if($ok) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateMon() {
        $sql = "UPDATE trainer_pokemon SET poke_name = ?, height = ?, weight = ?, hp = ?, attack = ?,defense = ?, sp_atk = ?, sp_def = ?, speed = ?, ev_yield = ? WHERE cust_id = ? RETURNING cust_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->poke_name, $this->height, $this->weight, $this->hp, $this->attack, $this->defense, $this->sp_atk, $this->sp_def, $this->speed, $this->ev_yield, $this->cus_id));
        if($ok) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getType($num) {
        switch($num) {
            case 1: return $this->type1;
            case 2: return $this->type2;
            case 3: return null;
        }
    }
    
    public function resetToDef() {
        $new_value = Pokemon::getSimplePoke($this->poke_id);
        $this->setPoke_name($new_value->getPoke_name());
        $this->setHeight($new_value->getHeight());
        $this->setWeight($new_value->getWeight());
        $this->setHp($new_value->getHp());
        $this->setAttack($new_value->getAttack());
        $this->setDefense($new_value->getDefense());
        $this->setSp_atk($new_value->getSp_atk());
        $this->setSp_def($new_value->getSp_def());
        $this->setSpeed($new_value->getSpeed());
        $this->setEv_yield($new_value->getEv_yield());
        $this->updateMon();
    }
    
    public function getOn_team() {
        return $this->on_team;
    }
    
    public function getCus_id() {
        return $this->cus_id;
    }

    public function getTrainer_id() {
        return $this->trainer_id;
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

    public function setCus_id($cus_id) {
        $this->cus_id = $cus_id;
    }

    public function setTrainer_id($trainer_id) {
        $this->trainer_id = $trainer_id;
    }

    public function setPoke_id($poke_id) {
        $this->poke_id = $poke_id;
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
}
