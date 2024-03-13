<?php 

require_once "connection.php";

if(isset($_POST['action']) && $_POST['action'] == "archiveAR"){
    $ar_archive_Id = $_POST['id'];

    $archiveBool = "Yes";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE ar SET archive='$archiveBool' WHERE ar_Id='$ar_archive_Id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "archivePO"){
    $po_archive_Id = $_POST['id'];

    $archiveBool = "Yes";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE po SET archive='$archiveBool' WHERE po_Id='$po_archive_Id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "archiveSA"){
    $sa_archive_Id = $_POST['id'];

    $archiveBool = "Yes";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE sa SET archive='$archiveBool' WHERE sa_Id='$sa_archive_Id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}

else if(isset($_POST['action']) && $_POST['action'] == "archiveCV"){
    $cv_archive_Id = $_POST['id'];

    $archiveBool = "Yes";

    // $sql = "UPDATE ar SET archive= 'Yes' WHERE ar_Id= '1003'";
    $sql = "UPDATE cv SET archive='$archiveBool' WHERE cv_Id='$cv_archive_Id'";
    $result = $conn->query($sql);

    if($result === TRUE){
        echo "successArchive";
    }

    else{
        echo "errorArchive";
    }
   
}


?>