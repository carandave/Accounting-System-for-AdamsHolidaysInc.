<?php 

require_once "connection.php";

if(isset($_POST['action']) && $_POST['action'] == "requestAR"){
    $officials_Id = $_POST['officials_Id'];
    $arForm_Id = $_POST['id'];
    $form = "AR";
    $status = "Pending";

    $sqls = "SELECT officials_Id, form_Id, status FROM request_list WHERE officials_Id = '$officials_Id' AND form_Id = '$arForm_Id' AND status = 'Pending'";
    $results = $conn->query($sqls);

    if($results->num_rows > 0){
        echo "stillpending";

    }
    //Dun na tayo time pag nag 0 secs is kusang madedelete yung sa request ng ar
    else{
        date_default_timezone_set("Asia/Manila");
        $date_requested = date('m/d/Y h:i:sa');

        $sqli = "INSERT INTO request_list (`officials_Id`, `form_Id`, `form`, `date_request`, `status`) VALUES ('$officials_Id', '$arForm_Id', '$form', '$date_requested', '$status')";
        $result = $conn->query($sqli);

        if($result){
            echo "successInsert";

            $sqladmin = "SELECT * FROM officials WHERE user_type='superadmin' OR user_type='admin'";
            $resultadmin = $conn->query($sqladmin);

            $adminId = [];
            
            if($resultadmin->num_rows > 0){
                while($row = $resultadmin->fetch_assoc()){
                    $adminId[] = $row['officials_Id'];
                }
            }

            $statusnotif = "unseen";

            foreach($adminId as $officialsId){
                $sqln = "INSERT INTO notification (`officials_Id`, `form`, `status`) VALUES ('$officialsId', '$form', '$statusnotif')";
                $resultn = $conn->query($sqln);
            }
        }

        else{
            echo "errorInsert";
        }
    }

}

else if(isset($_POST['action']) && $_POST['action'] == "requestPO"){
    $officials_Id = $_POST['officials_Id'];
    $poForm_Id = $_POST['id'];
    $form = "PO";
    $status = "Pending";

    $sqls = "SELECT officials_Id, form_Id, status FROM request_list WHERE officials_Id = '$officials_Id' AND form_Id = '$poForm_Id' AND status = 'Pending'";
    $results = $conn->query($sqls);

    if($results->num_rows > 0){
        echo "stillpending";

    }
    //Dun na tayo time pag nag 0 secs is kusang madedelete yung sa request ng ar
    else{
        date_default_timezone_set("Asia/Manila");
        $date_requested = date('m/d/Y h:i:sa');

        $sqli = "INSERT INTO request_list (`officials_Id`, `form_Id`, `form`, `date_request`, `status`) VALUES ('$officials_Id', '$poForm_Id', '$form', '$date_requested', '$status')";
        $result = $conn->query($sqli);

        if($result){

            
            // Kunin natin ang mga id ng mga admin then isave natin yung id ng admin sa notification table para 
            
            $sqladmin = "SELECT * FROM officials WHERE user_type='superadmin' OR user_type='admin'";
            $resultadmin = $conn->query($sqladmin);

            $adminId = [];
            
            if($resultadmin->num_rows > 0){
                while($row = $resultadmin->fetch_assoc()){
                    $adminId[] = $row['officials_Id'];
                }
            }

            $statusnotif = "unseen";

            foreach($adminId as $officialsId){
                $sqln = "INSERT INTO notification (`officials_Id`, `form`, `status`) VALUES ('$officialsId', '$form', '$statusnotif')";
                $resultn = $conn->query($sqln);
            }
            
            

            echo "successInsert";
        }

        else{
            echo "errorInsert";
        }
    }

}

else if(isset($_POST['action']) && $_POST['action'] == "requestSA"){
    $officials_Id = $_POST['officials_Id'];
    $saForm_Id = $_POST['id'];
    $form = "SA";
    $status = "Pending";

    $sqls = "SELECT officials_Id, form_Id, status FROM request_list WHERE officials_Id = '$officials_Id' AND form_Id = '$saForm_Id' AND status = 'Pending'";
    $results = $conn->query($sqls);

    if($results->num_rows > 0){
        echo "stillpending";

    }
    //Dun na tayo time pag nag 0 secs is kusang madedelete yung sa request ng ar
    else{
        date_default_timezone_set("Asia/Manila");
        $date_requested = date('m/d/Y h:i:sa');

        $sqli = "INSERT INTO request_list (`officials_Id`, `form_Id`, `form`, `date_request`, `status`) VALUES ('$officials_Id', '$saForm_Id', '$form', '$date_requested', '$status')";
        $result = $conn->query($sqli);

        if($result){
            // Kunin natin ang mga id ng mga admin then isave natin yung id ng admin sa notification table para 
            
            $sqladmin = "SELECT * FROM officials WHERE user_type='superadmin' OR user_type='admin'";
            $resultadmin = $conn->query($sqladmin);

            $adminId = [];
            
            if($resultadmin->num_rows > 0){
                while($row = $resultadmin->fetch_assoc()){
                    $adminId[] = $row['officials_Id'];
                }
            }

            $statusnotif = "unseen";

            foreach($adminId as $officialsId){
                $sqln = "INSERT INTO notification (`officials_Id`, `form`, `status`) VALUES ('$officialsId', '$form', '$statusnotif')";
                $resultn = $conn->query($sqln);
            }

            echo "successInsert";
        }

        else{
            echo "errorInsert";
        }
    }

}


else if(isset($_POST['action']) && $_POST['action'] == "requestCV"){
    $officials_Id = $_POST['officials_Id'];
    $cvForm_Id = $_POST['id'];
    $form = "CV";
    $status = "Pending";

    $sqls = "SELECT officials_Id, form_Id, status FROM request_list WHERE officials_Id = '$officials_Id' AND form_Id = '$cvForm_Id' AND status = 'Pending'";
    $results = $conn->query($sqls);

    if($results->num_rows > 0){
        echo "stillpending";

    }
    //Dun na tayo time pag nag 0 secs is kusang madedelete yung sa request ng ar
    else{
        date_default_timezone_set("Asia/Manila");
        $date_requested = date('m/d/Y h:i:sa');

        $sqli = "INSERT INTO request_list (`officials_Id`, `form_Id`, `form`, `date_request`, `status`) VALUES ('$officials_Id', '$cvForm_Id', '$form', '$date_requested', '$status')";
        $result = $conn->query($sqli);

        if($result){

            // Kunin natin ang mga id ng mga admin then isave natin yung id ng admin sa notification table para 
            
            $sqladmin = "SELECT * FROM officials WHERE user_type='superadmin' OR user_type='admin'";
            $resultadmin = $conn->query($sqladmin);

            $adminId = [];
            
            if($resultadmin->num_rows > 0){
                while($row = $resultadmin->fetch_assoc()){
                    $adminId[] = $row['officials_Id'];
                }
            }

            $statusnotif = "unseen";

            foreach($adminId as $officialsId){
                $sqln = "INSERT INTO notification (`officials_Id`, `form`, `status`) VALUES ('$officialsId', '$form', '$statusnotif')";
                $resultn = $conn->query($sqln);
            }
            
            echo "successInsert";
        }

        else{
            echo "errorInsert";
        }
    }

}


else if(isset($_POST['action']) && $_POST['action'] == "confirmedReqAR"){
    $reqId = $_POST['req_Id'];

    $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0,10);

    $sqlu = "UPDATE request_list SET status='Confirmed', token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE req_Id='$reqId'";
    $resultu = $conn->query($sqlu);

    if($resultu){
        echo "successconfirmedrequest";
    }

    else{
        echo "errorconfirmedrequest";
    }
}

else if(isset($_POST['action']) && $_POST['action'] == "confirmedReqPO"){
    $officialsId = $_POST['officials_Id'];
    $reqId = $_POST['req_Id'];

    $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0,10);

    $sqlu = "UPDATE request_list SET status='Confirmed', token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE req_Id='$reqId'";
    $resultu = $conn->query($sqlu);

    if($resultu){


        echo "successconfirmedrequest";

        
    }

    else{
        echo "errorconfirmedrequest";
    }
}

else if(isset($_POST['action']) && $_POST['action'] == "confirmedReqSA"){
    $reqId = $_POST['req_Id'];

    $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0,10);

    $sqlu = "UPDATE request_list SET status='Confirmed', token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE req_Id='$reqId'";
    $resultu = $conn->query($sqlu);

    if($resultu){

        

        echo "successconfirmedrequest";
    }

    else{
        echo "errorconfirmedrequest";
    }
}

else if(isset($_POST['action']) && $_POST['action'] == "confirmedReqCV"){
    $reqId = $_POST['req_Id'];

    $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0,10);

    $sqlu = "UPDATE request_list SET status='Confirmed', token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE req_Id='$reqId'";
    $resultu = $conn->query($sqlu);

    if($resultu){
        echo "successconfirmedrequest";
    }

    else{
        echo "errorconfirmedrequest";
    }
}

?>