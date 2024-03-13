<?php 

    session_start();

    // session_unset($_SESSION['officialsId']);
    // session_unset($_SESSION['name']);
    // session_unset($_SESSION['username']);
    // session_unset($_SESSION['usertype']);
    session_destroy();

    header("Location: index.php");
    exit();

?>