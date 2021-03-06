<?php
//start session
session_start();
//if neither user is save in session, redirection page login
if(!isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}

include "Template/header.php";

//if a success confimation for show the produit canceling
if(isset($_GET["success"])) {
  $message = htmlspecialchars($_GET["success"]);
  echo "<div class='alert alert-success w-25 text-center mx-auto'>" . $message . "</div>";
}
 ?>

 <div class="row mt-5 mb-5">
    <section class="col-lg-9">
      <a href="products.php" type="button" class="btn btn-primary mb-5" "text-white"><i class="fas fa-arrow-circle-left"></i> Retour à la page des produits</a>

      <h2 class="mb-5">Votre panier</h2>
      <div class="container-fluide">
        <div class="row">
          <?php
            if (!empty($_SESSION["basket"])) {
              //On boucle pour afficher tous les produits contenus dans le panier en session
              foreach ($_SESSION["basket"] as $key => $product) {
          ?>
          <article class="col-lg-6 my-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $product["ProductName"] ?></h5>
                <p class="card-text"><?php echo $product["Description"] ?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Prix : <?php echo $product["ProductPrice"] ?></li>
                <li class="list-group-item">Lieu de production: <?php echo $product["ProductMade_in"] ?></li>
                <li class="list-group-item">Catégorie : <?php echo $product["ProductCategory"] ?></li>
              </ul>
              <div class="card-body">
                <!-- remove product -->
                <a href="<?php echo 'baskettreatment.php?key=' . $key . '&action=remove'; ?>" class="btn lightBg">Retirer du panier</a>
              </div>
            </div>
          </article>
          <?php
          //close loop
              }
            }
            else {
              echo '<h6 class="card p-3"> Votre panier est vide </h6>';
            }
           ?>
        </div>
      </div>
    </section>
    <!-- Aside avec les informations utilisateur -->
    <?php include "Template/aside.php"; ?>
  </div>

 <?php
 include "Template/footer.php"
  ?>
