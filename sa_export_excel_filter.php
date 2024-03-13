<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_GET['from']) && isset($_GET['to'])){
         $from = $_GET['from'];
         $to = $_GET['to'];


         $sqlx = " SELECT s.sa_Id, s.sa_Number, s.name_of_client, s.agent, s.group_name, s.particulars, s.co, s.date, s.po_No, s.or_No, s.prepared_by, s.checked_by, s.approved_by, s.sa_paymentMethod, s.sa_acr, s.sa_passengerName, s.tourcost_usd, s.tourcost_arc, s.tourcost_php, s.taxes_usd, s.taxes_arc, s.taxes_php, s.tip_fund_usd, s.tip_fund_arc, s.tip_fund_php, s.travel_insurance_usd, s.travel_insurance_arc,s.travel_insurance_php, s.parent_data_visa_fee_passengerName, s.parent_data_visa_fee_usd, s.parent_data_visa_fee_arc, s.parent_data_visa_fee_php, s.parent_data_other_passengerName, s.parent_data_other_usd, s.parent_data_other_arc, s.parent_data_other_php, s.select_sub_total_usd, s.select_sub_total_php, s.sub_total_usd, s.sub_total_php, s.total_of_sub_total, s.sa_date_deposit, s.sa_amount_deposit, s.total_amount_deposit, s.total_amount, s.archive, v.nested_data_visa_fee_passengerName, v.nested_data_visa_fee_usd,  v.nested_data_visa_fee_arc, v.nested_data_visa_fee_php, o.nested_data_other_passengerName, o.nested_data_other_usd,  o.nested_data_other_arc, o.nested_data_other_php FROM sa s INNER JOIN sa_nested_table v ON s.sa_Id = v.sa_Id INNER JOIN sa_nested_other_table o ON s.sa_Id = o.sa_Id WHERE archive='No' AND date BETWEEN '$from' AND '$to' ORDER BY sa_Id DESC";
                $result = $conn->query($sqlx);
                
                $data = "

                <table border='1' class='table table-bordered table-responsive table-hover table-sm' style='width: 90%; margin: 0 auto;'>
                <thead style='width: 100%;'>
                    <tr>
                    <th>SA No.</th>
                    <th>PO No.</th>
                    <th>AR No.</th>
                    <th>Name of Client</th>
                    <th>Agent</th>
                    <th>Group Name</th>
                    <th>Particulars</th>
                    <th>C/O</th>
                    <th>Date</th>
                    <th>Prepared BY</th>
                    <th>Checked By</th>
                    <th>Approved By</th>
                    <th>Payment Method</th>
                    <th>ACR</th>
                    <th>Passenger Name</th>
                    <th>Tourcost Usd</th>
                    <th>Tourcost Acr</th>
                    <th>Tourcost Php</th>
                    <th>Taxes Usd</th>
                    <th>Taxes Acr</th>
                    <th>Taxes Php</th>
                    <th>Tip Fund Usd</th>
                    <th>Tip Fund Acr</th>
                    <th>Tip Fund Php</th>
                    <th>Travel Insurance Usd</th>
                    <th>Travel Insurance Acr</th>
                    <th>Travel Insurance Php</th>
                    <th>Parent Visa Fee Passenger Name</th>
                    <th>Parent Visa Fee Usd</th>
                    <th>Parent Visa Fee Acr</th>
                    <th>Parent Visa Fee Php</th>
                    <th>Child Visa Fee Passenger Name</th>
                    <th>Child Visa Fee Usd</th>
                    <th>Child Visa Fee Acr</th>
                    <th>Child Visa Fee Php</th>
                    <th>Parent Other Passenger Name</th>
                    <th>Parent Other Usd</th>
                    <th>Parent Other Acr</th>
                    <th>Parent Other Php</th>
                    <th>Child Other Passenger Name</th>
                    <th>Child Other Usd</th>
                    <th>Child Other Acr</th>
                    <th>Child Other Php</th>
                    <th>Individual Sub Total Usd</th>
                    <th>Individual Sub Total Php</th>
                    <th>Individual Sum Sub Total Usd</th>
                    <th>Individual Sum Sub Total Php</th>
                    <th>Final Total of Sub Total</th>
                    <th>Date Deposit</th>
                    <th>Amount Deposit</th>
                    <th>Total Amount Deposit</th>
                    <th>Total Amount</th>
                    </tr>
                </thead>

                <tbody>";

                while($row = $result->fetch_assoc()){
                    $varia = 1;
                    $sa_passengerNameArr = explode(",", $row['sa_passengerName']);

            $tourcost_usdArr = explode(",", $row['tourcost_usd']);
            $tourcost_arcArr = explode(",", $row['tourcost_arc']);
            $tourcost_phpArr = explode(",", $row['tourcost_php']);

            $taxes_usdArr = explode(",", $row['taxes_usd']);
            $taxes_arcArr = explode(",", $row['taxes_arc']);
            $taxes_phpArr = explode(",", $row['taxes_php']);

            $tip_fund_usdArr = explode(",", $row['tip_fund_usd']);
            $tip_fund_arcArr = explode(",", $row['tip_fund_arc']);
            $tip_fund_phpArr = explode(",", $row['tip_fund_php']);

            $travel_insurance_usdArr = explode(",", $row['travel_insurance_usd']);
            $travel_insurance_arcArr = explode(",", $row['travel_insurance_arc']);
            $travel_insurance_phpArr = explode(",", $row['travel_insurance_php']);

            $parent_data_visa_fee_passengerNameArr = explode(",", $row['parent_data_visa_fee_passengerName']);
            $parent_data_visa_fee_usdArr = explode(",", $row['parent_data_visa_fee_usd']);
            $parent_data_visa_fee_arcArr = explode(",", $row['parent_data_visa_fee_arc']);
            $parent_data_visa_fee_phpArr = explode(",", $row['parent_data_visa_fee_php']);

            $nested_data_visa_fee_passengerNameArr = json_decode($row['nested_data_visa_fee_passengerName'], true);

            // print_r($nested_data_visa_fee_passengerNameArr);
            // echo '<div>';
            // echo '</div>';
            // echo '</br>';
            
            $nested_data_visa_fee_usdArr = json_decode($row['nested_data_visa_fee_usd'], true);
            // print_r($nested_data_visa_fee_usdArr);
            // echo '<div>';
            // echo '</div>';
            // echo '</br>';

            $nested_data_visa_fee_arcArr = json_decode($row['nested_data_visa_fee_arc'], true);
            // print_r($nested_data_visa_fee_arcArr);
            // echo '<div>';
            // echo '</div>';
            // echo '</br>';

            $nested_data_visa_fee_phpArr = json_decode($row['nested_data_visa_fee_php'], true);

            $parent_data_other_passengerNameArr = explode(",", $row['parent_data_other_passengerName']);
            $parent_data_other_usdArr = explode(",", $row['parent_data_other_usd']);
            $parent_data_other_arcArr = explode(",", $row['parent_data_other_arc']);
            $parent_data_other_phpArr = explode(",", $row['parent_data_other_php']);

            $nested_data_other_passengerNameArr = json_decode($row['nested_data_other_passengerName'], true);
            $nested_data_other_usdArr = json_decode($row['nested_data_other_usd'], true);
            $nested_data_other_arcArr = json_decode($row['nested_data_other_arc'], true);
            $nested_data_other_phpArr = json_decode($row['nested_data_other_php'], true);
            

            $data.= "<tr>
                    <td>$row[sa_Number]</td>
                    <td>$row[po_No]</td>
                    <td>$row[or_No]</td>
                    <td>$row[name_of_client]</td>
                    <td>$row[agent]</td>
                    <td>$row[group_name]</td>
                    <td>$row[particulars]</td>
                    <td>$row[co]</td>
                    <td>$row[date]</td>
                    <td>$row[prepared_by]</td>
                    <td>$row[checked_by]</td>
                    <td>$row[approved_by]</td>
                    <td>$row[sa_paymentMethod]</td>
                    <td>$row[sa_acr]</td>
                    ";

            $data.="<td> ";
    
                foreach($sa_passengerNameArr as $sa_passengerNameArrValue){
                        $data.= $sa_passengerNameArrValue. '<br>';
                }
            $data.="</td>";


            // Tour Cost

            $data.="<td> ";
    
                foreach($tourcost_usdArr as $tourcost_usdArrValue){
                        $data.= $tourcost_usdArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($tourcost_arcArr as $tourcost_arcArrValue){
                        $data.= $tourcost_arcArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($tourcost_phpArr as $tourcost_phpArrValue){
                        $data.= $tourcost_phpArrValue. '<br>';
                }
            $data.="</td>";



            // Taxes


            $data.="<td> ";
    
                foreach($taxes_usdArr as $taxes_usdArrValue){
                        $data.= $taxes_usdArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($taxes_arcArr as $taxes_arcArrValue){
                        $data.= $taxes_arcArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($taxes_phpArr as $taxes_phpArrValue){
                        $data.= $taxes_phpArrValue. '<br>';
                }
            $data.="</td>";


            // Tip Fund


            $data.="<td> ";
    
                foreach($tip_fund_usdArr as $tip_fund_usdArrValue){
                        $data.= $tip_fund_usdArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($tip_fund_arcArr as $tip_fund_arcArrValue){
                        $data.= $tip_fund_arcArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($tip_fund_phpArr as $tip_fund_phpArrValue){
                        $data.= $tip_fund_phpArrValue. '<br>';
                }
            $data.="</td>";


            // Travel Insurance


            $data.="<td> ";
    
                foreach($travel_insurance_usdArr as $travel_insurance_usdArrValue){
                        $data.= $travel_insurance_usdArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($travel_insurance_arcArr as $travel_insurance_arcArrValue){
                        $data.= $travel_insurance_arcArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($travel_insurance_phpArr as $travel_insurance_phpArrValue){
                        $data.= $travel_insurance_phpArrValue. '<br>';
                }
            $data.="</td>";


            // Visa Fee

            $data.="<td> ";
    
                foreach($parent_data_visa_fee_passengerNameArr as $parent_data_visa_fee_passengerNameArrIndex => $parent_data_visa_fee_passengerNameArrValue){
                        $data.= $parent_data_visa_fee_passengerNameArrValue. '<br>';

                }
            $data.="</td>";


            $data.="<td> ";
    
                foreach($parent_data_visa_fee_usdArr as $parent_data_visa_fee_usdArrValue){
                        $data.= $parent_data_visa_fee_usdArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($parent_data_visa_fee_arcArr as $parent_data_visa_fee_arcArrValue){
                        $data.= $parent_data_visa_fee_arcArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($parent_data_visa_fee_phpArr as $parent_data_visa_fee_phpArrValue){
                        $data.= $parent_data_visa_fee_phpArrValue. '<br>';
                }
            $data.="</td>";

            // Nested Visa Fee

            $data.="<td> ";

                foreach($parent_data_visa_fee_passengerNameArr as $parent_data_visa_fee_passengerNameArrIndex => $parent_data_visa_fee_passengerNameArrValue){
                    
                    foreach($nested_data_visa_fee_passengerNameArr as $nested_data_visa_fee_passengerNameArrIndex => $nested_data_visa_fee_passengerNameArrValue){
                        
                        if($parent_data_visa_fee_passengerNameArrIndex == $nested_data_visa_fee_passengerNameArrIndex){
                            foreach ($nested_data_visa_fee_passengerNameArr as $index => $passenger) {
                                if($parent_data_visa_fee_passengerNameArrIndex == $index){
                                    foreach ($passenger as $childIndex => $childName) {
                                        
                                        $data.= $childName. '<br>';
                                    }
                                }
                            }
                        }
                        
                        // $data.= $nested_data_visa_fee_passengerNameArrValue. '<br>';
                    }

                }
    
                
            $data.="</td>";

            $data.="<td> ";
    
                foreach($parent_data_visa_fee_usdArr as $parent_data_visa_fee_usdArrIndex => $parent_data_visa_fee_usdArrValue){
                        
                    foreach($nested_data_visa_fee_usdArr as $nested_data_visa_fee_usdArrIndex => $nested_data_visa_fee_usdArrValue){
                        
                        if($parent_data_visa_fee_usdArrIndex == $nested_data_visa_fee_usdArrIndex){
                            foreach ($nested_data_visa_fee_usdArr as $index => $visafeeusd) {
                                if($parent_data_visa_fee_usdArrIndex == $index){
                                    foreach ($visafeeusd as $childIndex => $visafeeUsd) {
                                        
                                        $data.= $visafeeUsd. '<br>';
                                    }
                                }
                            }
                        }
                        
                        // $data.= $nested_data_visa_fee_passengerNameArrValue. '<br>';
                    }

                }
            $data.="</td>";

            $data.="<td>$row[sa_acr]</td>";

            $data.="<td> ";
    
                foreach($parent_data_visa_fee_phpArr as $parent_data_visa_fee_phpArrIndex => $parent_data_visa_fee_phpArrValue){
                        
                    foreach($nested_data_visa_fee_phpArr as $nested_data_visa_fee_phpArrIndex => $nested_data_visa_fee_phpArrArrValue){
                        
                        if($parent_data_visa_fee_phpArrIndex == $nested_data_visa_fee_phpArrIndex){
                            foreach ($nested_data_visa_fee_phpArr as $index => $visafeephp) {
                                if($parent_data_visa_fee_phpArrIndex == $index){
                                    foreach ($visafeephp as $childIndex => $visafeePhp) {
                                        
                                        $data.= $visafeePhp. '<br>';
                                    }
                                }
                            }
                        }
                        
                        // $data.= $nested_data_visa_fee_passengerNameArrValue. '<br>';
                    }

                }
            $data.="</td>";

            // Other

            $data.="<td> ";
    
                foreach($parent_data_other_passengerNameArr as $parent_data_other_passengerNameArrValue){
                        $data.= $parent_data_other_passengerNameArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($parent_data_other_usdArr as $parent_data_other_usdArrValue){
                        $data.= $parent_data_other_usdArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($parent_data_other_arcArr as $parent_data_other_arcArrValue){
                        $data.= $parent_data_other_arcArrValue. '<br>';
                }
            $data.="</td>";

            $data.="<td> ";
    
                foreach($parent_data_other_phpArr as $parent_data_other_phpArrValue){
                        $data.= $parent_data_other_phpArrValue. '<br>';
                }
            $data.="</td>";

            // Nested Other

            $data.="<td> ";

                foreach($parent_data_other_passengerNameArr as $parent_data_other_passengerNameArrIndex => $parent_data_other_passengerNameArrValue){
                    
                    foreach($nested_data_other_passengerNameArr as $nested_data_other_passengerNameArrIndex => $nested_data_other_passengerNameArrValue){
                        
                        if($parent_data_other_passengerNameArrIndex == $nested_data_other_passengerNameArrIndex){
                            foreach ($nested_data_other_passengerNameArr as $index => $passenger) {
                                if($parent_data_other_passengerNameArrIndex == $index){
                                    foreach ($passenger as $childIndex => $childName) {
                                        
                                        $data.= $childName. '<br>';
                                    }
                                }
                            }
                        }
                        
                        // $data.= $nested_data_visa_fee_passengerNameArrValue. '<br>';
                    }

                }
    
                
            $data.="</td>";

            $data.="<td> ";

                foreach($parent_data_other_usdArr as $parent_data_other_usdArrIndex => $parent_data_other_usdArrValue){
                    
                    foreach($nested_data_other_usdArr as $nested_data_other_usdArrIndex => $nested_data_other_usdArrValue){
                        
                        if($parent_data_other_usdArrIndex == $nested_data_other_usdArrIndex){
                            foreach ($nested_data_other_usdArr as $index => $otherusd) {
                                if($parent_data_other_usdArrIndex == $index){
                                    foreach ($otherusd as $childIndex => $otherUsd) {
                                        
                                        $data.= $otherUsd. '<br>';
                                    }
                                }
                            }
                        }
                        
                        // $data.= $nested_data_visa_fee_passengerNameArrValue. '<br>';
                    }

                }
    
                
            $data.="</td>";

            $data.="<td>$row[sa_acr]</td>";


            $data.="<td> ";

                foreach($parent_data_other_phpArr as $parent_data_other_phpArrIndex => $parent_data_other_phpArrValue){
                    
                    foreach($nested_data_other_phpArr as $nested_data_other_phpArrIndex => $nested_data_other_phpArrValue){
                        
                        if($parent_data_other_phpArrIndex == $nested_data_other_phpArrIndex){
                            foreach ($nested_data_other_phpArr as $index => $otherphp) {
                                if($parent_data_other_phpArrIndex == $index){
                                    foreach ($otherphp as $childIndex => $otherPhp) {
                                        
                                        $data.= $otherPhp. '<br>';
                                    }
                                }
                            }
                        }
                        
                        // $data.= $nested_data_visa_fee_passengerNameArrValue. '<br>';
                    }

                }
    
                
            $data.="</td>";

            $data.="
                    <td>$row[select_sub_total_usd]</td>
                    <td>$row[select_sub_total_php]</td>
                    <td>$row[sub_total_usd]</td>
                    <td>$row[sub_total_php]</td>
                    <td>$row[total_of_sub_total]</td>
                    <td>$row[sa_date_deposit]</td>
                    <td>$row[sa_amount_deposit]</td>
                    <td>$row[total_amount_deposit]</td>
                    <td>$row[total_amount]</td>
                ";
                    

            
        }
    
        $data.= "
            </tbody> 
        </table> 
        ";

                    

                    $name = "Statement of Account - From: ".$from. " To: ".$to;

                    header("Content-Type: application/xls");
                    header("Content-Disposition: attachment; filename=$name.xls");
            
                    echo $data;
                
                

        
    }

    


    
    
?>