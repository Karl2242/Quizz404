
<?php
session_start();  


if (isset($_SESSION["user"])) {
    
    echo "Bienvenue, " . $_SESSION["user"] . "!";
} else {
    
    echo "Vous n'êtes pas connecté.";
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz404</title>
    <link rel="icon" href="./image/_.ico">
    <link rel="stylesheet" href="output.css">
    
</head>
<body>

<h1>choisi ton theme</h1>
<h2>liste des quiz</h2>

  
    
</body>
</html>