<?php
//On redémarre immédiatement la section pour avoir accès aux informations
session_start();
//Si aucun utilisateur est enregistré en session on renvoi à l'acceuil
if(!isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}
//On charge les fonctions pour accéder aux données
include "Template/header.php";


// try et catch pour vérifier la présence d'une erreur à l'intérieur du PDO
try {
// serveur MySQL
$bdd = new PDO('mysql:host=localhost;dbname=Site_E-commerce', 'phpmyadmin', 'adepsimplon05', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e) {
   // arret de la page et affiche le message d'erreur
   die('Erreur : ' . $e->getMessage());
}
$id = intval(htmlspecialchars($_GET["id"]));
// On récupère tout le contenu de la table Products
$res = $bdd->query("SELECT * FROM Products WHERE ProductID = $id");
$product = $res->fetch(PDO::FETCH_ASSOC);

//On récupère notre produits via la fonction, plus tard celle-ci effectuera une requête en base de données


// $product = $products($id);
 ?>

    <div class="mb-5 d-flex justify-content-between">
      <section class="h-100 w-50">
        <a href="products.php" type="button" class="btn btn-primary h-25" "text-white"><i class="fas fa-arrow-circle-left"></i> Retour à la page des produits</a>
        <h2 class="mt-4 mb-4">Infos du produit</h2>
        <div class="pb-5 d-flex justify-content-between">
          <ul class="list-group w-100">
            <li class="list-group-item active">Nom: <?php echo $product["ProductName"]; ?></li>
            <li class="list-group-item">Prix: <?php echo $product["ProductPrice"] ?>€</li>
            <li class="list-group-item">Stock: <?php

            if($product["ProductStock"]) {
              echo "<span class='badge badge-success'>Disponible</span>";
            }
            else {
              echo "<span class='badge badge-danger'>Indisponible</span>";
            }
             ?>

            </li>
            <li class="list-group-item">Description: <?php echo $product["Description"] ?></li>
            <li class="list-group-item">Catégories: <?php echo $product["ProductCategory"] ?></li>
            <li class="list-group-item">Lieu de fabrication: <?php echo $product["ProductMade_in"] ?></li>
          </ul>
        </div>
        <?php
          //Si le produit est disponible on met un boutton d'ajout au panier
          if($product["ProductStock"]) {
            echo "<a href='baskettreatment.php?id=". $id . "&action=add' class='btn lightBg mb-5'>Ajouter au panier</a>";
          }
         ?>
      </section>
    <!-- Aside avec les informations utilisateur -->
    <?php include "Template/aside.php"; ?>
  </div>

 <?php
 include "Template/footer.php"
  ?>
