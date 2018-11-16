<?php
require "Model/function.php";
//On démarre la session pour récupérer les informations stockées
session_start();

//Fonction qui parcours les produits du panier et calcule le montant total
function calculateBasket() {
  $_SESSION["basketAmount"] = 0;
  foreach ($_SESSION["basket"] as $key => $product) {
    $_SESSION["basketAmount"] += $product["price"];
  }
}

//Si l'action concerne un ajout au panier
if($_GET["action"] === "add") {
  //On récupère le produit via son id et la fonction de récupèration d'un produit
  $id = intval(htmlspecialchars($_GET["id"]));
  $product = getProduct($id);
  //On ajoute le produit dans l'entrée "basket" du tableau session
  array_push($_SESSION["basket"], $product);
  //On calcule le nouveau montant du panier
  calculateBasket();
  //On renvoie vers la page produit avec un message de succès pour confirmer l'ajout au panier
  header("Location: products.php?success= Le produit a été ajouté au panier");
}

//Si l'action concerne un retrait de produit
if($_GET["action"] === "remove") {
  //On récupère la clef correspondant à la position du produit dans le panier de la session
  $key = intval(htmlspecialchars($_GET["key"]));
  //On retire ce produit du tableau
  unset($_SESSION["basket"][$key]);
  //On calcule le nouveau montant du panier
  calculateBasket();
  //On renvoie vers la page panier avec un message de succès pour confirmer le retrait du panier
  header("Location: basket.php?success= Le produit a été retiré du panier");
}
 ?>
