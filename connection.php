<?php
    session_start();

    // if(!isset($_SESSION['usertype'])){
    //     header("Location: index.php");
    // }

    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname   = "adam";

    $conn = new mysqli($localhost, $username, $password, $dbname);

    if($conn->connect_error){
            die("Connection Failed".$conn->connect_error);
    }
    else{
        // echo "Success";
    }


?>