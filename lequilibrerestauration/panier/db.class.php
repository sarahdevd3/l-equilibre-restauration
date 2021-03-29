<?php

class DB{
  private $host = 'localhost';
  private $username = '';
  private $password = '';
  private $database = '';
  private $db;

  // pour pouvoir se connecter avec d'autres bdd avec les paramètres possibles que l'on met par défaut

  public function __construct($host = null, $username = null, $password = null, $database = null){
    if($host != null){
      $this->host = $host;
      $this->username = $username;
      $this->password = $password;
      $this->database = $database;
    }

    try{
    $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, 
    $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
     PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      die('Impossible de se connecter à la base de données.');
    }
  }

  // On créé une méthode qui permet de faire des requêtes plus facilement 
  // je créé un second paramètre pour les requêtes préparées (un tableau vide)
  // $data est injecté au moment du execute 

  public function query($sql, $data = array()){
    $req = $this->db->prepare($sql);
    $req->execute($data);
    // Je dis que je veux afficher sous forme d'objet 
    return $req->fetchAll(PDO::FETCH_OBJ);
  }


}

?>