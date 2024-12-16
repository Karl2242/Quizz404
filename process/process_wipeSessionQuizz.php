<?php

session_start();

unset($_SESSION["titre"]);
unset($_SESSION["currentQuestion"]);
unset($_SESSION["nbOfQuestions"]);
unset($_SESSION["nbOfCorrectQuestions"]);


header("location: ../pages/choixTheme.php");

?>