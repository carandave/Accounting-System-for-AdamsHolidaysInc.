<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $form = $_GET['form'];

    if($form === "CV"){
        

        $sqlx = "SELECT * FROM cv WHERE archive='No' ORDER BY payment_method='PHP' DESC";
    $result = $conn->query($sqlx);

    $data = "

    <table border='1'>
        <thead>
            <tr>
                <th>CV No..</th>
                <th>Payee</th>
                <th>Date</th>
                <th>Agent</th>
                <th>Particular</th>
                <th>Passenger Name</th>
                <th>Payment Method</th>
                <th>ACR</th>
                <th>Total Amount</th>
                <th>Sum of Peso</th>
                <th>Check No.</th>
                <th>Received By</th>
                <th>Date Received</th>
                <th>Prepared By</th>
                <th>Checked By</th>
                <th>Approved By</th>
            </tr>
        </thead>

        <tbody>";

        while($row = $result->fetch_assoc()){
            $varia = 1;
            $cv_passengerNameArr = explode(",", $row['cv_passengerName']);

            $data.= "<tr>
                    <td>$row[cv_Number]</td>
                    <td>$row[payee]</td>
                    <td>$row[date]</td>
                    <td>$row[agent]</td>
                    <td>$row[particular]</td>
                    ";

            $data.="<td> ";
            
                    foreach($cv_passengerNameArr as $cv_passengerNameArrValue){
                            $data.= $cv_passengerNameArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="
                    <td>$row[payment_method]</td>
                    <td>$row[acr]</td>
                    <td>$row[total_amount]</td>
                    <td>$row[sum_of_peso]</td>
                    <td>$row[check_no]</td>
                    <td>$row[received_by]</td>
                    <td>$row[date_received]</td>
                    <td>$row[prepared_by]</td>
                    <td>$row[checked_by]</td>
                    <td>$row[approved_by]</td>
                ";

        }
    
        $data.= "
            </tbody> 
        </table> 
        ";

        // Dito na tayo sa pag didisplay ng child nested table sa export

        $name = "Check Voucher Report - ".date("d-m-Y");

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$name.xls");

        echo $data;

    }

    else if($form === ""){
        // echo "empty";

        header("Location: cv_list.php");
    }

    else {
        // echo "empty";

        header("Location: cv_list.php");
    }


    
    
?>