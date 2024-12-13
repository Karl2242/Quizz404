
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz404</title>
    <link rel="icon" href="./image/_.ico">
    <link rel="stylesheet" href="output.css">
    
</head>
<body>

<?php
session_start(); 



if (isset($_SESSION['erreur'])) {
    
    echo '<p class=" bg-red-600 border p-4 text-center">' . $_SESSION['erreur'] . '</p>';
    unset($_SESSION['erreur']);
}
?>



<form action="./process/process_create_user.php" method="post" class="max-w-xl mx-auto my-auto p-8 bg-white rounded-xl shadow-2xl border border-gray-200">
  <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Inscription</h2>

  <label for="pseudo" class="block text-lg font-medium text-gray-700 mb-2">Entrez votre pseudo :</label>
  <input type="text" name="pseudo" id="pseudo"  class="w-full p-4 bg-gray-100 text-gray-800 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none mb-6 placeholder-gray-400 transition duration-200 ease-in-out" placeholder="Votre pseudo">
  

  <input type="submit" value="S'inscrire"   class="w-full p-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 hover:shadow-lg transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500">
  
  
</form>
<a href="./connect_user.php">Se connecter</a>

    
</body>
</html>