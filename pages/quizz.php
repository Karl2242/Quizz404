<?php
$quizDuration = 5;  // Durée du quiz en secondes
$currentTime = time();
$endTime = $currentTime + $quizDuration; 
 // Calculer l'heure de fin du quiz

?>


    <script>
        var endTime = <?php echo $endTime; ?>;

        function updateCountdown() {
            var now = Math.floor(Date.now() / 1000); 
            var timeLeft = endTime - now;

            if (timeLeft <= 0) {
                document.getElementById("countdown").innerHTML = "Temps écoulé!";
                showCorrectAnswer()
                
             
                return;
            }

            document.getElementById("countdown").innerHTML = timeLeft + " secondes";
        }

        // Mettre à jour le compte à rebours chaque seconde
        setInterval(updateCountdown, 1000);
    </script>

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


<body>


    <!-- Main -->
    <main class="mt-8 flex flex-col items-center">

        <a href="./choixTheme.php" class="bg-pink-500">retour choix des quizz</a>

        <h1>Quizz : <?= $_SESSION["titre"]  ?> </h1>

        <p>Question : <?= $_SESSION["currentQuestion"] + 1 ?> / <?= $_SESSION["nbOfQuestions"] ?> </p>

        <!-- Intitulé questoin -->
        <h2 class="text-red-400 font-bold size-32 w-fit text-nowrap">
            <?= $currentQuestion['question'] ?>
        </h2>
       
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg text-center w-80">
        <h1 class="text-3xl font-semibold mb-4 text-gray-800">Il vous reste:</h1>
        <div id="countdown" class="m-4 text-4xl font-bold text-blue-500">5 secondes</div>



        <div class="flex flex-col gap-3">
            <?php
            foreach ($reponses as $key => $reponse) {
            ?>

                <!-- Questions -->
                <div class="bg-white text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow reponse rep<?= $key ?>">
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



    function showCorrectAnswer() {
        
    const correctNumber = <?= json_encode(array_search(true, array_column($reponses, 'is_correct'))); ?>;
    const correctAnswer = document.querySelector(`.rep${correctNumber}`);
    

    allAnswers.forEach(answer => {
        if (answer !== correctAnswer) {
            answer.classList.add("bg-red-500", "text-white");  
        }
    });

    
    

    correctAnswer.classList.add("bg-green-500");  

    

    
    const nextQuestionButton = document.querySelector("#nextQuestion");
    if (nextQuestionButton) {
        nextQuestionButton.classList.remove("hidden");
    }


    if (selectedAnswer == correctAnswer) {
            isSelectedCorrect = true
            // Si gagné mettre points TODO

        }
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