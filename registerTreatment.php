<?php

//if the isn't empty, checking
if(!empty($_POST)) {
  $errors ="";
  //secured the form enter
  foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value);
  }

  //loop for check if a value is empty
  $isEmpty = false;
  foreach ($_POST as $key => $value) {
    if(empty($value)) {
      $isEmpty = true;
    }
  }
  //if a value is empty, add a error message
  if($isEmpty) {
    $errors .= "1";
  }

  //if the user_name contains Si le nom utilisateur contains less than 3 letters
  if(strlen($_POST["user_name"]) < 3) {
    $errors .= "2";
  }

  //If the confirmation of the password is not the same
  if($_POST["user_password"] !== $_POST["user_password_confirm"]) {
    $errors .= "3";
  }
  //If the password does not meet the requested criteria
  if(!preg_match("#(?=.*[A-Z]{1,})(?=.*[0-9]{1,}).{6,}#", $_POST["user_password"])) {
    $errors .= "4";
  }

  //If we have stored error codes we return to the form
  if(!empty($errors)){
    session_start();
    $_SESSION["answers"] = $_POST;
    header("Location: register.php?message=$errors");
    exit;
  }
  //Otherwise we send on the login page with a message of success
  else {
    // try and catch for check a erreur in the PDO
    try {
    // serveur MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=Site_E-commerce', 'phpmyadmin', 'adepsimplon05', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e) {
       // stop the page and show a error message
       die('Erreur : ' . $e->getMessage());
    }
    // on demande d'envoyer les données dans ce tableau
    $requete = $bdd->prepare('INSERT INTO Users(name, password, sexe) VALUES (?, ?, ?)');
    // on récupère les données du formulaire pour chaque input
    $requete->execute(array($_POST['user_name'], password_hash($_POST["user_password"], PASSWORD_DEFAULT), $_POST['user_sexe']));


    header("Location: index.php?success=Compte créé avec succès, vous pouvez vous connecter");
    exit;
  }
}
//Si le formulaire est vide on renvoi vers la page register
else {
  header("Location: register.php?message=0");
  exit;
}

 ?>
