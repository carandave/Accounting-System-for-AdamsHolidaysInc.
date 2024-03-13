<?php 

    require_once "connection.php";

    // $conn = new PDO('mysql:host=localhost; dbname=adam;', 'root', '');

    // Edit AR in Database
    if(isset($_POST['action']) && $_POST['action'] == "editAR"){
          $edit_arId = $_POST['edit_ar_Id'];
          $edit_receive_from = $_POST['edit_receive_from'];
          $edit_business_name = $_POST['edit_business_name'];
          $edit_address = $_POST['edit_address'];
          $edit_tin = $_POST['edit_tin'];
          $edit_sum_of_pesos = $_POST['edit_sum_of_pesos'];
          $edit_full_payment = $_POST['edit_full_payment'];
          $edit_date = $_POST['edit_date'];
          $edit_transaction = $_POST['edit_transaction'];
          $edit_acr = $_POST['edit_acrD'];
          $edit_usd = $_POST['edit_usdD'];
          $edit_php = $_POST['edit_php'];
          $edit_cash = $_POST['edit_cash'];

          $edit_checkBankArr = $_POST['edit_checkBank'];
          $edit_checkBankArr = implode(",", $edit_checkBankArr);

          $edit_checkNoArr = $_POST['edit_checkNo'];
          $edit_checkNoArr = implode(",", $edit_checkNoArr);

          $edit_checkNoAmountArr = $_POST['edit_checkAmount'];
          $edit_checkNoAmountArr = implode(",", $edit_checkNoAmountArr);


        
          $edit_total = $_POST['edit_total'];

          $edit_paxNameArr = $_POST['edit_paxName'];
          $edit_paxNameArr = implode(",", $edit_paxNameArr);

          $edit_paxServiceArr = $_POST['edit_paxService'];
          $edit_paxServiceArr = implode(",", $edit_paxServiceArr);

          $edit_paxAmountArr = $_POST['edit_paxAmount'];
          $edit_paxAmountArr = implode(",", $edit_paxAmountArr);

          $edit_pr_no = $_POST['edit_pr_no'];
          $edit_by = $_POST['edit_by'];
          $edit_status = "Unprinted";

        //   $sqlu = "UPDATE ar SET received_from='$edit_receive_from', business_name='$edit_business_name', address='$edit_address', tin='$edit_tin', sum='$edit_sum_of_pesos', full='$edit_full_payment', date='$edit_date', transaction='$edit_transaction', acr='$edit_acr', usd_amount='$edit_usd', php_val='$edit_php', cash_amount='$edit_cash', check_no1='$edit_checkNoArr', check_amount1='$edit_checkNoAmountArr', total_amount='$edit_total', PR_no='$edit_pr_no', by_signature='$edit_by', status='$edit_status' WHERE ar_Id='$edit_arId'";
        //   $resultu = $conn->query($sqlu);

          $sqlu = $conn->prepare("UPDATE ar SET received_from=?, business_name=?, address=?, tin=?, sum=?, full=?, date=?, transaction=?, acr=?, usd_amount=?, php_val=?, cash_amount=?, checkBank1=?, check_no1=?, check_amount1=?, total_amount=?, pax_name=?, pax_service=?, pax_amount=?, PR_no=?, by_signature=?, status=? WHERE ar_Id=?");
          $sqlu->bind_param("sssssssssssssssssssssss", $edit_receive_from, $edit_business_name, $edit_address, $edit_tin, $edit_sum_of_pesos, $edit_full_payment, $edit_date, $edit_transaction, $edit_acr, $edit_usd, $edit_php, $edit_cash, $edit_checkBankArr, $edit_checkNoArr, $edit_checkNoAmountArr, $edit_total, $edit_paxNameArr, $edit_paxServiceArr, $edit_paxAmountArr, $edit_pr_no, $edit_by, $edit_status, $edit_arId);
        //   $sqlu->execute();
         
         if($sqlu->execute()){

            $event = "Edited";
            $form = "AR";
            date_default_timezone_set("Asia/Manila");
            $dateEdited = date('Y-m-d');
            $timeEdited = date('H:i:s');

            $sqli = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$edit_by', '$event', '$form', '$dateEdited', '$timeEdited')";
            $resulti = $conn->query($sqli);
            echo "Success";
         }

         else{
            echo "Error";
        }

    }

    // Edit PO in Database
    else if(isset($_POST['action']) && $_POST['action'] == "EditPO"){
        $edit_by_signature = $_POST['edit_by'];
        $edit_poId = $_POST['edit_poId'];

        // Dito na tayo sa pag eedit ng PO
        $edit_supplier = $_POST['edit_supplier'];
        $edit_address = $_POST['edit_address'];
        $edit_agent = $_POST['edit_agent'];
        $edit_particular = $_POST['edit_particular'];
        $edit_rec_locator = $_POST['edit_rec_locator'];
        $edit_conjunction = $_POST['edit_conjunction'];
        $edit_date = $_POST['edit_date'];
        $edit_amount_deposit = $_POST['edit_amount_deposit'];
        $edit_or = $_POST['edit_or'];
        $edit_cv = $_POST['edit_cv'];
        $edit_sa = $_POST['edit_sa'];

        $edit_category = $_POST['edit_category'];
        

        // AIRFARE
        $edit_airfare_groupName = $_POST['edit_airfare_groupName'];

        $edit_po_preparedBy = $_POST['edit_po_preparedBy'];
        $edit_po_checkedBy = $_POST['edit_po_checkedBy'];
        $edit_po_approvedBy = $_POST['edit_po_approvedBy'];

        if(empty($edit_supplier) || empty($edit_address) | empty($edit_agent) || empty($edit_particular) || empty($edit_rec_locator) || empty($edit_conjunction) || empty($edit_date) || empty($edit_amount_deposit)){
          echo "EmptyError";
        }

        else{

          if($edit_category == "Airfare"){
              if(!empty($_POST['edit_airfare_paymentMethod'])) {
                $edit_airfare_paymentMethod = $_POST['edit_airfare_paymentMethod'];
              }

              else{
                $edit_airfare_paymentMethod = " ";
              }
              
              $edit_airfare_acr = $_POST['edit_airfare_acr'];
        
              $edit_airfare_passengerNameArr = $_POST['edit_airfare_passengerName'];
              $edit_airfare_passengerNameArr = implode(",", $edit_airfare_passengerNameArr);
              
              $edit_airfare_airfare_usdArr = $_POST['edit_airfare_usd'];
              $edit_airfare_airfare_usdArr = implode(",", $edit_airfare_airfare_usdArr);

              $edit_airfare_taxes_usdArr = $_POST['edit_taxes_usd'];
              $edit_airfare_taxes_usdArr = implode(",", $edit_airfare_taxes_usdArr);

              $edit_airfare_iata_usdArr = $_POST['edit_iata_usd'];
              $edit_airfare_iata_usdArr = implode(",", $edit_airfare_iata_usdArr);

              
              $edit_airfare_airfare_phpArr = $_POST['edit_airfare_php'];
              $edit_airfare_airfare_phpArr = implode(",", $edit_airfare_airfare_phpArr);

              $edit_airfare_taxes_phpArr = $_POST['edit_taxes_php'];
              $edit_airfare_taxes_phpArr = implode(",", $edit_airfare_taxes_phpArr);

              $edit_airfare_iata_phpArr = $_POST['edit_iata_php'];
              $edit_airfare_iata_phpArr = implode(",", $edit_airfare_iata_phpArr);


              $edit_airfare_sub_total_usdArr = $_POST['edit_airfare_sub_total_usd'];
              $edit_airfare_sub_total_usdArr = implode(",", $edit_airfare_sub_total_usdArr);

              $edit_airfare_sub_total_phpArr = $_POST['edit_airfare_sub_total_php'];
              $edit_airfare_sub_total_phpArr = implode(",", $edit_airfare_sub_total_phpArr);

              $edit_airfare_final_sub_total_usdArr = $_POST['edit_airfare_final_sub_total_usd'];

              $edit_airfare_final_sub_total_phpArr = $_POST['edit_airfare_final_sub_total_php'];

              $edit_airfare_totalAmount = $_POST['edit_airfare_totalAmount'];

              $edit_airfare_amountInWords = $_POST['edit_airfare_amountInWords'];

              // HOTEL / LAND ARRANGEMENT
    
              if(!empty($_POST['edit_hotel_paymentMethod'])) {
                $edit_hotel_paymentMethod = $_POST['edit_hotel_paymentMethod'];
              }

              else{
                  $edit_hotel_paymentMethod = " ";
              }

              $edit_hotel_acr = $_POST['edit_hotel_acr'];
      
              $edit_hotel_passengerNameArr = $_POST['edit_hotel_passengerName'];
              $edit_hotel_passengerNameArr = implode(",", $edit_hotel_passengerNameArr);
              
              $edit_hotel_hotel_usd = $_POST['edit_hotel_hotel_usd'];

              $edit_hotel_taxes_usd = $_POST['edit_hotel_taxes_usd'];

              $edit_hotel_hotel_php = $_POST['edit_hotel_hotel_php'];

              $edit_hotel_taxes_php = $_POST['edit_hotel_taxes_php'];

              $edit_hotel_sub_total_usd = $_POST['edit_hotel_sub_total_usd'];

              $edit_hotel_sub_total_php = $_POST['edit_hotel_sub_total_php'];
            
              $edit_hotel_totalAmount = $_POST['edit_hotel_totalAmount'];
              $edit_hotelland_amountInWords = $_POST['edit_hotelland_amountInWords'];
          }

          else if ($edit_category == "Hotel"){
    
            if(!empty($_POST['edit_hotel_paymentMethod'])) {
              if(!empty($_POST['edit_airfare_paymentMethod'])) {
                $edit_airfare_paymentMethod=$_POST['edit_airfare_paymentMethod'];
              }
  
              else{
                  $edit_airfare_paymentMethod = " ";
              }
  
                $edit_airfare_acr = $_POST['edit_airfare_acr'];
          
                $edit_airfare_passengerNameArr = $_POST['edit_airfare_passengerName'];
                $edit_airfare_passengerNameArr = implode(",", $edit_airfare_passengerNameArr);
                
                $edit_airfare_airfare_usdArr = $_POST['edit_airfare_usd'];
                $edit_airfare_airfare_usdArr = implode(",", $edit_airfare_airfare_usdArr);
  
                $edit_airfare_taxes_usdArr = $_POST['edit_taxes_usd'];
                $edit_airfare_taxes_usdArr = implode(",", $edit_airfare_taxes_usdArr);
  
                $edit_airfare_iata_usdArr = $_POST['edit_iata_usd'];
                $edit_airfare_iata_usdArr = implode(",", $edit_airfare_iata_usdArr);
  
                
                $edit_airfare_airfare_phpArr = $_POST['edit_airfare_php'];
                $edit_airfare_airfare_phpArr = implode(",", $edit_airfare_airfare_phpArr);
  
                $edit_airfare_taxes_phpArr = $_POST['edit_taxes_php'];
                $edit_airfare_taxes_phpArr = implode(",", $edit_airfare_taxes_phpArr);
  
                $edit_airfare_iata_phpArr = $_POST['edit_iata_php'];
                $edit_airfare_iata_phpArr = implode(",", $edit_airfare_iata_phpArr);
  
  
                $edit_airfare_sub_total_usdArr = $_POST['edit_airfare_sub_total_usd'];
                $edit_airfare_sub_total_usdArr = implode(",", $edit_airfare_sub_total_usdArr);
  
                $edit_airfare_sub_total_phpArr = $_POST['edit_airfare_sub_total_php'];
                $edit_airfare_sub_total_phpArr = implode(",", $edit_airfare_sub_total_phpArr);
  
                $edit_airfare_final_sub_total_usdArr = $_POST['edit_airfare_final_sub_total_usd'];
  
                $edit_airfare_final_sub_total_phpArr = $_POST['edit_airfare_final_sub_total_php'];
  
                $edit_airfare_totalAmount = $_POST['edit_airfare_totalAmount'];
  
                $edit_airfare_amountInWords = $_POST['edit_airfare_amountInWords'];
  
                // HOTEL / LAND ARRANGEMENT
      
                if(!empty($_POST['edit_hotel_paymentMethod'])) {
                  $edit_hotel_paymentMethod=$_POST['edit_hotel_paymentMethod'];
                }
  
                else{
                    $edit_hotel_paymentMethod = " ";
                }
  
                $edit_hotel_acr = $_POST['edit_hotel_acr'];
        
                $edit_hotel_passengerNameArr = $_POST['edit_hotel_passengerName'];
                $edit_hotel_passengerNameArr = implode(",", $edit_hotel_passengerNameArr);
                
                $edit_hotel_hotel_usd = $_POST['edit_hotel_hotel_usd'];
  
                $edit_hotel_taxes_usd = $_POST['edit_hotel_taxes_usd'];
  
                $edit_hotel_hotel_php = $_POST['edit_hotel_hotel_php'];
  
                $edit_hotel_taxes_php = $_POST['edit_hotel_taxes_php'];
  
                $edit_hotel_sub_total_usd = $_POST['edit_hotel_sub_total_usd'];
  
                $edit_hotel_sub_total_php = $_POST['edit_hotel_sub_total_php'];
              
                $edit_hotel_totalAmount = $_POST['edit_hotel_totalAmount'];
                $edit_hotelland_amountInWords = $_POST['edit_hotelland_amountInWords'];
            }
          }

        }

        

  
      $sqlu = $conn->prepare("UPDATE po SET supplier=?, address=?, agent=?, particular=?, rec_locator=?, conjunction=?, date=?, amount_deposit=?, or_No=?, cv=?, sa=?, po_category=?, airfare_groupName=?, airfare_paymentMethod=?, airfare_acr=?, airfare_passengerName=?, airfare_airfare_usd=?, airfare_taxes_usd=?, airfare_iata_usd=?, airfare_airfare_php=?, airfare_taxes_php=?, airfare_iata_php=?, airfare_sub_total_usd=?, airfare_sub_total_php=?, airfare_final_sub_total_usd=?, airfare_final_sub_total_php=?, airfare_totalAmount=?, airfare_amountInWords=?, hotel_paymentMethod=?, hotel_acr=?, hotel_passengerName=?, hotel_hotel_usd=?, hotel_hotel_php=?, hotel_taxes_usd=?, hotel_taxes_php=?, hotel_sub_total_usd=?, hotel_sub_total_php=?, hotel_totalAmount=?, hotelland_amountInWords=?, preparedBy=?, checkedBy=?, approvedBy=? WHERE po_Id=?");
      $sqlu->bind_param("sssssssssssssssssssssssssssssssssssssssssss", $edit_supplier, $edit_address, $edit_agent, $edit_particular, $edit_rec_locator, $edit_conjunction, $edit_date, $edit_amount_deposit, $edit_or, $edit_cv, $edit_sa, $edit_category, $edit_airfare_groupName, $edit_airfare_paymentMethod, $edit_airfare_acr, $edit_airfare_passengerNameArr, $edit_airfare_airfare_usdArr, $edit_airfare_taxes_usdArr, $edit_airfare_iata_usdArr, $edit_airfare_airfare_phpArr, $edit_airfare_taxes_phpArr, $edit_airfare_iata_phpArr, $edit_airfare_sub_total_usdArr, $edit_airfare_sub_total_phpArr, $edit_airfare_final_sub_total_usdArr, $edit_airfare_final_sub_total_phpArr, $edit_airfare_totalAmount, $edit_airfare_amountInWords, $edit_hotel_paymentMethod, $edit_hotel_acr, $edit_hotel_passengerNameArr, $edit_hotel_hotel_usd, $edit_hotel_hotel_php, $edit_hotel_taxes_usd, $edit_hotel_taxes_php, $edit_hotel_sub_total_usd, $edit_hotel_sub_total_php, $edit_hotel_totalAmount, $edit_hotelland_amountInWords, $edit_po_preparedBy, $edit_po_checkedBy, $edit_po_approvedBy, $edit_poId);
    
      if($sqlu->execute()){

          $event = "Edited";
          $form = "PO";
          date_default_timezone_set("Asia/Manila");
          $dateEdited = date('Y-m-d');
          $timeEdited = date('H:i:s');

          $sqli = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$edit_by_signature', '$event', '$form', '$dateEdited', '$timeEdited')";
          $resulti = $conn->query($sqli);
          echo "Success";
      }

      else{
          echo "Error";
      }

    }


    // Edit SA in Database
    else if(isset($_POST['action']) && $_POST['action'] == "editSA"){
       $edit_by = $_POST['edit_by'];
        $edit_sa_Id = $_POST['edit_sa_Id'];
        $edit_name_of_client = $_POST['edit_name_of_client'];
        $edit_agent = $_POST['edit_agent'];
        $edit_group_name = $_POST['edit_group_name'];
        $edit_particulars = $_POST['edit_particulars'];
        $edit_co = $_POST['edit_co'];
        $edit_date = $_POST['edit_date'];
        $edit_po_no = $_POST['edit_po_no'];
        $edit_or_no = $_POST['edit_or_no'];
        $edit_sa_preparedBy = $_POST['edit_sa_preparedBy'];
        $edit_sa_checkedBy = $_POST['edit_sa_checkedBy'];
        $edit_sa_approvedBy = $_POST['edit_sa_approvedBy'];
      
      
      
      if(!empty($_POST['edit_sa_paymentMethod'])) {

         $edit_sa_paymentMethod = $_POST['edit_sa_paymentMethod'];
    
      }

      else{
         $edit_sa_paymentMethod = " ";
      }

      
      $edit_sa_acr = $_POST['edit_sa_acr'];


      // Passenger Name
      $edit_sa_passengerNameArr = $_POST['edit_sa_passengerName'];
      $edit_sa_passengerNameArr = implode(",", $edit_sa_passengerNameArr);


      // TOUR COST USD
      $edit_tourcost_usdArr = $_POST['edit_tourcost_usd'];
      $edit_tourcost_usdArr = implode(",", $edit_tourcost_usdArr);

      // TOUR COST ARC
      $edit_tourcost_arcArr = $_POST['edit_tourcost_arc'];
      $edit_tourcost_arcArr = implode(",", $edit_tourcost_arcArr);

      // TOUR COST PHP
      $edit_tourcost_phpArr = $_POST['edit_tourcost_php'];
      $edit_tourcost_phpArr = implode(",", $edit_tourcost_phpArr);


      // TAXES USD
      $edit_taxes_usdArr = $_POST['edit_taxes_usd'];
      $edit_taxes_usdArr = implode(",", $edit_taxes_usdArr);

      // TAXES ARC
      $edit_taxes_arcArr = $_POST['edit_taxes_arc'];
      $edit_taxes_arcArr = implode(",", $edit_taxes_arcArr);

      // TAXES PHP
      $edit_taxes_phpArr = $_POST['edit_taxes_php'];
      $edit_taxes_phpArr = implode(",", $edit_taxes_phpArr);


      // TIP FUND USD
      $edit_tip_fund_usdArr = $_POST['edit_tip_fund_usd'];
      $edit_tip_fund_usdArr = implode(",", $edit_tip_fund_usdArr);

      // TIP FUND ARC
      $edit_tip_fund_arcArr = $_POST['edit_tip_fund_arc'];
      $edit_tip_fund_arcArr = implode(",", $edit_tip_fund_arcArr);

      // TIP FUND PHP
      $edit_tip_fund_phpArr = $_POST['edit_tip_fund_php'];
      $edit_tip_fund_phpArr = implode(",", $edit_tip_fund_phpArr);


      // TRAVEL INSURANCE USD
      $edit_travel_insurance_usdArr = $_POST['edit_travel_insurance_usd'];
      $edit_travel_insurance_usdArr = implode(",", $edit_travel_insurance_usdArr);

      // TRAVEL INSURANCE ARC
      $edit_travel_insurance_arcArr = $_POST['edit_travel_insurance_arc'];
      $edit_travel_insurance_arcArr = implode(",", $edit_travel_insurance_arcArr);

      // TRAVEL INSURANCE PHP
      $edit_travel_insurance_phpArr = $_POST['edit_travel_insurance_php'];
      $edit_travel_insurance_phpArr = implode(",", $edit_travel_insurance_phpArr);


      // VISA FEE NAME
      $edit_visa_fee_nameArr = $_POST['edit_visa_fee_name'];
      $edit_visa_fee_nameArr = implode(",", $edit_visa_fee_nameArr);

      // VISA FEE USD
      $edit_visa_fee_usdArr = $_POST['edit_visa_fee_usd'];
      $edit_visa_fee_usdArr = implode(",", $edit_visa_fee_usdArr);

      // VISA FEE ARC
      $edit_visa_fee_arcArr = $_POST['edit_visa_fee_arc'];
      $edit_visa_fee_arcArr = implode(",", $edit_visa_fee_arcArr);

      // VISA FEE PHP
      $edit_visa_fee_phpArr = $_POST['edit_visa_fee_php'];
      $edit_visa_fee_phpArr = implode(",", $edit_visa_fee_phpArr);

      

      // print_r($edit_visa_fee_nameArr);
      // echo '<div></div>';
      // print_r($edit_visa_fee_usdArr);
      // echo '<div></div>';
      // print_r($edit_visa_fee_arcArr);
      // echo '<div></div>';
      // print_r($edit_visa_fee_phpArr);
      // echo '<div></div>';

      // VISA FEE NESTED START 

      $edit_nested_visa_fee_nameArrFields = $_POST['edit_nested_visa_fee_name'] ?? [];
      $edit_nested_visa_fee_usdArrFields = $_POST['edit_nested_visa_fee_usd'] ?? [];
      $edit_nested_visa_fee_arcArrFields = $_POST['edit_nested_visa_fee_arc'] ?? [];
      $edit_nested_visa_fee_phpArrFields = $_POST['edit_nested_visa_fee_php'] ?? [];
      $edit_nested_visa_fee_subtotal_usdArrFields = $_POST['edit_nested_visa_fee_subtotal_usd'];
      $edit_nested_visa_fee_subtotal_phpArrFields = $_POST['edit_nested_visa_fee_subtotal_php'];

      

      // print_r($edit_nested_visa_fee_nameArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_visa_fee_usdArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_visa_fee_arcArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_visa_fee_phpArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_visa_fee_subtotal_usdArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_visa_fee_subtotal_phpArrFields);

      // VISA FEE NESTED END



      // OTHER NAME
      $edit_other_nameArr = $_POST['edit_other_name'];
      $edit_other_nameArr = implode(",", $edit_other_nameArr);

      // OTHER USD
      $edit_other_usdArr = $_POST['edit_other_usd'];
      $edit_other_usdArr = implode(",", $edit_other_usdArr);

      // OTHER ARC
      $edit_other_arcArr = $_POST['edit_other_arc'];
      $edit_other_arcArr = implode(",", $edit_other_arcArr);
      
      // OTHER PHP
      $edit_other_phpArr = $_POST['edit_other_php'];
      $edit_other_phpArr = implode(",", $edit_other_phpArr);

      // print_r($edit_other_nameArr);
      // echo '<div></div>';
      // print_r($edit_other_usdArr);
      // echo '<div></div>';
      // print_r($edit_other_arcArr);
      // echo '<div></div>';
      // print_r($edit_other_phpArr);
      // echo '<div></div>';

      // OTHER NESTED START

      $edit_nested_other_nameArrFields = $_POST['edit_nested_other_name'] ?? [];
      $edit_nested_other_usdArrFields = $_POST['edit_nested_other_usd'] ?? [];
      $edit_nested_other_arcArrFields = $_POST['edit_nested_other_arc'] ?? [];
      $edit_nested_other_phpArrFields = $_POST['edit_nested_other_php'] ?? [];
      $edit_nested_other_subtotal_usdArrFields = $_POST['edit_nested_other_subtotal_usd'];
      $edit_nested_other_subtotal_phpArrFields = $_POST['edit_nested_other_subtotal_php'];

      

      // print_r($edit_nested_visa_fee_nameArrFieldJSON);
      // print_r($edit_nested_visa_fee_usdArrFieldJSON);
      // print_r($edit_nested_visa_fee_subtotal_usdArrFieldJSON);
      // print_r($edit_nested_visa_fee_arcArrFieldJSON);
      // print_r($edit_nested_visa_fee_phpArrFieldJSON);
      // print_r($edit_nested_visa_fee_subtotal_phpArrFieldJSON);

      
      // print_r($edit_nested_other_nameArrFieldJSON);
      // print_r($edit_nested_other_usdArrFieldJSON);
      // print_r($edit_nested_other_subtotal_usdArrFieldJSON);
      // print_r($edit_nested_other_arcArrFieldJSON);
      // print_r($edit_nested_other_phpArrFieldJSON);
      // print_r($edit_nested_other_subtotal_phpArrFieldJSON);

      // print_r($edit_nested_other_nameArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_other_usdArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_other_arcArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_other_phpArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_other_subtotal_usdArrFields);
      // echo '<div></div>';
      // print_r($edit_nested_other_subtotal_phpArrFields);
      
      // OTHER NESTED END

      // SELECT SUB TOTAL USD
    $edit_select1_total_usdArr = $_POST['edit_select1_total_usd'];
    $edit_select1_total_usdArr = implode(",", $edit_select1_total_usdArr);


    // SELECT SUB TOTAL PHP
    $edit_select1_total_phpArr = $_POST['edit_select1_total_php'];
    $edit_select1_total_phpArr = implode(",", $edit_select1_total_phpArr);


    $edit_sub_total_usd = $_POST['edit_sub_total_usd'];
    $edit_sub_total_php = $_POST['edit_sub_total_php'];

    $edit_total_of_sub_total = $_POST['edit_total_of_sub_total'];


    // DATE DEPOSIT
    $edit_sa_date_depositArr = $_POST['edit_sa_date_deposit'];
    $edit_sa_date_depositArr = implode(",", $edit_sa_date_depositArr);

    // AMOUNT DEPOSIT
    $edit_sa_amount_depositArr = $_POST['edit_sa_amount_deposit'];
    $edit_sa_amount_depositArr = implode(",", $edit_sa_amount_depositArr);

    $edit_total_amount_deposit = $_POST['edit_total_amount_deposit'];

    $edit_total_amount = $_POST['edit_total_amount'];

    // iki-query na natin yung mga edit input ni user
    
    // pag nag aadd ng add fields hindi lumalabas ang sub total sa sa 
      

      

      

      

      

      


      

      

      

      

      

      

      // print_r($edit_tourcost_usdArr);
      // echo '<div></div>';
      // print_r($edit_taxes_usdArr);
      // echo '<div></div>';
      // print_r($edit_tip_fund_usdArr);
      // echo '<div></div>';
      // print_r($edit_travel_insurance_usdArr);
      // echo '<div></div>';
      // print_r($edit_visa_fee_usdArr);
      // echo '<div></div>';
      // print_r($edit_other_usdArr);

      // print_r($edit_tourcost_phpArr);
      // echo '<div></div>';
      // print_r($edit_taxes_phpArr);
      // echo '<div></div>';
      // print_r($edit_tip_fund_phpArr);
      // echo '<div></div>';
      // print_r($edit_travel_insurance_phpArr);
      // echo '<div></div>';
      // print_r($edit_visa_fee_phpArr);
      // echo '<div></div>';
      // print_r($edit_other_phpArr);

      
      
      // 34

      // echo $edit_sa_Id;
      // $sqlu = $conn->prepare("UPDATE sa SET name_of_client=?, agent=?, group_name=?, particulars=?, co=?, date=?, po_No=?, or_No=?, prepared_by=?, checked_by=?, approved_by=?, sa_paymentMethod=?, sa_passengerName=?, tourcost_usd=?, tourcost_arc=?, tourcost_php=?, taxes_usd=?, taxes_arc=?, taxes_php=?, tip_fund_usd=?, tip_fund_arc=?, tip_fund_php=?, travel_insurance_usd=?, travel_insurance_arc=?, travel_insurance_php=?, parent_data_visa_fee_passengerName=?, parent_data_visa_fee_usd=?, parent_data_visa_fee_arc=?, parent_data_visa_fee_php=?, parent_data_other_passengerName=?, parent_data_other_usd=?, parent_data_other_arc=?, parent_data_other_php=? WHERE sa_Id=?");
      // $sqlu->bind_param("ssssssssssssssssssssssssssssssssss", $edit_name_of_client, $edit_agent, $edit_group_name, $edit_particulars, $edit_co, $edit_date, $edit_po_no, $edit_or_no, $edit_sa_preparedBy, $edit_sa_checkedBy, $edit_sa_approvedBy, $edit_sa_paymentMethod, $edit_sa_passengerNameArr, $edit_tourcost_usdArr, $edit_taxes_arcArr, $edit_tourcost_phpArr, $edit_taxes_usdArr, $edit_taxes_arcArr, $edit_taxes_phpArr, $edit_tip_fund_usdArr, $edit_tip_fund_arcArr, $edit_tip_fund_phpArr, $edit_travel_insurance_usdArr, $edit_travel_insurance_arcArr, $edit_travel_insurance_phpArr, $edit_visa_fee_nameArr, $edit_visa_fee_usdArr, $edit_visa_fee_arcArr, $edit_visa_fee_phpArr, $edit_other_nameArr, $edit_other_usdArr, $edit_other_arcArr, $edit_other_phpArr, $edit_arId);

      // $sqlu = $conn->prepare("UPDATE sa SET name_of_client=?, agent=?, group_name=?, particulars=?, co=?, date=?, po_No=?, or_No=?, prepared_by=?, checked_by=?, approved_by=?, sa_paymentMethod=? WHERE sa_Id=?");
      // $sqlu->bind_param("sssssssssssss", $edit_name_of_client, $edit_agent, $edit_group_name, $edit_particulars, $edit_co, $edit_date, $edit_po_no, $edit_or_no, $edit_sa_preparedBy, $edit_sa_checkedBy, $edit_sa_approvedBy, $edit_sa_paymentMethod, $edit_arId);
      
      $sqlu = "UPDATE sa SET name_of_client='$edit_name_of_client', agent='$edit_agent', group_name='$edit_group_name', particulars='$edit_particulars', co='$edit_co', date='$edit_date', po_No='$edit_po_no', or_No='$edit_or_no', prepared_by='$edit_sa_preparedBy', checked_by='$edit_sa_checkedBy', approved_by='$edit_sa_approvedBy', sa_paymentMethod='$edit_sa_paymentMethod', sa_acr='$edit_sa_acr', sa_passengerName='$edit_sa_passengerNameArr', tourcost_usd='$edit_tourcost_usdArr', tourcost_arc='$edit_tourcost_arcArr', tourcost_php='$edit_tourcost_phpArr', taxes_usd='$edit_taxes_usdArr', taxes_arc='$edit_taxes_arcArr', taxes_php='$edit_taxes_phpArr', tip_fund_usd='$edit_tip_fund_usdArr', tip_fund_arc='$edit_tip_fund_arcArr', tip_fund_php='$edit_tip_fund_phpArr', travel_insurance_usd='$edit_travel_insurance_usdArr', travel_insurance_arc='$edit_travel_insurance_arcArr', travel_insurance_php='$edit_travel_insurance_phpArr', parent_data_visa_fee_passengerName='$edit_visa_fee_nameArr', parent_data_visa_fee_usd='$edit_visa_fee_usdArr', parent_data_visa_fee_arc='$edit_visa_fee_arcArr', parent_data_visa_fee_php='$edit_visa_fee_phpArr', parent_data_other_passengerName='$edit_other_nameArr', parent_data_other_usd='$edit_other_usdArr', parent_data_other_arc='$edit_other_arcArr', parent_data_other_php='$edit_other_phpArr', select_sub_total_usd='$edit_select1_total_usdArr', select_sub_total_php='$edit_select1_total_phpArr', sub_total_usd='$edit_sub_total_usd', sub_total_php='$edit_sub_total_php', total_of_sub_total='$edit_total_of_sub_total', sa_date_deposit='$edit_sa_date_depositArr', sa_amount_deposit='$edit_sa_amount_depositArr', total_amount_deposit='$edit_total_amount_deposit', total_amount='$edit_total_amount' WHERE sa_Id='$edit_sa_Id'";
      $resultu = $conn->query($sqlu);

    //   $sqlu = "UPDATE sa SET name_of_client='$edit_name_of_client', agent='$edit_agent', group_name='$edit_group_name', particulars='$edit_particulars', co='$edit_co', date='$edit_date', po_No='$edit_po_no', or_No='$edit_or_no', prepared_by='$edit_sa_preparedBy', checked_by='$edit_sa_checkedBy', approved_by='$edit_sa_approvedBy', sa_paymentMethod='$edit_sa_paymentMethod', sa_passengerName='$edit_sa_passengerNameArr' WHERE sa_Id='$edit_sa_Id'";
    //   $resultu = $conn->query($sqlu);

    if($resultu){

      $edit_nested_visa_fee_nameArrFieldJSON = json_encode($edit_nested_visa_fee_nameArrFields);
      $edit_nested_visa_fee_usdArrFieldJSON = json_encode($edit_nested_visa_fee_usdArrFields);
      $edit_nested_visa_fee_subtotal_usdArrFieldJSON = json_encode($edit_nested_visa_fee_subtotal_usdArrFields);
      $edit_nested_visa_fee_arcArrFieldJSON = json_encode($edit_nested_visa_fee_arcArrFields);
      $edit_nested_visa_fee_phpArrFieldJSON = json_encode($edit_nested_visa_fee_phpArrFields);
      $edit_nested_visa_fee_subtotal_phpArrFieldJSON = json_encode($edit_nested_visa_fee_subtotal_phpArrFields);

      $sqlv = "UPDATE sa_nested_table SET nested_data_visa_fee_passengerName='$edit_nested_visa_fee_nameArrFieldJSON', nested_data_visa_fee_usd='$edit_nested_visa_fee_usdArrFieldJSON', nested_data_visa_fee_total_usd='$edit_nested_visa_fee_subtotal_usdArrFieldJSON', nested_data_visa_fee_arc='$edit_nested_visa_fee_arcArrFieldJSON', nested_data_visa_fee_php='$edit_nested_visa_fee_phpArrFieldJSON', nested_data_visa_fee_total_php='$edit_nested_visa_fee_subtotal_phpArrFieldJSON' WHERE sa_Id='$edit_sa_Id'";
      $resultv = $conn->query($sqlv);

      $edit_nested_other_nameArrFieldJSON = json_encode($edit_nested_other_nameArrFields);
      $edit_nested_other_usdArrFieldJSON = json_encode($edit_nested_other_usdArrFields);
      $edit_nested_other_subtotal_usdArrFieldJSON = json_encode($edit_nested_other_subtotal_usdArrFields);
      $edit_nested_other_arcArrFieldJSON = json_encode($edit_nested_other_arcArrFields);
      $edit_nested_other_phpArrFieldJSON = json_encode($edit_nested_other_phpArrFields);
      $edit_nested_other_subtotal_phpArrFieldJSON = json_encode($edit_nested_other_subtotal_phpArrFields);

      $sqlo = "UPDATE sa_nested_other_table SET nested_data_other_passengerName='$edit_nested_other_nameArrFieldJSON', nested_data_other_usd='$edit_nested_other_usdArrFieldJSON', nested_data_other_total_usd='$edit_nested_other_subtotal_usdArrFieldJSON', nested_data_other_arc='$edit_nested_other_arcArrFieldJSON', nested_data_other_php='$edit_nested_other_phpArrFieldJSON', nested_data_other_total_php='$edit_nested_other_subtotal_phpArrFieldJSON' WHERE sa_Id='$edit_sa_Id'";
      $resulto = $conn->query($sqlo);
      
        // $event = "Edited";
        // $form = "SA";
        // date_default_timezone_set("Asia/Manila");
        // $dateEdited = date('Y-m-d');
        // $timeEdited = date('H:i:s');

        // $sqli = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$edit_by', '$event', '$form', '$dateEdited', '$timeEdited')";
        // $resulti = $conn->query($sqli);
        echo "Success";
    }

    else{
        echo "Error";
    }

  }

  // Edit AR in Database
    if(isset($_POST['action']) && $_POST['action'] == "editCV"){
        $edit_by = $_POST['by'];
        $edit_cvId = $_POST['edit_cvId'];
        $edit_payee = $_POST['edit_payee'];
        $edit_date = $_POST['edit_date'];
        $edit_agent = $_POST['edit_agent'];
        $edit_particular = $_POST['edit_particular'];
        $edit_cv_passengerNameArr = implode(", ",$_POST['edit_cv_passengerName']);
        

        if(!empty($_POST['edit_cv_paymentMethod'])) {

            $edit_cv_paymentMethod=$_POST['edit_cv_paymentMethod'];
            
        
        }

        else{
            $edit_cv_paymentMethod = "";

        }
        
        $edit_acr = $_POST['edit_acr'];
        $edit_total_amount = $_POST['edit_total_amount'];
        $edit_sum_of_peso = $_POST['edit_sum_of_pesos'];
        $edit_check_no = $_POST['edit_check_no'];
        $edit_received_by = $_POST['edit_received_by'];
        $edit_date_received = $_POST['edit_date_received'];
        $edit_prepared_by = $_POST['edit_prepared_by'];
        $edit_checked_by = $_POST['edit_checked_by'];
        $edit_approved_by = $_POST['edit_approved_by'];


          $sqlu = $conn->prepare("UPDATE cv SET payee=?, date=?, agent=?,particular=?, cv_passengerName=?, payment_method=?, acr=?, total_amount=?, sum_of_peso=?, check_no=?, received_by=?, date_received=?, prepared_by=?, checked_by=?, approved_by=?, by_signature=? WHERE cv_Id=?");
          $sqlu->bind_param("sssssssssssssssss", $edit_payee, $edit_date, $edit_agent, $edit_particular, $edit_cv_passengerNameArr, $edit_cv_paymentMethod, $edit_acr, $edit_total_amount, $edit_sum_of_peso, $edit_check_no, $edit_received_by, $edit_date_received, $edit_prepared_by, $edit_checked_by, $edit_approved_by, $edit_by, $edit_cvId);
        //   $sqlu->execute();
         
         if($sqlu->execute()){

            $event = "Edited";
            $form = "CV";
            date_default_timezone_set("Asia/Manila");
            $dateEdited = date('Y-m-d');
            $timeEdited = date('H:i:s');

            $sqli = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$edit_by', '$event', '$form', '$dateEdited', '$timeEdited')";
            $resulti = $conn->query($sqli);
            echo "Success";
         }

         else{
            echo "Error";
        }

    }

    // dito na tayo sa pag eedit ni superadmin ng acc ng mga officials

    if(isset($_POST['action']) && $_POST['action'] == "editOfficial"){
      $officialId = $_POST['official_Id'];
      
      $edit_name = $_POST['edit_name'];
      $edit_username = $_POST['edit_username'];
      $edit_user_type = $_POST['edit_user_type'];
      $realPassword = $_POST['real_password'];
      $newPassword = $_POST['new_password'];
      $confirmPassword = $_POST['confirm_password'];

        if($newPassword == NULL || $confirmPassword == NULL){

          $sql = "UPDATE officials SET username='$edit_username', name='$edit_name', user_type='$edit_user_type' WHERE officials_Id='$officialId'";
          $result = $conn->query($sql);
          echo "Success";
          
          
        }

        else if(!empty($newPassword) || !empty($confirmPassword)){
        
          if($newPassword == $confirmPassword){

              $newPassword = sha1($newPassword);
              $sql = "UPDATE officials SET username='$edit_username', password='$newPassword', name='$edit_name', user_type='$edit_user_type' WHERE officials_Id='$officialId'";
              $result = $conn->query($sql);
    
              echo "Success";
          }
    
          else{
              // echo "Magkaiba ang new password at confirm password";
              echo "Mismatch";
          }
          
        }
    
    }


    if(isset($_POST['action']) && $_POST['action'] == "editAcc"){
      $officialId = $_POST['official_Id'];
      $username = $_POST['username'];
      $name = $_POST['name'];
      $realPassword = $_POST['real_password'];
      $newPassword = $_POST['new_password'];
      $confirmPassword = $_POST['confirm_password'];

        if($newPassword == NULL || $confirmPassword == NULL){

          $sql = "UPDATE officials SET username='$username', name='$name' WHERE officials_Id='$officialId'";
          $result = $conn->query($sql);
          echo "Success";
          
          
        }

        else if(!empty($newPassword) || !empty($confirmPassword)){
        
          if($newPassword == $confirmPassword){

              $newPassword = sha1($newPassword);
              $sql = "UPDATE officials SET username='$username', name='$name', password='$newPassword' WHERE officials_Id='$officialId'";
              $result = $conn->query($sql);
    
              echo "Success";
          }
    
          else{
              // echo "Magkaiba ang new password at confirm password";
              echo "Fail";
          }
          
        }
    
    }

    if(isset($_POST['action']) && $_POST['action'] == "editSign"){
      $folderPath = "img/";

      // echo $_POST['signed'];
      $officialId = $_POST['official_Id'];
      $image_parts = explode(";base64,", $_POST['signed']);

      // print_r($image_parts);
          
      $image_type_aux = explode("image/", $image_parts[0]);

      // print_r($image_type_aux);
        
      $image_type = $image_type_aux[1];

      // print_r($image_type);
        
      $image_base64 = base64_decode($image_parts[1]);

      // print_r($image_base64);
        
      $file = $folderPath . uniqid() .'.'.$officialId.'.'.$image_type;
      
      // print_r($file);

      $sql = "UPDATE officials SET signature_data='$file' WHERE officials_Id='$officialId'";
      $result = $conn->query($sql);

      file_put_contents($file, $image_base64);
      echo "SuccessSign";
    }


    if(isset($_POST['action']) && $_POST['action'] == "editDigitalSign"){
      echo "NAG MEET";
    }

    


    // else{
    //     echo "Error";
    // }

?>
