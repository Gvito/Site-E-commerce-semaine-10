<?php
//Check the completed form
if(!empty($_POST)) {
  //clean enter form
  foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value);
  }

  // try and catch for check a erreur in the PDO
  try {
  // serveur MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=Site_E-commerce', 'phpmyadmin', 'adepsimplon05', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e) {
     // stop the page and show a error message
     die('Erreur : ' . $e->getMessage());
  }
  // collect all the contents of the Users table
  $users = $bdd->query('SELECT * FROM Users');
// Show enter one by one
while ($donnees = $users->fetch(PDO::FETCH_ASSOC)) {
    // check each enters
    if($donnees["name"] === $_POST["user_name"] && password_verify($_POST["user_password"], $donnees["password"])) {
      //If it's good, start an session for store the users info
      session_start();
      $_SESSION["user"] = $donnees;
      $_SESSION["basket"] = [];
      $_SESSION["basketAmount"] = 0;
      header("Location: products.php");
      //execute the script
      exit;
    }
  }
  header("Location: index.php?message=Nous n'avons aucun utilisateur avec ce nom ou ce mot de passe");
  exit;
}
//Redirection if the form isn't completed
else {
  header("Location: index.php?message=Vous devez remplir les champs du formulaire");
  exit;
}

 ?>
