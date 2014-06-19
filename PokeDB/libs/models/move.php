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
        $this->move_PP = $move_pp;
        $this->accuarcy = $accuarcy;
    }
    
    public function getMove($m_id) {
        $sql = "SELECT move_id,move_name,description,power,move_PP,accuarcy FROM moves WHERE move_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($m_id));
        $move_data = $kysely->fetchObject();
        $move = new move($move_data->move_id,$move_data->move_name,$move_data->description,$move_data->power,$move_data->move_pp,$move_data->accuarcy);
        return $move;
    }
    
    public function getPokemonForMove() {
        $sql = "SELECT distinct poke_id FROM poke_moves WHERE move_id = ? ORDER BY poke_id ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $move_data = $kysely->execute(array($m_id));
        return $move_data;
    }
    
    
    public function getMove_id() {
        return $this->move_id;
    }

    public function getMove_name() {
        return $this->move_name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPower() {
        return $this->power;
    }

    public function getMove_PP() {
        return $this->move_PP;
    }

    public function getAccuarcy() {
        return $this->accuarcy;
    }
}

