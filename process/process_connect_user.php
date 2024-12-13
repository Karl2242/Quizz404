<?php
session_start();
require_once '../utils/connect-db.php';


if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
    
   
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));

    
    $sql = "SELECT pseudo FROM user WHERE pseudo = :pseudo";
    try {
       
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['pseudo' => $pseudo]);

        
        if ($stmt->fetch()) {
            
            $_SESSION["user"] = $pseudo;
            header("Location: ../index.php");
            exit;
        } else {
          
            $_SESSION["message"] = "Le pseudo '$pseudo' n'existe pas.";
            header("Location: ../connect_user.php");
            exit;
        }
    } catch (PDOException $error) {
        
        echo "Erreur lors de la requête : " . $error->getMessage();
    }
} else {
    
    $_SESSION["erreur"] = "Le champ pseudo doit être rempli.";
    header("Location: ../connect_user.php");
    exit;
}
?>
