<?php
// try and catch for check a erreur in the PDO
try {
// serveur MySQL
$bdd = new PDO('mysql:host=localhost;dbname=Site_E-commerce', 'phpmyadmin', 'adepsimplon05', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e) {
   // stop the page and show a error message
   die('Erreur : ' . $e->getMessage());
}
$id = intval(htmlspecialchars($_GET["id"]));

// collect all the contents of the Users table
$res = $bdd->prepare("SELECT * FROM Products WHERE ProductID = ?");
$res->execute([$id]);
$product = $res->fetch(PDO::FETCH_ASSOC);
?>
