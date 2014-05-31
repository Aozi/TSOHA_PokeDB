<?php

class user {

    private $id;
    private $username;
    private $password;

    public function __construct($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public static function etsiKaikkiKayttajat() {
        $sql = "SELECT user_id, username, password FROM db_user";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $current_user = new user();
            $current_user->setId($tulos->id);
            $current_user->setUsername($tulos->username);
            $current_user->setPassword($tulos->password);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $current_user;
        }
        return $tulokset;
    }
    
    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
    $sql = "SELECT id,username, password FROM db_user WHERE username = ? AND password = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja, $salasana));

    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
      return null;
    } else {
      $kayttaja = new user(); 
      $kayttaja->setId($tulos->id);
      $kayttaja->setUsername($tulos->username);
      $kayttaja->setPassword($tulos->password);

      return $kayttaja;
    }
  }

    /* Kirjoita tähän gettereitä ja settereitä */
}