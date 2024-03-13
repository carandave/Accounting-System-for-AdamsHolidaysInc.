<?php 

    require_once "connection.php";

    if(isset($_POST['action']) && $_POST['action'] == 'login'){
         $username = $_POST['username'];
         $password = $_POST['password'];

         $password = sha1($password);

        $sql = "SELECT * FROM officials WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        $row = $result->fetch_array(MYSQLI_ASSOC);

        if($row!=null){
             $_SESSION['officialsId'] = $row['officials_Id'];
             $_SESSION['name'] = $row['name'];
             $_SESSION['username'] = $row['username'];
             $_SESSION['usertype'] = $row['user_type'];

             echo "Valid";
        }

        else{
            echo "Invalid";
        }

    }

    else{
        echo "Hindi naka isset";
    }

?>