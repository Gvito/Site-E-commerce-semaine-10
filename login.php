<?php
//On vérifie si le formulaire a été rempli
if(!empty($_POST)) {
  //On nettoie les entrées du formulaire
  foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value);
  }

  // try et catch pour vérifier la présence d'une erreur à l'intérieur du PDO
  try {
  // serveur MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=Site_E-commerce', 'phpmyadmin', 'adepsimplon05', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e) {
     // arret de la page et affiche le message d'erreur
     die('Erreur : ' . $e->getMessage());
  }
  // On récupère tout le contenu de la table Users
  $users = $bdd->query('SELECT * FROM Users');
// On affiche chaque entrée une à une
while ($donnees = $users->fetch(PDO::FETCH_ASSOC)) {
    // On vérifie si on trouve une correspondance avec les infromations du formulaire
    if($donnees["name"] === $_POST["user_name"] && $donnees["password"] === $_POST["user_password"]) {
      //Si c'est le cas on démarre une session pour y stocker les informations de l'utilisateur
      session_start();
      $_SESSION["user"] = $donnees;
      $_SESSION["basket"] = [];
      $_SESSION["basketAmount"] = 0;
      header("Location: products.php");
      //On met un exit pour arrêter l'execution du script, autrement la redirection n'aura pas le temps de se faire
      exit;
    }
  }
  header("Location: index.php?message=Nous n'avons aucun utilisateur avec ce nom ou ce mot de passe");
  exit;
}
//Si le formulaire n'est pas rempli on renvoie l'utilisateur sur la page de login avce un message
else {
  header("Location: index.php?message=Vous devez remplir les champs du formulaire");
  exit;
}

 ?>
