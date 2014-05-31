<?php

class move {
    private $move_id;
    private $move_name;
    private $description;
    private $power;
    private $move_PP;
    private $accuarcy;
    
    public function __construct($move_id, $move_name, $description, $power,$move_pp,$accuarcy) {
        $this->move_id = $move_id;
        $this->move_name = $move_name;
        $this->description = $description;
        $this->power = $power;
        $this->move_PP = $move_PP;
        $this->accuarcy = $accuarcy;
    }
    
    public function getMove($m_id) {
        $sql = "SELECT move_id,move_name,description,power,move_PP,accuarcy FROM moves WHERE move_id == ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $move_data = $kysely->execute(array($m_id));
        $move = new move($move_data->move_id,$move_data->move_name,$move_data->description,$move_data->power,$move_data->move_PP,$move_data->accuarcy);
        return $move;
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
    
    public function getPokemonForMove() {
        $sql = "SELECT poke_id FROM poke_moves WHERE move_id == ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $move_data = $kysely->execute(array($m_id));
        return $move_data;
    }
}

