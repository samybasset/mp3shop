<?php

class User extends Database {

  public function is_user_logged_in() {//check if user is logged in
    if($_SESSION['login'] == 1) {
      return true;
    } elseif($_SESSION['login'] == 0) {
      return false;
    }
  }
  public function get_user($username) {//retrieve single user from database
    $q = $this->conn->prepare("select * from klant where email = :1");
    $q->execute(array(":1" => $username));
    return $q->fetch();
  }

  public function get_user_id($username) {
    $q = $this->conn->prepare("select ID from klant where email = :1");
    $q->execute(array(":1" => $username));
    return $q->fetch();
  }

  //login method
  public function user_login($username, $salt, $password) {//check if login cred. are correct
    // $hashedPassword = hash("sha256", $salt, $password);

    $q = $this->conn->prepare("select * from klant where email = :1 AND password = :2");
    $q->execute(array(":1" => $username, ":2" => hash('sha256', $salt.$password)));
    // $row = $q->fetch(PDO::FETCH_ASSOC);
    //return number of rows that match query
    return $q->rowCount();
  }

  public function register_user($name, $address, $postcode, $city, $username, $salt, $password) {
    $q = $this->conn->prepare("INSERT INTO klant (naam, adres, postcode, woonplaats, email, salt, password)
                               VALUES (:1, :2, :3, :4, :5, :6, :7)");
    $q->execute(array(":1" => $name,
                      ":2" => $address,
                      ":3" => $postcode,
                      ":4" => $city,
                      ":5" => $username,
                      ":6" => $salt,
                      ":7" => hash('sha256', $salt . $password)));
    return hash('sha256', $salt . $password);
  }

  public function get_users() {//retrieve all users form database(for admin)
    $q = $this->conn->prepare("select ID, email, password, role from klant");
    $q->execute();
    return $q->fetchAll();
  }

  public function get_single_user($email) {
    $q = $this->conn->prepare("select ID, email, password, role from klant where email = :1");
    $q->execute(array(":1" => $email));
    return $q->fetchAll();
  }

  public function get_user_role($email) {
    $q = $this->conn->prepare("select role from klant where email = :1");
    $q->execute(array(":1" => $email));
    while($row = $q->fetch(PDO::FETCH_ASSOC)) {
      return $row['role'];
    }
  }

  public function update_password($id, $salt, $password) {//update password
    //new password method

    $q = $this->conn->prepare("UPDATE klant
                               SET password = :1, salt = :2
                               WHERE ID = :3
                              ");
    $q->execute(array(":1" => hash('sha256', $salt . $password), ":2" =>$salt, ":3" => $id));
  }
}
