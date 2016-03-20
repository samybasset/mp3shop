<?php

class Database {
  private $host = 'localhost';
  private $db_username = 'root';
  private $db_password = '';
  private $db_name = 'mp3shop2';
  protected $conn;

  public function __construct() {
    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->db_username, $this->db_password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "<strong>MySQL ERROR: </strong>" . $e->getMEssage();
      die();
    }
  }
}
