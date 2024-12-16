<?php
session_start();
if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}else{
    header("Location: ../index.php ");
}

require_once "../utils/connect-db.php";
$sql = "SELECT * FROM quiz";

try {
    $stmt = $pdo->query($sql);
    $quiz = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


if (isset($_SESSION["titre"])) {
    header("location: ../process/process_wipeSessionQuizz.php");
  }
?>
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

  <header class="flex w-100 justify-center pt-5 items-center opacity-[1] z-2">

    
    <div class="items-center flex justify-start">
<p class="text-white font-first-font font-extrabold"> Bienvenue <?= $user ?></p>
    </div>


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
    <a href="../index.php" class="text-white font-first-font font-extrabold"> Deconnexion</a>
    
  </header>
  
<main>

    <div id="star-pattern"></div>
    <div id="star-gradient-overlay">
      
    </div>
  </div>
  <div id="stripe-container">
    <div id="stripe-pattern">
<div class="h-[100%] pt-[150px] text-center">
<h1 class="text-5xl font-first-font">CHOISI TON THÈME !</h1>

<div class="flex justify-center flex-wrap pt-6 gap-8">

<?php
foreach ($quiz as $quizz) {
?>    
<a class="w-[20%] hover:scale-110 transition-all" href="quizz?id=<?= $quizz["id"] ?>"><img src="<?= $quizz['img'] ?>" alt=""></a>

<?php
}
?>
</div>

</div>
    </div>
  </div>
</main>


</body>

</html>