<?php
//Start session
session_start();
//if neither user is save in session, redirection page login
if(!isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}
//load Header
include "Template/header.php";

// try and catch for check a erreur in the PDO
try {
// serveur MySQL
$bdd = new PDO('mysql:host=localhost;dbname=Site_E-commerce', 'phpmyadmin', 'adepsimplon05', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e) {
   // stop the page and show a error message
   die('Erreur : ' . $e->getMessage());
}
// On récupère tout le contenu de la table Products
$products = $bdd->query('SELECT * FROM Products');



//if a success confirmation
if(isset($_GET["success"])) {
  // secured all messages
  $message = htmlspecialchars($_GET["success"]);
  echo "<div class='alert alert-success w-50 text-center mx-auto'>" . $message . "</div>";
}

 ?>

 <div class="row mt-5">
    <section class="col-lg-9">
      <h2>Nos derniers produits</h2>
      <div class="container-fluide">
        <div class="row">
          <?php
            //loop all products in the Products Table
            foreach ($products as $key => $product) {
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
                <a href="<?php echo 'single.php?id=' . $product['ProductID']; ?>" class="btn lightBg">Info du produit</a>
              </div>
            </div>
          </article>
          <?php
          //close loop
            }
           ?>
        </div>
      </div>
    </section>
    <!-- load aside -->
    <?php include "Template/aside.php"; ?>
  </div>

 <?php
 // load Footer
 include "Template/footer.php"
  ?>
