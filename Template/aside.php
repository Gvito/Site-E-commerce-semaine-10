<aside class="col-lg-3">
  <!-- <i class="fas fa-user-alt fa-4x mb-3"></i> -->
  <ul class="list-group">
    <i class="list-group-item fas fa-user-alt fa-4x text-center"></i>
    <?php
    //On boucle sur l'utilisateur stocké en session pour afficher toutes ses informations
    foreach ($_SESSION["user"] as $key => $value) {
      echo "<li class='list-group-item'>$key : $value</li>";
    }
    ?>
  </ul>
  <ul class="list-group my-3">
    <li class="list-group-item text-center"><a href="basket.php"><i class="fas fa-shopping-basket btn-lg"></i></a></li>
    <?php
      //On boucle sur le panier stocké en session pour afficher tous ses produits
      foreach ($_SESSION["basket"] as $key => $product) {
        echo "<li class='list-group-item w-100'>". $product['name'] . "</li>";
      }
     ?>
     <li class='list-group-item'>Total : <?php echo $_SESSION["basketAmount"]; ?></li>
  </ul>
  <a href="logout.php" class="btn lightBg  my-3">Deconnexion</a>
</aside>
