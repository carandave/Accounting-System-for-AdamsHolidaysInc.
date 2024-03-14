<?php 
    
    require_once "connection.php";

    // For PO Id
    

    

    
    

    if(isset($_POST['id'])){
        $official_Id = $_POST['id']; 
        $sql = "SELECT * FROM notification WHERE officials_Id = $official_Id AND status='unseen' AND form='PO' ";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo $result->num_rows;
        }
        else{
            echo "0";
        }
        
    }

    if(isset($_POST['sa-id'])){
        $sa_official_Id = $_POST['sa-id'];
        $sql = "SELECT * FROM notification WHERE officials_Id = $sa_official_Id AND status='unseen' AND form='SA' ";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo $result->num_rows;
        }
        else{
            echo "0";
        }
    }

    if(isset($_POST['ar-id'])){
        $ar_official_Id = $_POST['ar-id'];
        $sql = "SELECT * FROM notification WHERE officials_Id = $ar_official_Id AND status='unseen' AND form='AR' ";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo $result->num_rows;
        }
        else{
            echo "0";
        }
    }

    if(isset($_POST['cr-id'])){
        $cr_official_Id = $_POST['cr-id'];
        $sql = "SELECT * FROM notification WHERE officials_Id = $cr_official_Id AND status='unseen' AND form='CV' ";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo $result->num_rows;
        }
        else{
            echo "0";
        }
    }

    
    
    // $result = $conn->query($sql);

    // echo $result->num_rows;

?>