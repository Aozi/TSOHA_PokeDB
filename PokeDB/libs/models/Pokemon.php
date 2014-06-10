<?php
require_once '../libs/tietokantayhteys.php';

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
    private $moves = array();

    public function __construct($poke_id, $poke_name, $height, $weight, $hp, $attack, $defense, $sp_atk, $sp_def, $speed, $ev_yield/*, $type1, $type2, $moves*/) {

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
       /*
        $this->type1 = $type1;
        $this->type2 = $type2;
        $this->moves = $moves;
        * 
        */
    }
    
    /*
     * PAlauttaa pokemonin tiedot ID:n avulle
     */
    
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

    public static function lukumaara() {
        $sql = "SELECT count(*) FROM Pokemon";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }
    /*
     * Palauttaa kaikki pokemonit Pokemon taulusta
     * TÄllä hetkellä nopeampi joten käytetään testaukseen
     */
    public function getAll($limit, $offset) {
        $sql = "SELECT poke_id,poke_name,height,weight,hp,attack,defense,sp_atk,sp_def,speed,ev_yield FROM Pokemon ORDER BY poke_id ASC LIMIT ? OFFSET ?";   
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($limit,$offset));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $poke_data) {
            $poke_data = new Pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield
        );
            $tulokset[] = $poke_data;
        }
        return $tulokset;           
    }

    public function getSimplePoke($p_id) {
        $sql = "SELECT poke_id,poke_name,height,weight,hp,attack,defense,sp_atk,sp_def,speed,ev_yield FROM Pokemon WHERE poke_id = ?";   
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($p_id));
        $poke_data = $kysely->fetchObject();
        if ($poke_data == null) { return null;}
        $palautus = new Pokemon(
                $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield
        );
        return $palautus;
    }
    
    
    /*
     * Palauttaa kaikki pokemonit tietokannassa HIDAS
     * 
     */
    
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
