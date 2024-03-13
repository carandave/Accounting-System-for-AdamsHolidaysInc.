<?php 

    require_once "connection.php";

    if(isset($_POST['action']) && $_POST['action'] == "addOfficial"){
        $official_by = $_POST['official_by'];
        $name = $_POST['name'];
        $user_name = $_POST['user_name'];
        $user_type = $_POST['user_type'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $date_inserted = date('Y-m-d');

        if($name == "" || $user_name == "" || $user_type == "" || $password == "" || $confirm_password == ""){
            echo "EmptyInput";

            
        }

        else{
            if($password != $confirm_password){
                echo "Mismatch";
            }

            else{

                $password = sha1($password);

                $sql = "INSERT INTO officials (username, password, name, user_type, date_inserted) VALUES ('$user_name', '$password', '$name', '$user_type','$date_inserted')";
                $result = $conn->query($sql);

                if($result){
                    echo "successInsert";
                }
                else{
                    echo "errorInsert";
                }
            }
        }

        
    }

    // For AR Insert Database
    if(isset($_POST['action']) && $_POST['action'] == "AddAR"){
         $receive_from = $_POST['receive_from'];
         $business_name = $_POST['business_name'];
         $address = $_POST['address'];
         $tin = $_POST['tin'];
         $sum_of_pesos = $_POST['sum_of_pesos'];
         $full_payment = $_POST['full_payment'];
         $date = $_POST['date'];
         $transaction = $_POST['transaction'];
         $acr = $_POST['acrD'];
         $usd = $_POST['usdD'];
         $php = $_POST['php'];
         $cash = $_POST['cashD'];

         $checkBankArr = $_POST['checkBank'];
         $checkBankArr = implode(",", $checkBankArr);

         $checkNoArr = $_POST['checkNo'];
         $checkNoArr = implode(",", $checkNoArr);

         $checkNoAmountArr1 = $_POST['checkAmount'];
         $checkNoAmountArr = implode(",", $checkNoAmountArr1);

         $checkNoAmountArrTotal = array_sum($checkNoAmountArr1);

         //Pax Inputted Value Array
         $paxNameArr = $_POST['paxName'];
         $paxNameArr = implode(",", $paxNameArr);

         $paxServiceArr = $_POST['paxService'];
         $paxServiceArr = implode(",", $paxServiceArr);

         $paxAmountArr = $_POST['paxAmount'];
         $paxAmountArr = implode(",", $paxAmountArr);
        
         $total = $_POST['total'];
         $pr_no = $_POST['pr_no'];
         $by = $_POST['by'];
         $status = "Unprinted";

         $archive = "No";

         $sumPhpCash = (float)$php + (float)$cash + $checkNoAmountArrTotal;

         

            if(empty($receive_from) || empty($full_payment) || empty($date) || empty($total) || empty($by)){
                echo "EmptyError";
            }

            // else if($sumPhpCash != $total){
            //     echo "calculatedError";
            // }

            else if($total == "NaN"){
                echo "NaN";
            }

            else if(empty($cash)){
                echo "EmptyCash";
            }

            else{

                // $arNumber = 0001;

                $queryAr = "SELECT ar_Number FROM ar ORDER BY ar_Number DESC LIMIT 1";
                $resultAr = $conn->query($queryAr);

                if($resultAr){
                    $rowAr = $resultAr->fetch_assoc();
                    $count = $rowAr['ar_Number'];
                    

                    $newEntryNumber = str_pad((int)$count + 1, 6, '00000', STR_PAD_LEFT);

                    $stmt = $conn->prepare("INSERT INTO ar (ar_Number, received_from, business_name, address, tin, sum, full, date, transaction, acr, usd_amount, php_val, cash_amount, checkBank1, check_no1, check_amount1, total_amount, pax_name, pax_service, pax_amount, PR_no, by_signature, status, archive) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); // Mag peprapre ulit tayo ng statement para makapg Insert ng data sa database
                    $stmt->bind_param("ssssssssssssssssssssssss", $newEntryNumber, $receive_from, $business_name, $address, $tin, $sum_of_pesos, $full_payment, $date, $transaction, $acr, $usd, $php, $cash, $checkBankArr, $checkNoArr, $checkNoAmountArr, $total, $paxNameArr, $paxServiceArr, $paxAmountArr, $pr_no, $by, $status, $archive); // Mag babind ulit tayo ng parameter para sa prepare statement
                        
                        if($stmt->execute()){ 
                            
                            $event = "Added";
                            $form = "AR";
                            date_default_timezone_set("Asia/Manila");
                            $dateAdded = date('Y-m-d');
                            $timeAdded = date('H:i:s');

                            $sql = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$by', '$event', '$form', '$dateAdded', '$timeAdded')";
                            $result = $conn->query($sql);

                            if($result === TRUE){
                                echo "Success";
                            }

                            else{
                                echo "Error";
                            }
                            
                            
                            
                        }

                        else{ 
                            echo "Error";
                        }
                    

                }

            }

        

            
    

        }

        // For PO Insert Database
    else if(isset($_POST['action']) && $_POST['action'] == "AddPO"){

        //  isesave na natin yung mga data sa PO

         $by_signature = $_POST['by'];


         $supplier = $_POST['supplier'];
         $address = $_POST['address'];
         $agent = $_POST['agent'];
         $particular = $_POST['particular'];
         $rec_locator = $_POST['rec_locator'];
         $conjunction = $_POST['conjunction'];
         $date = $_POST['date'];
         $amount_deposit = $_POST['amount_deposit'];
         $or = $_POST['or'];
         $cv = $_POST['cv'];
         $sa = $_POST['sa'];

         $category = $_POST['category'];

        // AIRFARE

        $airfare_groupName = $_POST['airfare_groupName'];

        

        

        

        $po_preparedBy = $_POST['po_preparedBy'];
        $po_checkedBy = $_POST['po_checkedBy'];
        $po_approvedBy = $_POST['po_approvedBy'];


        $archive = 'No';

        if(empty($supplier) || empty($address) | empty($agent) || empty($particular) || empty($rec_locator) || empty($conjunction) || empty($date) || empty($amount_deposit)){
           echo "EmptyError";
        }

        else{

            if($category=="Airfare"){
                if(!empty($_POST['airfare_paymentMethod'])) {
                    if(!empty($_POST['airfare_paymentMethod'])) {
                        $airfare_paymentMethod=$_POST['airfare_paymentMethod'];
                    }
    
                    else{
                        $airfare_paymentMethod = " ";
                    }
    
                    $airfare_acr = $_POST['airfare_acr'];
    
    
            
                    $airfare_passengerNameArr = $_POST['airfare_passengerName'];
                    $airfare_passengerNameArr = implode(",", $airfare_passengerNameArr);
    
                    
                    $airfare_airfare_usdArr = $_POST['airfare_usd'];
                    $airfare_airfare_usdArr = implode(",", $airfare_airfare_usdArr);
                    
                    $airfare_taxes_usdArr = $_POST['taxes_usd'];
                    $airfare_taxes_usdArr = implode(",", $airfare_taxes_usdArr);
                    
                    $airfare_iata_usdArr = $_POST['iata_usd'];
                    $airfare_iata_usdArr = implode(",", $airfare_iata_usdArr);
    
    
                    
                    $airfare_airfare_phpArr = $_POST['airfare_php'];
                    $airfare_airfare_phpArr = implode(",", $airfare_airfare_phpArr);
                    
                    $airfare_taxes_phpArr = $_POST['taxes_php'];
                    $airfare_taxes_phpArr = implode(",", $airfare_taxes_phpArr);
                    
                    $airfare_iata_phpArr = $_POST['iata_php'];
                    $airfare_iata_phpArr = implode(",", $airfare_iata_phpArr);
    
    
    
                    $airfare_sub_total_usdArr = $_POST['airfare_sub_total_usd'];
                    $airfare_sub_total_usdArr = implode(",", $airfare_sub_total_usdArr);
                    
                    $airfare_sub_total_phpArr = $_POST['airfare_sub_total_php'];
                    $airfare_sub_total_phpArr = implode(",", $airfare_sub_total_phpArr);
    
                    $airfare_final_sub_total_usdArr = $_POST['airfare_final_sub_total_usd'];
                    $airfare_final_sub_total_phpArr = $_POST['airfare_final_sub_total_php'];
    
    
                    $airfare_totalAmount = $_POST['airfare_totalAmount'];
                    $airfare_amountInWords = $_POST['airfare_amountInWords'];
                    
                    // HOTEL / LAND ARRANGEMENT
    
                    if(!empty($_POST['hotel_paymentMethod'])) {
                        $hotel_paymentMethod=$_POST['hotel_paymentMethod'];
                    }
    
                    else{
                        $hotel_paymentMethod = " ";
                    }
    
                    $hotel_acr = $_POST['hotel_acr'];
                    
                    $hotel_passengerNameArr = $_POST['hotel_passengerName'];
                    $hotel_passengerNameArr = implode(",", $hotel_passengerNameArr);
                    
                    $hotel_hotel_usd = $_POST['hotel_hotel_usd'];
                    $hotel_taxes_usd = $_POST['hotel_taxes_usd'];
    
                    $hotel_hotel_php = $_POST['hotel_hotel_php'];
                    $hotel_taxes_php = $_POST['hotel_taxes_php'];
    
                    $hotel_sub_total_usd = $_POST['hotel_sub_total_usd'];
                    $hotel_sub_total_php = $_POST['hotel_sub_total_php'];
                
                    $hotel_totalAmount = $_POST['hotel_totalAmount'];
                    $hotelland_amountInWords = $_POST['hotelland_amountInWords'];
                }
        
                else{
                    echo "paymentmethodempty";
                    return 1;
                }
            }
    
            elseif ($category=="Hotel"){
    
                if(!empty($_POST['hotel_paymentMethod'])) {
                    if(!empty($_POST['airfare_paymentMethod'])) {
                        $airfare_paymentMethod=$_POST['airfare_paymentMethod'];
                    }
    
                    else{
                        $airfare_paymentMethod = " ";
                    }
                    
    
                    $airfare_acr = $_POST['airfare_acr'];
    
    
            
                    $airfare_passengerNameArr = $_POST['airfare_passengerName'];
                    $airfare_passengerNameArr = implode(",", $airfare_passengerNameArr);
    
                    
                    $airfare_airfare_usdArr = $_POST['airfare_usd'];
                    $airfare_airfare_usdArr = implode(",", $airfare_airfare_usdArr);
                    
                    $airfare_taxes_usdArr = $_POST['taxes_usd'];
                    $airfare_taxes_usdArr = implode(",", $airfare_taxes_usdArr);
                    
                    $airfare_iata_usdArr = $_POST['iata_usd'];
                    $airfare_iata_usdArr = implode(",", $airfare_iata_usdArr);
    
    
                    
                    $airfare_airfare_phpArr = $_POST['airfare_php'];
                    $airfare_airfare_phpArr = implode(",", $airfare_airfare_phpArr);
                    
                    $airfare_taxes_phpArr = $_POST['taxes_php'];
                    $airfare_taxes_phpArr = implode(",", $airfare_taxes_phpArr);
                    
                    $airfare_iata_phpArr = $_POST['iata_php'];
                    $airfare_iata_phpArr = implode(",", $airfare_iata_phpArr);
    
    
    
                    $airfare_sub_total_usdArr = $_POST['airfare_sub_total_usd'];
                    $airfare_sub_total_usdArr = implode(",", $airfare_sub_total_usdArr);
                    
                    $airfare_sub_total_phpArr = $_POST['airfare_sub_total_php'];
                    $airfare_sub_total_phpArr = implode(",", $airfare_sub_total_phpArr);
    
                    $airfare_final_sub_total_usdArr = $_POST['airfare_final_sub_total_usd'];
                    $airfare_final_sub_total_phpArr = $_POST['airfare_final_sub_total_php'];
    
    
                    $airfare_totalAmount = $_POST['airfare_totalAmount'];
                    $airfare_amountInWords = $_POST['airfare_amountInWords'];
    
    
    
                    
                    // HOTEL / LAND ARRANGEMENT
    
                    if(!empty($_POST['hotel_paymentMethod'])) {
                        $hotel_paymentMethod=$_POST['hotel_paymentMethod'];
                    }
    
                    else{
                        $hotel_paymentMethod = " ";
                    }
    
                    $hotel_acr = $_POST['hotel_acr'];
                    
                    $hotel_passengerNameArr = $_POST['hotel_passengerName'];
                    $hotel_passengerNameArr = implode(",", $hotel_passengerNameArr);
                    
                    $hotel_hotel_usd = $_POST['hotel_hotel_usd'];
                    $hotel_taxes_usd = $_POST['hotel_taxes_usd'];
    
                    $hotel_hotel_php = $_POST['hotel_hotel_php'];
                    $hotel_taxes_php = $_POST['hotel_taxes_php'];
    
                    $hotel_sub_total_usd = $_POST['hotel_sub_total_usd'];
                    $hotel_sub_total_php = $_POST['hotel_sub_total_php'];
                
                    $hotel_totalAmount = $_POST['hotel_totalAmount'];
                    $hotelland_amountInWords = $_POST['hotelland_amountInWords'];
                }
        
                else{
                    echo "paymentmethodempty";
                    return 1;
                }
            }

            $queryPO = "SELECT po_Number FROM po ORDER BY po_Number DESC LIMIT 1";
            $resultPO = $conn->query($queryPO);

                if($resultPO){
                    $rowPO = $resultPO->fetch_assoc();
                    $count = $rowPO['po_Number'];

                    $newEntryNumberPO = str_pad((int)$count + 1, 6, '00000', STR_PAD_LEFT);

                    $stmt = $conn->prepare("INSERT INTO po (po_Number, supplier, address, agent, particular, rec_locator, conjunction, date, amount_deposit, or_No, cv, sa, po_category, airfare_groupName, airfare_paymentMethod, airfare_acr, airfare_passengerName, airfare_airfare_usd, airfare_taxes_usd, airfare_iata_usd, airfare_airfare_php, airfare_taxes_php, airfare_iata_php, airfare_sub_total_usd, airfare_sub_total_php, airfare_final_sub_total_usd, airfare_final_sub_total_php, airfare_totalAmount, airfare_amountInWords, hotel_paymentMethod, hotel_acr, hotel_passengerName, hotel_hotel_usd, hotel_hotel_php, hotel_taxes_usd, hotel_taxes_php, hotel_sub_total_usd, hotel_sub_total_php, hotel_totalAmount, hotelland_amountInWords, preparedBy, checkedBy, approvedBy, archive) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); // Mag peprapre ulit tayo ng statement para makapg Insert ng data sa database
                    $stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssss", $newEntryNumberPO, $supplier, $address, $agent, $particular, $rec_locator, $conjunction, $date, $amount_deposit, $or, $cv, $sa, $category, $airfare_groupName, $airfare_paymentMethod, $airfare_acr, $airfare_passengerNameArr, $airfare_airfare_usdArr, $airfare_taxes_usdArr, $airfare_iata_usdArr, $airfare_airfare_phpArr, $airfare_taxes_phpArr, $airfare_iata_phpArr, $airfare_sub_total_usdArr, $airfare_sub_total_phpArr, $airfare_final_sub_total_usdArr, $airfare_final_sub_total_phpArr, $airfare_totalAmount, $airfare_amountInWords, $hotel_paymentMethod, $hotel_acr, $hotel_passengerNameArr, $hotel_hotel_usd, $hotel_hotel_php, $hotel_taxes_usd, $hotel_taxes_php, $hotel_sub_total_usd, $hotel_sub_total_php, $hotel_totalAmount, $hotelland_amountInWords, $po_preparedBy, $po_checkedBy, $po_approvedBy, $archive); // Mag babind ulit tayo ng parameter para sa prepare statement

                    if($stmt->execute()){ 
                        
                        $event = "Added";
                        $form = "PO";
                        date_default_timezone_set("Asia/Manila");
                        $dateAdded = date('Y-m-d');
                        $timeAdded = date('H:i:s');

                        $sql = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$by_signature', '$event', '$form', '$dateAdded', '$timeAdded')";
                        $result = $conn->query($sql);

                        if($result === TRUE){
                            echo "Success";
                        }

                        else{
                            echo "Error";
                        }
                        
                        
                        
                    }

                    else{ 
                        echo "Error";
                    }

                }
           
        }

           
   }


   // For SA Insert Database
   else if(isset($_POST['action']) && $_POST['action'] == "AddSA"){
    $by = $_POST['by'];
    $name_of_client = $_POST['name_of_client'];
    $agent = $_POST['agent'];
    $group_name = $_POST['group_name'];
    $particulars = $_POST['particulars'];
    $co = $_POST['co'];
    $date = $_POST['date'];
    $po_no = $_POST['po_no'];
    $or_no = $_POST['or_no'];
    $sa_preparedBy = $_POST['sa_preparedBy'];
    $sa_checkedBy = $_POST['sa_checkedBy'];
    $sa_approvedBy = $_POST['sa_approvedBy'];
    $sa_acr = $_POST['sa_acr'];
    

    if(!empty($_POST['sa_paymentMethod'])) {

        $sa_paymentMethod=$_POST['sa_paymentMethod'];
        
    
    }

    else{
        $sa_paymentMethod = "";

    }

    

    // PASSENGER NAME
    $sa_passengerNameArr = $_POST['sa_passengerName'];
    $sa_passengerNameArr = implode(",", $sa_passengerNameArr);

    // TOURCOST USD
    $tourcost_usdArr = $_POST['tourcost_usd'];
    $tourcost_usdArr = implode(",", $tourcost_usdArr);

    // TOURCOST ARC
    $tourcost_arcArr = $_POST['tourcost_arc'];
    $tourcost_arcArr = implode(",", $tourcost_arcArr);

    // TOURCOST PHP
    $tourcost_phpArr = $_POST['tourcost_php'];
    $tourcost_phpArr = implode(",", $tourcost_phpArr);


    // TAXES USD
    $taxes_usdArr = $_POST['taxes_usd'];
    $taxes_usdArr = implode(",", $taxes_usdArr);

    // TAXES ARC
    $taxes_arcArr = $_POST['taxes_arc'];
    $taxes_arcArr = implode(",", $taxes_arcArr);

    // TAXES PHP
    $taxes_phpArr = $_POST['taxes_php'];
    $taxes_phpArr = implode(",", $taxes_phpArr);


    // TIP FUND USD
    $tip_fund_usdArr = $_POST['tip_fund_usd'];
    $tip_fund_usdArr = implode(",", $tip_fund_usdArr);

    // TIP FUND ARC
    $tip_fund_arcArr = $_POST['tip_fund_arc'];
    $tip_fund_arcArr = implode(",", $tip_fund_arcArr);

    // TIP FUND PHP
    $tip_fund_phpArr = $_POST['tip_fund_php'];
    $tip_fund_phpArr = implode(",", $tip_fund_phpArr);


    // TRAVEL INSURANCE USD
    $travel_insurance_usdArr = $_POST['travel_insurance_usd'];
    $travel_insurance_usdArr = implode(",", $travel_insurance_usdArr);

    // TRAVEL INSURANCE ARC
    $travel_insurance_arcArr = $_POST['travel_insurance_arc'];
    $travel_insurance_arcArr = implode(",", $travel_insurance_arcArr);

    // TRAVEL INSURANCE PHP
    $travel_insurance_phpArr = $_POST['travel_insurance_php'];
    $travel_insurance_phpArr = implode(",", $travel_insurance_phpArr);


    // OTHER USD
    $other_usdArr = $_POST['other_usd'];
    $other_usdArr = implode(",", $other_usdArr);

    // OTHER ARC
    $other_arcArr = $_POST['other_arc'];
    $other_arcArr = implode(",", $other_arcArr);

    // OTHER PHP
    $other_phpArr = $_POST['other_php'];
    $other_phpArr = implode(",", $other_phpArr);

    // SELECT SUB TOTAL USD
    $select1_total_usdArr = $_POST['select1_total_usd'];
    $select1_total_usdArr = implode(",", $select1_total_usdArr);

    // SELECT SUB TOTAL PHP
    $select1_total_phpArr = $_POST['select1_total_php'];
    $select1_total_phpArr = implode(",", $select1_total_phpArr);


    $sub_total_usd = $_POST['sub_total_usd'];
    $sub_total_php = $_POST['sub_total_php'];

    $total_of_sub_total = $_POST['total_of_sub_total'];


    // DATE DEPOSIT
    $sa_date_depositArr = $_POST['sa_date_deposit'];
    $sa_date_depositArr = implode(",", $sa_date_depositArr);

    // AMOUNT DEPOSIT
    $sa_amount_depositArr = $_POST['sa_amount_deposit'];
    $sa_amount_depositArr = implode(",", $sa_amount_depositArr);

    $total_amount_deposit = $_POST['total_amount_deposit'];

    $total_amount = $_POST['total_amount'];

    $archive = 'No';

    // For Visa Fee Start

    $visa_fee_nameArr = $_POST['visa_fee_name'];
    $visa_fee_usdArr = $_POST['visa_fee_usd'];
    $visa_fee_arcArr = $_POST['visa_fee_arc'];
    $visa_fee_phpArr = $_POST['visa_fee_php'];

    $visa_fee_nameArrParentJSON = implode(",", $visa_fee_nameArr);
    $visa_fee_usdArrParentJSON = implode(",", $visa_fee_usdArr);
    $visa_fee_arcArrParentJSON = implode(",", $visa_fee_arcArr);
    $visa_fee_phpArrParentJSON = implode(",", $visa_fee_phpArr);

    
    
    // $nested_visa_fee_subtotal_usdArr = implode(",", $nested_visa_fee_subtotal_usdArr);

    
    
    // $nested_visa_fee_subtotal_phpArr = implode(",", $nested_visa_fee_subtotal_phpArr);
    
    $nested_visa_fee_nameArrFields = $_POST['nested_visa_fee_name'] ?? [];
    $nested_visa_fee_usdArrFields = $_POST['nested_visa_fee_usd'] ?? [];
    $nested_visa_fee_arcArrFields = $_POST['nested_visa_fee_arc'] ?? [];
    $nested_visa_fee_phpArrFields = $_POST['nested_visa_fee_php'] ?? [];
    $nested_visa_fee_subtotal_usdArrFields = $_POST['nested_visa_fee_subtotal_usd'];
    $nested_visa_fee_subtotal_phpArrFields = $_POST['nested_visa_fee_subtotal_php'];

    // For Visa Fee End


    // For Other Start

    // Undefined Array Key kapag hindi nag add nested sa Visa Fee

    $other_nameArr = $_POST['other_name'];
    $other_usdArr = $_POST['other_usd'];
    $other_arcArr = $_POST['other_arc'];
    $other_phpArr = $_POST['other_php'];

    $other_nameArrParentJSON = implode(",", $other_nameArr);
    $other_usdArrParentJSON = implode(",", $other_usdArr);
    $other_arcArrParentJSON = implode(",", $other_arcArr);
    $other_phpArrParentJSON = implode(",", $other_phpArr);

    
    // $nested_other_subtotal_usdArr = implode(",", $nested_other_subtotal_usdArr);

    
    // $nested_other_subtotal_phpArr = implode(",", $nested_other_subtotal_phpArr);
    
    $nested_other_nameArrFields = $_POST['nested_other_name'] ?? [];
    $nested_other_usdArrFields = $_POST['nested_other_usd'] ?? [];
    $nested_other_arcArrFields = $_POST['nested_other_arc'] ?? [];
    $nested_other_phpArrFields = $_POST['nested_other_php'] ?? [];
    $nested_other_subtotal_usdArrFields = $_POST['nested_other_subtotal_usd'];
    $nested_other_subtotal_phpArrFields = $_POST['nested_other_subtotal_php'];

    

    // For Other End
    
    
    if(empty($name_of_client) || empty($agent) || empty($particulars) || empty($group_name) || empty($co) || empty($date) || empty($po_no) || empty($or_no) || empty($sa_paymentMethod)){
       echo "EmptyError";
    }

    else{

        $querySA = "SELECT sa_Number FROM sa ORDER BY sa_Number DESC LIMIT 1";
        $resultSA = $conn->query($querySA);

            if($resultSA){

                $rowSA = $resultSA->fetch_assoc();
                $count = $rowSA['sa_Number'];

                $newEntryNumberSA = str_pad((int)$count + 1, 6, '00000', STR_PAD_LEFT);
                

                

                $stmt = $conn->prepare("INSERT INTO sa (sa_Number, name_of_client, agent, group_name, particulars, co, date, po_No, or_No, prepared_by, checked_by, approved_by, sa_paymentMethod, sa_acr, sa_passengerName, tourcost_usd, tourcost_arc, tourcost_php, taxes_usd, taxes_arc, taxes_php, tip_fund_usd, tip_fund_arc, tip_fund_php, travel_insurance_usd, travel_insurance_arc, travel_insurance_php, parent_data_visa_fee_passengerName, parent_data_visa_fee_usd, parent_data_visa_fee_arc, parent_data_visa_fee_php, parent_data_other_passengerName, parent_data_other_usd, parent_data_other_arc, parent_data_other_php, select_sub_total_usd, select_sub_total_php, sub_total_usd, sub_total_php, total_of_sub_total, sa_date_deposit, sa_amount_deposit, total_amount_deposit, total_amount, archive) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); // Mag peprapre ulit tayo ng statement para makapg Insert ng data sa database
                $stmt->bind_param("sssssssssssssssssssssssssssssssssssssssssssss", $newEntryNumberSA, $name_of_client, $agent, $group_name, $particulars, $co, $date, $po_no, $or_no, $sa_preparedBy, $sa_checkedBy, $sa_approvedBy, $sa_paymentMethod, $sa_acr, $sa_passengerNameArr, $tourcost_usdArr, $tourcost_arcArr, $tourcost_phpArr, $taxes_usdArr, $taxes_arcArr, $taxes_phpArr, $tip_fund_usdArr, $tip_fund_arcArr, $tip_fund_phpArr, $travel_insurance_usdArr, $travel_insurance_arcArr, $travel_insurance_phpArr, $visa_fee_nameArrParentJSON, $visa_fee_usdArrParentJSON, $visa_fee_arcArrParentJSON, $visa_fee_phpArrParentJSON, $other_nameArrParentJSON, $other_usdArrParentJSON, $other_arcArrParentJSON, $other_phpArrParentJSON, $select1_total_usdArr, $select1_total_phpArr, $sub_total_usd, $sub_total_php, $total_of_sub_total, $sa_date_depositArr, $sa_amount_depositArr, $total_amount_deposit, $total_amount, $archive); // Mag babind ulit tayo ng parameter para sa prepare statement
                
                if($stmt->execute()){ 
                    
                    $parentId = $conn->insert_id;

                    $parentId;

                            $nested_visa_fee_nameArrFieldJSON = json_encode($nested_visa_fee_nameArrFields);
                            $nested_visa_fee_usdArrFieldJSON = json_encode($nested_visa_fee_usdArrFields);
                            $nested_visa_fee_subtotal_usdArrFieldJSON = json_encode($nested_visa_fee_subtotal_usdArrFields);
                            $nested_visa_fee_arcArrFieldJSON = json_encode($nested_visa_fee_arcArrFields);
                            $nested_visa_fee_phpArrFieldJSON = json_encode($nested_visa_fee_phpArrFields);
                            $nested_visa_fee_subtotal_phpArrFieldJSON = json_encode($nested_visa_fee_subtotal_phpArrFields);
                            $sqlnested1 = "INSERT INTO sa_nested_table (sa_Id, nested_data_visa_fee_passengerName, nested_data_visa_fee_usd, nested_data_visa_fee_total_usd, nested_data_visa_fee_arc, nested_data_visa_fee_php, nested_data_visa_fee_total_php) VALUES ('$parentId', '$nested_visa_fee_nameArrFieldJSON', '$nested_visa_fee_usdArrFieldJSON', '$nested_visa_fee_subtotal_usdArrFieldJSON', '$nested_visa_fee_arcArrFieldJSON', '$nested_visa_fee_phpArrFieldJSON', '$nested_visa_fee_subtotal_phpArrFieldJSON')";
                            $result1 = $conn->query($sqlnested1);


                            $nested_other_nameArrFieldJSON = json_encode($nested_other_nameArrFields);
                            $nested_other_usdArrFieldJSON = json_encode($nested_other_usdArrFields);
                            $nested_other_subtotal_usdArrFieldJSON = json_encode($nested_other_subtotal_usdArrFields);
                            $nested_other_arcArrFieldJSON = json_encode($nested_other_arcArrFields);
                            $nested_other_phpArrFieldJSON = json_encode($nested_other_phpArrFields);
                            $nested_other_subtotal_phpArrFieldJSON = json_encode($nested_other_subtotal_phpArrFields);
                            $sqlnested2 = "INSERT INTO sa_nested_other_table (sa_Id, nested_data_other_passengerName, nested_data_other_usd, nested_data_other_total_usd, nested_data_other_arc, nested_data_other_php, nested_data_other_total_php) VALUES ('$parentId', '$nested_other_nameArrFieldJSON', '$nested_other_usdArrFieldJSON', '$nested_other_subtotal_usdArrFieldJSON', '$nested_other_arcArrFieldJSON', '$nested_other_phpArrFieldJSON', '$nested_other_subtotal_phpArrFieldJSON')";
                            $result2 = $conn->query($sqlnested2);
                        
                    
                    $event = "Added";
                    $form = "SA";
                    date_default_timezone_set("Asia/Manila");
                    $dateAdded = date('Y-m-d');
                    $timeAdded = date('H:i:s');

                    $sql = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$by', '$event', '$form', '$dateAdded', '$timeAdded')";
                    $result = $conn->query($sql);

                    if($result === TRUE){
                        echo "Success";
                    }

                    else{
                        echo "Error1";
                    }
            
            
            
                }

                else{ 
                    echo "Error1";
                }

            }

        
    }

       
}

// For CV Insert Database
if(isset($_POST['action']) && $_POST['action'] == "AddCV"){
    $by = $_POST['by'];

    $payee = $_POST['payee'];
    $date = $_POST['date'];
    $agent = $_POST['agent'];
    $particular = $_POST['particular'];
    $cv_passengerNameArr = implode(", ",$_POST['cv_passengerName']);
    

    if(!empty($_POST['cv_paymentMethod'])) {

        $cv_paymentMethod=$_POST['cv_paymentMethod'];
        
    
    }

    else{
        $cv_paymentMethod = "";

    }
    
    $acr = $_POST['acr'];
    $total_amount = $_POST['total_amount'];
    $sum_of_peso = $_POST['sum_of_pesos'];
    $check_no = $_POST['check_no'];
    $received_by = $_POST['received_by'];
    $date_received = $_POST['date_received'];
    $prepared_by = $_POST['prepared_by'];
    $checked_by = $_POST['checked_by'];
    $approved_by = $_POST['approved_by'];
    $archive = 'No';

        $queryCV = "SELECT cv_Number FROM cv ORDER BY cv_Number DESC LIMIT 1";
        $resultCV = $conn->query($queryCV);

            if($resultCV){
                $rowCV = $resultCV->fetch_assoc();
                $count = $rowCV['cv_Number'];

                $newEntryNumberCV = str_pad((int)$count + 1, 6, '00000', STR_PAD_LEFT);

                $stmt = $conn->prepare("INSERT INTO cv (cv_Number, payee, date, agent, particular, cv_passengerName, payment_method, acr, total_amount, sum_of_peso, check_no, received_by, date_received, prepared_by, checked_by, approved_by, by_signature, archive) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); // Mag peprapre ulit tayo ng statement para makapg Insert ng data sa database
                $stmt->bind_param("ssssssssssssssssss", $newEntryNumberCV, $payee, $date, $agent, $particular, $cv_passengerNameArr, $cv_paymentMethod, $acr, $total_amount, $sum_of_peso, $check_no, $received_by, $date_received, $prepared_by, $checked_by, $approved_by, $by, $archive); // Mag babind ulit tayo ng parameter para sa prepare statement
       
       
       
                if($stmt->execute()){ 
                    
                    $event = "Added";
                    $form = "CV";
                    date_default_timezone_set("Asia/Manila");
                    $dateAdded = date('Y-m-d');
                    $timeAdded = date('H:i:s');

                    $sql = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$by', '$event', '$form', '$dateAdded', '$timeAdded')";
                    $result = $conn->query($sql);

                    if($result === TRUE){
                        echo "Success";
                    }

                    else{
                        echo "Error";
                    }
                    
                    
                    
                }

                else{ 
                    echo "Error";
                }

            }
    

       
}

    



    // else{
    //     echo "Error";
    // }

?>
