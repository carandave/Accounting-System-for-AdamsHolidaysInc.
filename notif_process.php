<?php 
    
    require_once "connection.php";
    $official_Id = $_POST['id'];

    if(isset($official_Id)){
        $sql = "SELECT * FROM notification WHERE status='unseen' AND  form='PO' ";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo $result->num_rows;
        }
    }
    
    // $result = $conn->query($sql);

    // echo $result->num_rows;

?>