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
// On récupère tout le contenu de la table Products
$products = $bdd->query('SELECT * FROM Products');

//On récupère notre produits via la fonction, plus tard celle-ci effectuera une requête en base de données
$id = intval(htmlspecialchars($_GET["id"]));

$product = getProduct($id);
// $product = $products($id);
 ?>

 <div class="row mt-5">
    <section class="col-lg-9">
      <h2><?php echo $product["ProductName"]; ?></h2>
      <div class="container-fluide">
        <?php echo $product["Description"]; ?>
      </div>
      <div>
        <span class="badge badge-secondary">Prix : <?php echo $product["ProductPrice"] ?>€</span>
        <?php
        if($product["stock"]) {
          echo "<span class='badge badge-success'>Disponible</span>";
        }
        else {
          echo "<span class='badge badge-danger'>Indisponible</span>";
        }
         ?>
        <span class="badge badge-secondary">Catégorie : <?php echo $product["ProductCategory"] ?></span>
        <span class="badge badge-secondary">Lieu de production :<?php echo $product["ProductMade_in"] ?></span>
      </div>
      <?php
        //Si le produit est disponible on met un boutton d'ajout au panier
        if($product["ProductStock"]) {
          echo "<a href='baskettreatment.php?id=". $id . "&action=add' class='btn lightBg my-3'>Ajouter au panier</a>";
        }
       ?>
    </section>
    <!-- Aside avec les informations utilisateur -->
    <?php include "Template/aside.php"; ?>
  </div>

 <?php
 include "Template/footer.php"
  ?>
