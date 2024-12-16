<?php
require_once "../utils/connect-db.php";
session_start();





// Check si le quizz existe
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Récupérer nom du quizz
    if (!isset($_SESSION["titre"])) {
        try {
            $sql = "SELECT titre FROM quiz WHERE id LIKE {$id}";
            $stmt = $pdo->query($sql);
            $titre = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["titre"] = $titre["titre"];
        } catch (PDOException $error) {
            echo "Erreur lors de la requête : " . $error->getMessage();
        }
    }
    $sql = "SELECT * FROM question WHERE id_quiz LIKE :id";
} else {
    header("location: choixTheme.php");
    exit;
};


// 
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
}

// Vérifie si il y'a des questions
if (empty($questions)) {
    header("location: choixTheme.php?error=noQuestions");
    exit;
}


// Initialise currentQuestion  et nbOfQuestions
if (!isset($_SESSION["currentQuestion"])) {
    $_SESSION["currentQuestion"] = 0;
    $_SESSION["nbOfQuestions"] = count($questions);
}

// Check if question is next 
if (isset($_POST["gotoNext"])) {
    // Incrémente la question si ce n'est pas la dernière
    if ($_SESSION["currentQuestion"] + 1 < $_SESSION["nbOfQuestions"]) {
        $_SESSION["currentQuestion"]++;
    } else {
        // Si c'est la dernière question, redirige vers la page des résultats
        header("location: resultat.php");
        exit;
    }
    // Redirige pour éviter que l'utilisateur ne resoumette le formulaire en cas de rafraîchissement
    header("location: quizz.php?id={$id}");
    exit;
}

// Récupère l'id de la question
$currentQuestion = $questions[$_SESSION["currentQuestion"]];

// Cherche les réponses de l'id
$sqlreponses = "SELECT * FROM answer WHERE id_question LIKE {$currentQuestion['id']}";

try {
    $stmt = $pdo->query($sqlreponses);
    $reponses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
}

?>
<!-- HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz404</title>
    <link rel="icon" href="./image/_.ico">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-white">
<div id="app">
  <div id="star-container">

  <header class="flex w-100 justify-around pt-5 items-center opacity-[1] z-2">

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

  </header>
  
<main>
    <div id="star-pattern"></div>
    <div id="star-gradient-overlay">
      
    </div>
  </div>
  <div id="stripe-container">
    <div id="stripe-pattern">
<div class="h-[100%] pt-[100px]">
<div class="w-[100%] flex flex-col justify-center items-center text-center">
<a href="./choixTheme.php" class="shadow-2xl bg-orange-400 rounded-xl p-4 w-[10%]">retour choix des quizz</a>

<h1>Quizz : <?= $_SESSION["titre"]  ?> </h1>

<p>Question : <?= $_SESSION["currentQuestion"] + 1 ?> / <?= $_SESSION["nbOfQuestions"] ?> </p>

<!-- Intitulé questoin -->
<h2 class="text-red-400 font-bold w-fit text-nowrap">
    <?= $currentQuestion['question'] ?>
</h2>


<img class="w-[20%]" src="<?= $currentQuestion["img"] ?>" alt="">





<div class="w-fit h-fit flex gap-5 pt-5">
    <?php
    foreach ($reponses as $key => $reponse) {
    ?>

        <!-- Questions -->
        <div class="bg-white hover:scale-110 transition-all cursor-pointer text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow-xl reponse rep<?= $key ?>">
            <?= $reponse["intitule"] ?>
        </div>

    <?php
    }
    ?>
</div>

<!-- Ajouter style svp -->
<?php if ($_SESSION["currentQuestion"] + 1 < $_SESSION["nbOfQuestions"]) : ?>
    <!-- Bouton Question Suivante -->
    <button type="submit" id="nextQuestion" class="p-4 bg-blue-500 mt-8 text-slate-100 hidden" onclick="goToNextQuestion()">Question suivante</button>
<?php else : ?>
    <!-- Bouton Résultats -->
    <form method="POST" action="resultat.php">
        <button type="submit" class="p-4 bg-green-500 mt-8 text-white">Voir Résultats</button>
    </form>
<?php endif; ?>



</div>
</div>
    </div>
  </div>
</main>
</body>

</html>
<script>
    // Nul mais pas le temps
    let isSelectedCorrect = false

    const allAnswers = document.querySelectorAll(".reponse");

    allAnswers.forEach(answer => answer.addEventListener("click", chooseAnswer));


    function chooseAnswer(event) {

        const selectedAnswer = event.target
        const correctNumber = <?= json_encode(array_search(true, array_column($reponses, 'is_correct'))); ?>;
        const correctAnswer = document.querySelector(`.rep${correctNumber}`)

        const isLastQuestion = <?= json_encode($_SESSION["currentQuestion"] + 1 === $_SESSION["nbOfQuestions"]); ?>;
        // A essayer    


        // Style réponse sélectionnée
        selectedAnswer.classList.add("border-sky-500", "border-4")

        allAnswers.forEach(answer => {
            // Style mauvaise réponse
            if (answer !== correctAnswer) {
                answer.classList.add("bg-red-500", "text-white");
            }

        });

        // Style bonne réponse

        correctAnswer.classList.add("bg-green-500");


        if (selectedAnswer == correctAnswer) {
            isSelectedCorrect = true
            // Si gagné mettre points TODO

        }





        allAnswers.forEach(answer => document.removeEventListener("click", chooseAnswer));

        document.querySelector("#nextQuestion").classList.remove("hidden")

    }


    function goToNextQuestion() {
        // crée un form post et l'envoie
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = './quizz?id=<?= $id ?>';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'gotoNext';
        input.value = true;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();

    }

    // Si c'est la dernière question 

    if (isLastQuestion) {
        document.querySelector("#nextQuestion").classList.add("hidden");
        // Si nécessaire, afficher dynamiquement un bouton "Voir Résultats"
        const resultButton = document.createElement("button");

        resultButton.type = "submit";
        resultButton.textContent = "Voir Résultats";
        resultButton.classList.add("p-4", "bg-green-500", "mt-8", "text-white");
        resultButton.onclick = () => {
            window.location.href = "./resultat.php";
        };

        document.querySelector("main").appendChild(resultButton);
}



</script>