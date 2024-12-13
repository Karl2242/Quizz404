<?php
session_start();
require_once '../utils/connect-db.php';


if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {

    
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
   
    
    
    $stmt = $pdo->prepare("SELECT pseudo FROM user WHERE pseudo = :pseudo");
    $stmt->execute(['pseudo' => $pseudo]);

    if ($stmt->fetch()) {
       
        $_SESSION["erreur"] = "Le pseudo '$pseudo' est déjà pris.";
        header("Location: ../inscription.php");
        exit;
    } else {
       

        
        $insertStmt = $pdo->prepare("INSERT INTO user (pseudo) VALUES (:pseudo)");

       
        $insertStmt->execute([
            'pseudo' => $pseudo,
           
        ]);

       
        $_SESSION["add"] = "Utilisateur créé avec succès !";
        header("Location: ../connect_user.php");
        exit;
    }
} else {
    
    $_SESSION["erreur"] = "Le champ pseudo doit être rempli.";
    header("Location: ../inscription.php");
    exit;
}
?>
