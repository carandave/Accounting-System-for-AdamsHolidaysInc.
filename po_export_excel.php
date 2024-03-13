<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $form = $_GET['form'];

    if($form === "PO"){
        

        $sqlx = "SELECT * FROM po WHERE archive='No' ORDER BY po_Id DESC";
    $result = $conn->query($sqlx);

    $data = "

    <table border='1'>
        <thead>
            <tr>
                <th>PO No.</th>
                <th>AR No.</th>
                <th>Supplier</th>
                <th>Address</th>
                <th>Agent</th>
                <th>Particular</th>
                <th>Rec Locator</th>
                <th>Conjunction</th>
                <th>Date</th>
                <th>Amount Deposit</th>
                <th>CV</th>
                <th>SA</th>
                <th>Category</th>
                <th>Airfare Group Name</th>
                <th>Airfare Payment Method</th>
                <th>Airfare ACR</th>
                <th>Airfare Passenger Name</th>
                <th>Airfare-Airfare Usd</th>
                <th>Airfare-Taxes Usd</th>
                <th>Airfare-Iata Usd</th>
                <th>Airfare-Airfare Php</th>
                <th>Airfare-Taxes Php</th>
                <th>Airfare-Iata Php</th>
                <th>Airfare Sub Total Usd</th>
                <th>Airfare Sub Total Php</th>
                <th>Airfare Sub Final Total Usd</th>
                <th>Airfare Sub Final Total Php</th>
                <th>Airfare Total Amount</th>
                <th>Airfare Amount In Words</th>

                <th>Hotel Payment Method</th>
                <th>Hotel ACR</th>
                <th>Hotel Passenger Name</th>
                <th>Hotel-Hotel Usd</th>
                <th>Hotel-Taxes Usd</th>
                <th>Hotel-Hotel Php</th>
                <th>Hotel-Taxes Php</th>
                <th>Hotel Sub Total Usd</th>
                <th>Hotel Sub Total Php</th>
                <th>Hotel Total Amount</th>
                <th>Hotel Amount In Words</th>
                <th>Prepared By</th>
                <th>Checked By</th>
                <th>Approved By</th>
            </tr>
        </thead>

        <tbody>";

        while($row = $result->fetch_assoc()){
            $varia = 1;
            $airfare_passengerNameArr = explode(",", $row['airfare_passengerName']);

            $airfare_airfare_usdArr = explode(",", $row['airfare_airfare_usd']);
            $airfare_taxes_usdArr = explode(",", $row['airfare_taxes_usd']);
            $airfare_iata_usdArr = explode(",", $row['airfare_iata_usd']);

            $airfare_airfare_phpArr = explode(",", $row['airfare_airfare_php']);
            $airfare_taxes_phpArr = explode(",", $row['airfare_taxes_php']);
            $airfare_iata_phpArr = explode(",", $row['airfare_iata_php']);

            $hotel_passengerNameArr = explode(",", $row['hotel_passengerName']);

            $data.= "<tr>
                    <td>$row[po_Number]</td>
                    <td>$row[or_No]</td>
                    <td>$row[supplier]</td>
                    <td>$row[address]</td>
                    <td>$row[agent]</td>
                    <td>$row[particular]</td>
                    <td>$row[rec_locator]</td>
                    <td>$row[conjunction]</td>
                    <td>$row[date]</td>
                    <td>$row[amount_deposit]</td>
                    <td>$row[cv]</td>
                    <td>$row[sa]</td>
                    <td>$row[po_category]</td>
                    <td>$row[airfare_groupName]</td>
                    <td>$row[airfare_paymentMethod]</td>
                    <td>$row[airfare_acr]</td>
                    ";

            $data.="<td> ";
            
                    foreach($airfare_passengerNameArr as $airfare_passengerNameArrValue){
                            $data.= $airfare_passengerNameArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="<td> ";
            
                    foreach($airfare_airfare_usdArr as $airfare_airfare_usdArrValue){
                            $data.= $airfare_airfare_usdArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="<td> ";
            
                    foreach($airfare_taxes_usdArr as $airfare_taxes_usdArrValue){
                            $data.= $airfare_taxes_usdArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="<td> ";
            
                    foreach($airfare_iata_usdArr as $airfare_iata_usdArrValue){
                            $data.= $airfare_iata_usdArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="<td> ";
            
                    foreach($airfare_airfare_phpArr as $airfare_airfare_phpArrValue){
                            $data.= $airfare_airfare_phpArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="<td> ";
            
                    foreach($airfare_taxes_phpArr as $airfare_taxes_phpArrValue){
                            $data.= $airfare_taxes_phpArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="<td> ";
            
                    foreach($airfare_iata_phpArr as $airfare_iata_phpArrValue){
                            $data.= $airfare_iata_phpArrValue. '<br>';
                    }
            $data.="</td>";

            

            $data.="
                    <td>$row[airfare_sub_total_usd]</td>
                    <td>$row[airfare_sub_total_php]</td>
                    <td>$row[airfare_final_sub_total_usd]</td>
                    <td>$row[airfare_final_sub_total_php]</td>
                    <td>$row[airfare_totalAmount]</td>
                    <td>$row[airfare_amountInWords]</td>

                    <td>$row[hotel_paymentMethod]</td>
                    <td>$row[hotel_acr]</td>
                ";

            $data.="<td> ";
                    
                    foreach($hotel_passengerNameArr as $hotel_passengerNameArrValue){
                            $data.= $hotel_passengerNameArrValue. '<br>';
                    }
            $data.="</td>";

            $data.="
                    <td>$row[hotel_hotel_usd]</td>
                    <td>$row[hotel_hotel_php]</td>
                    <td>$row[hotel_taxes_usd]</td>
                    <td>$row[hotel_taxes_php]</td>
                    <td>$row[hotel_sub_total_usd]</td>
                    <td>$row[hotel_sub_total_php]</td>
                    <td>$row[hotel_totalAmount]</td>
                    <td>$row[hotelland_amountInWords]</td>
                    <td>$row[preparedBy]</td>
                    <td>$row[approvedBy]</td>
                    <td>$row[checkedBy]</td>
                    </tr>";

            // $data.="
            //         <td>$row[total_amount]</td>
            //         <td>$row[PR_no]</td>
            //         <td>$row[by_signature]</td>
            //     </tr>";
        }
    
        $data.= "
            </tbody> 
        </table> 
        ";

        // Dito na tayo sa pag didisplay ng child nested table sa export

        $name = "Purchase Order Receipt - ".date("d-m-Y");

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$name.xls");

        echo $data;

    }

    else if($form === ""){
        // echo "empty";

        header("Location: po_list.php");
    }

    else {
        // echo "empty";

        header("Location: po_list.php");
    }


    
    
?>