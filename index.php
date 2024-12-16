<?php
session_start(); 

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=quizz404", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Gestion des erreurs

    $sql = "SELECT id, titre FROM quiz"; // Récupérer l'id et le titre des quiz

    $stmt = $pdo->query($sql);

    if ($stmt === false) {
        echo "Erreur de requête SQL.";
    } else {
        $quizList = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif
    }

} catch (PDOException $e) {
    echo "Erreur de connexion ou de requête : " . $e->getMessage();
}

// Affichage de la session pour vérifier la connexion
if (isset($_SESSION["user"])) {
    $userName = $_SESSION["user"];
} else {
    $userName = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz404</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed">

<!-- Header avec message de bienvenue -->
<div class="bg-blue-600 text-white p-4 shadow-lg">
    <div class="max-w-7xl mx-auto">
        <?php if ($userName): ?>
            <h1 class="text-2xl font-semibold">Bienvenue, <?= htmlspecialchars($userName) ?>!</h1>
            <a href="./deconnexion.php">Se deconnecter</a>
        <?php else: ?>
            <h1 class="text-2xl font-semibold">Vous n'êtes pas connecté.</h1>
         
        <?php endif; ?>
        
    </div>
</div>


</body>
</html>
