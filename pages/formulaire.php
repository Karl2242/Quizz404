<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizz404</title>
  <link rel="icon" href="./image/_.ico">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/output.css">
</head>

<body>
<div id="app">
  <div id="star-container">

  <header class="flex w-100 justify-around pt-5 items-center opacity-[1] z-2">

    
    <a class="text-white font-first-font font-extrabold" href="../pages/formulaire.php">
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
 
      
    <a class="text-white font-first-font font-extrabold" href="../pages/connexion.php">
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
<div class="w-full">



<div class="flex flex-col"> <!-- Card Formulaire -->
<form action="../process/process_create_user.php" method="post" class="flex flex-col items-center gap-4">
  <h2 class="text-4xl font-bold text-center text-gray-800 mb-6">Inscription</h2>
  <label for="pseudo" class="text-xl">Entrez votre pseudo :</label>
  <input type="text" name="pseudo" id="pseudo"  class="text-center rounded-xl w-[20%] border-2 border-black" placeholder="Votre pseudo">
  
  <input type="submit" value="S'inscrire"  class="p-3 px-7 bg-orange-500 cursor-pointer shadow-xl rounded-lg hover:scale-110 transition-all">
  
</form>


</div>

<?php
session_start(); 


?>

</div>
</div>
    </div>
  </div>
</main>


</body>

</html>