<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");

$cart_id = $_POST['cart_id'];
$product_id = $_POST['product_id'];
$amount = $_POST['amount'];

if ($amount < 1) {
  $amount = 1;
}
if ($amount > 20)  {
  $amount = 20;
}

Database::query("UPDATE cart_items SET amount = :amount WHERE ID = :cart_id AND product_id = :product_id",
  [
    ':amount' => $amount,
    ':product_id' => $product_id,
    ':cart_id' => $cart_id
  ]
);

if(!headers_sent()) {
  header("Location: " . getLastVisitedPage());
  exit();
}
