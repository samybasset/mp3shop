<?php

class Cart extends Database {
  public function add_to_cart($product) {

    if(empty($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }
    array_push($_SESSION['cart'], $product);

    // unset($_SESSION['cart']);
    return $_SESSION['cart'];
  }

  public function show_cart($array) {
    return $array;
  }

  public function empty_cart() {
    unset($_SESSION['cart']);
  }
}
