<?php

class Order extends Database {
  public function get_orders() {
    $q = $this->conn->prepare("select klant.naam, item.weborderID, album.titel, item.verkoopprijs, item.aantal
                               from klant
                               inner join weborder
                              	 on klant.ID = weborder.klantID
                               inner join item
                              	 on weborder.ID = item.weborderID
                               inner join album
                                 on item.albumID = album.ID
                              ");
    $q->execute();
    return $q->fetchAll();
  }

  public function get_single_order($email) {
    $q = $this->conn->prepare("select klant.naam, item.weborderID, album.titel, item.verkoopprijs, item.aantal
                               from klant
                               inner join weborder
                              	 on klant.ID = weborder.klantID
                               inner join item
                              	 on weborder.ID = item.weborderID
                               inner join album
                                 on item.albumID = album.ID where klant.email = :1
                              ");
    $q->execute(array(":1" => $email));
    return $q->fetchAll();
  }
}
