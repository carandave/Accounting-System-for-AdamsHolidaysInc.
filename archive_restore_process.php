<?php 

require_once "connection.php";

if(isset($_POST['action']) && $_POST['action'] == "restorearchiveAR"){
    $ar_restore_archive_Id = $_POST['id'];

    $archiveBool = "No";

    $sql = "UPDATE ar SET archive='$archiveBool' WHERE ar_Id='$ar_restore_archive_Id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "restorearchivePO"){
    $id = $_POST['id'];

    $archiveBool = "No";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE po SET archive='$archiveBool' WHERE po_Id='$id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "restorearchiveSA"){
    $id = $_POST['id'];

    $archiveBool = "No";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE sa SET archive='$archiveBool' WHERE sa_Id='$id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "restorearchiveCV"){
    $id = $_POST['id'];

    $archiveBool = "No";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE cv SET archive='$archiveBool' WHERE cv_Id='$id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "searchrestorearchiveCV"){
    $id = $_POST['id'];

    $archiveBool = "No";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE cv SET archive='$archiveBool' WHERE cv_Id='$id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive1";
    }

    else{
        echo "errorArchive1";
    }
   
}




?>