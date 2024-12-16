<?php 
session_start();

if (!isset($_SESSION["nbOfQuestions"]) && !isset($_SESSION["nbOfCorrectQuestions"]))
{
    header("location: ./choixQuizz.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/output.css">
</head>
<body>
    


<div class="bg-slate-100 w-[500px] h-[500px] m-auto mt-32 shadow-md p-8">

    <h3 class="text-center">Résultats</h3>

        <p> <?=$_SESSION["nbOfCorrectQuestions"]?> /  <?= $_SESSION["nbOfQuestions"] ?> questions correctes</p>

        <p class="text-end pt-16"> Votre score : </p>


        <a href="./choixQuizz.php" class="p-2 bg-sky-400">Retourner au choix des quizz</a>



</div>




</body>
</html>