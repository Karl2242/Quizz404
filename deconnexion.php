<?php
  session_start();
  session_destroy();
  header('location: connect_user.php'); // Ici il faut mettre la page sur lequel l'utilisateur sera redirigé.
  exit;
?>