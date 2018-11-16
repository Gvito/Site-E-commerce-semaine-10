<?php
//collect the current session
session_start();
//clean of its variables
session_unset();
//destroy
session_destroy();
//redirection in the page home
header("Location: index.php?success=Vous avez été déconnecté, à bientôt :)");
 ?>
