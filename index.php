<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizz404</title>
  <link rel="icon" href="./image/_.ico">
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="./css/style.css">
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

  <h1 class="font-first-font text-5xl">Bienvenue sur QUIZ405 inscrivez vous ou connecter vous pour jouer !</h1>

  <?php if (isset($_SESSION['erreur'])) {
    
    echo '<p class=" bg-border-red border p-4 text-center font-extrabold">' . $_SESSION['erreur'] . '</p>';
    unset($_SESSION['erreur']);
}
?>


  <div class="flex gap-4 w-full justify-center text-center">
  <a class="text-white font-first-font font-extrabold hover:scale-110 transition-all" href="./pages/formulaire.php">
    <div class="w-[9%] h-[70px] items-center flex justify-center btn">
    Inscription
    </div>
    </a>
    <a class="text-white font-first-font font-extrabold hover:scale-110 transition-all" href="./pages/connexion.php">
    <div class="w-[9%] h-[70px] items-center flex justify-center btn">
    Connexion
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
