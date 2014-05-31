<?php

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
    private $moves = array();

    public function __construct($poke_id, $poke_name, $height, $weight, $hp, $attack, $defense, $sp_atk, $sp_def, $speed, $ev_yield, $type1, $type2, $moves, $trainer_id, $cus_id) {
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
        $this->type1 = $type1;
        $this->type2 = $type2;
        $this->moves = $moves;
    }

    public function getTrainerPokemon($q_id) {
        $sql = "SELECT cus_id, poke_id,poke_name,height,weight,hp,attack,defense,sp_atk,sp_def,speed FROM trainer_pokemon WHERE cus_id == ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $poke_data = $kysely->execute(array($q_id));
        if ($poke_data == null)
            return null;
        $type_sql = "SELECT type1, type2 FROM poke_type WHERE poke_id == ?";
        $move_sql = "SELECT move_id FROM poke_moves WHERE poke_id == ?";
        $kysely2 = getTietokantayhteys()->prepare($type_sql);
        $kysely3 = getTietokantayhteys()->prepare($move_sql);
        $type_data = $kysely2->execute(array($q_id));
        $move_data = $kysely3->execute(array($q_id));
        $Pokemon = new Pokemon(
                $poke_data->cus_id, $poke_data->poke_id, $poke_data->poke_name, $poke_data->height, $poke_data->weight, $poke_data->hp, $poke_data->attack, $poke_data->defense, $poke_data->sp_atk, $poke_data->sp_def, $poke_data->speed, $poke_data->ev_yield, $type_data->type1, $type_data->type2, $move_data
        );
        return $Pokemon;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        $trace = debug_backtrace();
        trigger_error(
                'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'], E_USER_NOTICE);
        return null;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

}
