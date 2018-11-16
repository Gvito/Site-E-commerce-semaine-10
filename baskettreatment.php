<?php
require "Model/getProducts.php";
//start session
session_start();

//Fonction who check all product and compute the amount
function calculateBasket() {
  $_SESSION["basketAmount"] = 0;
  foreach ($_SESSION["basket"] as $key => $product) {
    $_SESSION["basketAmount"] += $product["ProductPrice"];
  }
}

//if action Si l'action regards an addition to the cart
if($_GET["action"] === "add") {
  //add the product in enter "basket" of session table
  array_push($_SESSION["basket"], $product);
  //compte the new amount of basket
  calculateBasket();
  //return the products page (products.php) with a success message for confirm the addiction to the basket
  header("Location: products.php?success= Le produit a été ajouté au panier");
}

//If the action affected canceling of product
if($_GET["action"] === "remove") {
  //collect the key matches to the product position in the session basket
  $key = intval(htmlspecialchars($_GET["key"]));
  //remove the product of table
  unset($_SESSION["basket"][$key]);
  //compute le new addiction of basket
  calculateBasket();
  //Redirection in the page with success message
  header("Location: basket.php?success= Le produit a été retiré du panier");
}
 ?>
