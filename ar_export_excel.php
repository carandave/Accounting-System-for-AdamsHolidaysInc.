<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $form = $_GET['form'];

    if($form === "AR"){

        $sqlx = "SELECT * FROM ar WHERE archive='No' ORDER BY ar_Id DESC";
        $result = $conn->query($sqlx);

        $data = "

        <table border='1' class='table table-bordered table-responsive table-hover table-sm' style='width: 90%; margin: 0 auto;'>
                        <thead style='width: 100%;'>
                            <tr>
                                <th>AR No.</th>
                                <th>Received From</th>
                                <th>Business Name</th>
                                <th>Address</th>
                                <th>TIN No.</th>
                                <th>Sum of Pesos</th>
                                <th>Full/Partial Payment</th>
                                <th>Date</th>
                                <th>Transaction</th>
                                <th>ACR</th>
                                <th>USD Amount</th>
                                <th>PHP Value</th>
                                <th>Cash Amount</th>
                                <th>Check Bank</th>
                                <th>Check No.</th>
                                <th>Check Amount</th>
                                <th>Pax Name</th>
                                <th>Pax Service</th>
                                <th>Pax Amount</th>
                                <th>Total Amount</th>
                                <th>Reference No.</th>
                                <th>By Signature</th>
                            </tr>
                        </thead>

                        <tbody>";

                        while($row = $result->fetch_assoc()){
                            $varia = 1;
                            $checkBank1Arr = explode(",", $row['checkBank1']);
                            $checkNo1Arr = explode(",", $row['check_no1']);
                            $checkAmount1Arr = explode(",", $row['check_amount1']);


                            $paxNameArr = explode(",", $row['pax_name']);
                            $paxServiceArr = explode(",", $row['pax_service']);
                            $paxAmountArr = explode(",", $row['pax_amount']);
                            

                            $data.= "<tr>
                                    <td>$row[ar_Number]</td>
                                    <td>$row[received_from]</td>
                                    <td>$row[business_name]</td>
                                    <td>$row[address]</td>
                                    <td>$row[tin]</td>
                                    <td>$row[sum]</td>
                                    <td>$row[full]</td>
                                    <td>$row[date]</td>
                                    <td>$row[transaction]</td>
                                    <td>$row[acr]</td>
                                    <td>$row[usd_amount]</td>
                                    <td>$row[php_val]</td>
                                    <td>$row[cash_amount]</td>";

                            $data.="<td> ";
                            
                                    foreach($checkBank1Arr as $checkBank1ArrValue){
                                            $data.= $checkBank1ArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($checkNo1Arr as $checkNo1ArrValue){
                                            $data.= $checkNo1ArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($checkAmount1Arr as $checkAmount1Value){
                                            $data.= $checkAmount1Value. '<br>';
                                    }
                            $data.="</td>";

                            // For Pax

                            $data.="<td> ";
                            
                                    foreach($paxNameArr as $paxNameArrValue){
                                            $data.= $paxNameArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($paxServiceArr as $paxServiceArrValue){
                                            $data.= $paxServiceArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($paxAmountArr as $paxAmountArrValue){
                                            $data.= $paxAmountArrValue. '<br>';
                                    }
                            $data.="</td>";
                                    
                            

                            $data.="
                                    <td>$row[total_amount]</td>
                                    <td>$row[PR_no]</td>
                                    <td>$row[by_signature]</td>
                                </tr>";
                        }
                    
                        $data.= "
                            </tbody> 
                        </table> 
            ";

        

        $name = "Acknowledgement Receipt - ".date("d-m-Y");

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$name.xls");

        echo $data;

    }

    else if($form === ""){
        // echo "empty";

        header("Location: ar_list.php");
    }

    else {
        // echo "empty";

        header("Location: ar_list.php");
    }


    
    
?>