<?php

require_once '../libs/tietokantayhteys.php';

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
            $current_user = new user($tulos->user_id, $tulos->username, $tulos->password); 
            $tulokset[] = $current_user;
        }
        return $tulokset;
    }
    
    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT user_id,username, password FROM db_user WHERE username = ? AND password = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
          return null;
        } else {
          $kayttaja = new user($tulos->user_id, $tulos->username, $tulos->password); 
          return $kayttaja;
        }
  }
  
  public function nextUid() {
        $sql = "SELECT count(*) FROM db_user";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array());
        return $kysely->fetchColumn()+1;
  }


  public function nameExist($name) {
        $sql = "SELECT username FROM db_user WHERE username = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tulos = $kysely->execute(array($name));
        if ($tulos) {
          return false;
        } else {
          return true;
        }      
      
  }
  public static function uusiKayttaja($username, $password) {
      $sql = "INSERT INTO db_user(username,password) VALUES (?,?) RETURNING user_id";
      $kysely = getTietokantayhteys()->prepare($sql);
      $ok = $kysely->execute(array($username, $password));
      if($ok) {
          return true;
      } else {
          return false;
      }
  }
  
}