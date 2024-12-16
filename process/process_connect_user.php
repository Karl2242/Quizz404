<?php
session_start();
require_once '../utils/connect-db.php';
$pseudo = $_POST["pseudo"];


$sql = "SELECT pseudo FROM user WHERE pseudo = :pseudo ;";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($stmt->fetch()) {
       
        echo "Utilisateur connecté avec succès !";
        $_SESSION["user"] = $pseudo;
        header("Location: ../pages/choixTheme.php");
        
        
    } else {
        
        $_SESSION["message"] = "Le pseudo '$pseudo' n'existe pas.";
        header("Location: ../pages/connexion.php");
        exit;
}
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}
?>
