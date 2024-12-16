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
  <title>Quizz404</title>
  <link rel="icon" href="./image/_.ico">
  <link rel="stylesheet" href="../css/output.css">
</head>

<body>
<div id="app">
  <div id="star-container">

  <header class="flex w-100 justify-around pt-5 items-center opacity-[1] z-2">

    
    <a class="text-white font-first-font font-extrabold" href="./pages/formulaire.php">
    <div class="w-[9%] h-[70px] items-center flex justify-center btn">
    Inscription
    </div>
    </a>

    <div class="w-[50%] p-5 items-center text-center ">
      <h2 class="text-8xl font-extrabold font-first-font">
        <span>
          < 
        </span>
        <span>Quiz</span>
        <span class="text-[#8344bc]">405</span>
        <span>/></span>
      </h2>
    </div>
 
      
    <a class="text-white font-first-font font-extrabold" href="./pages/connexion.php">
    <div class="w-[9%] h-[70px] items-center flex justify-center btn">
    Connexion
    </div>
    </a>
  </header>
  
<main>

    <div id="star-pattern"></div>
    <div id="star-gradient-overlay">
      
    </div>
  </div>
  <div id="stripe-container">
    <div id="stripe-pattern">
<div class="h-[100%] pt-[250px]">



  <div class="flex flex-col gap-9 text-center w-100 items-center">   

  <div class="bg-slate-100 w-[500px] h-[500px] m-auto shadow-md p-8">

    <h3 class="text-center">Résultats</h3>

        <p> <?=$_SESSION["nbOfCorrectQuestions"]?> /  <?= $_SESSION["nbOfQuestions"] ?> questions correctes</p>

        <p class="text-end pt-16"> Votre score :  y'a pas</p>


    <a class="text-white font-first-font font-extrabold" href="./choixQuizz.php">
    <div class="h-[70px] items-center flex justify-center bg-slate-600 text-nowrap">
        Retourner au choix des quizz
    </div>
    </a>



    </div>



 
  </div>
</div>
    </div>
  </div>
</main>


</body>

</html>


?>




