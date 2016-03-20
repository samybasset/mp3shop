<?php

class Album extends Database {
  // album code
  public function get_albums() {
    $q = $this->conn->prepare("select * from album");
    $q->execute();
    return $q->fetchAll();
  }

  public function get_album($id) {
    $q = $this->conn->prepare("select * from album where ID = :1");
    $q->execute(array(":1" => $id));
    return $q->fetchAll();;
  }

  public function update_field($id, $fieldname, $value) {
    $q = $this->conn->prepare("update album set ".$fieldname." = :1 where ID = :2");
    $q->execute(array(":1" => $value, ":2" => $id));
  }

  public function delete_row($id) {
    $q = $this->conn->prepare("DELETE from album
                               WHERE ID = :1");
    $q->execute(array(":1" => $id));
  }

  public function search_album($value) {
    $q = $this->conn->prepare("select * from album
                               where titel
                               like :1 OR
                               artiest like :1 OR
                               genre like :1;");
    $q->execute(array(":1" => '%' .$value . '%'));
    return $q->fetchAll();
  }
}
