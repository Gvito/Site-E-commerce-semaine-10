<?php
require "Model/getProducts.php";
//start session
session_start();
//if neither user is save in session, redirection page login
if(!isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}
//load Header
include "Template/header.php";

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
          //if the product is availade, add the button "add in the basket"
          if($product["ProductStock"]) {
            echo "<a href='baskettreatment.php?id=". $id . "&action=add' class='btn lightBg mb-5'>Ajouter au panier</a>";
          }
         ?>
      </section>
    <!-- load Aside -->
    <?php include "Template/aside.php"; ?>
  </div>

 <?php
 //load Footer
 include "Template/footer.php"
  ?>
