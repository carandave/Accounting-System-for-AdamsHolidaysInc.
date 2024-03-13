<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    // if(isset($_POST['editPrint'])){
    //     $saId = $_POST['sa_Id'];
    // }

    if(isset($_POST['editBtnReq']) && $_SESSION['usertype'] == 'user' && isset($_POST['token'])){
        $reqId = $_POST['req_Id'];
        $saId = $_POST['form_Id'];
        $token = $_POST['token'];
        $status = $_POST['status'];
        // $token_expire = $_POST['token_expire'];
        

        $sqlu = "UPDATE request_list SET token='' WHERE req_Id='$reqId'";
        $resultu = $conn->query($sqlu);

    }

    elseif(isset($_POST['editAdminBtn']) && $_SESSION['usertype'] == 'superadmin'){
        $saId = $_POST['sa_Id'];
      
    }

    elseif(isset($_POST['editAdminBtn']) && $_SESSION['usertype'] == 'admin'){
        $saId = $_POST['sa_Id'];
      
    }

    else{
        header("Location: sa_list.php");
    }

    $userName = $_SESSION['name'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adam's Holidays, Inc</title>

    <!-- Css Link -->
    <!-- <link rel="stylesheet" href="style.css"> -->

    <!-- Bootstrap Links  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- JQUERY Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS LINK -->
    <link rel="stylesheet" href="ar.css">

</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;800;900;1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

.error{
    color: red;
    font-size: 12px;
}

body{
    font-family: 'Nunito', sans-serif;
    font-family: 'Roboto', sans-serif;
}

h2{
    font-weight: 900;
}

.icon{
    display: inline-block;
    padding: 15px ;
    outline: 6px solid #E1E1E1;
    border: 5px solid white;
    border-radius: 50%;
    font-size: 32px;
    color: white;
    text-align: center;
    margin: 0 auto;
}

.box{
    box-shadow: 8px 9px 9px -6px rgba(120,120,120,0.73);
    -webkit-box-shadow: 8px 9px 9px -6px rgba(120,120,120,0.73);
    -moz-box-shadow: 8px 9px 9px -6px rgba(120,120,120,0.73);
    transition: 0.2s ease-in;
}

.box:hover{
    transform: translateY(-10px);
}

.heading-box{
    font-size: 20px;
    display: inline-block;
    width: 100%;
    background: #5A6B5D;
    text-align: center;
    padding: 10px 6px;
    color: #E1E1E1;
    border-radius: 5px;

}

.button{
    padding: 8px 16px;
    background: #E1E1E1;
    color: #5A6B5D;
    text-decoration: none;
    border-radius: 20px;
    width: 50%;
    text-align: center;
    font-weight: 700;
    font-size: 14px;
    border: 0;
    transition: 0.3s ease-in;
    letter-spacing: 1px;
    box-shadow: 0px 0px 36px 0px rgba(120,120,120,0.59);
-webkit-box-shadow: 0px 0px 36px 0px rgba(120,120,120,0.59);
-moz-box-shadow: 0px 0px 36px 0px rgba(120,120,120,0.59);
}

.button:hover{
    color: #E1E1E1;
    text-decoration: none;
    background: #5A6B5D;
}
</style>



<body style="overflow-x: hidden;">

    <!-- <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1"> -->
    <div class="fluid-container py-5" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <?php require_once("navphp/saNav.php");?>
            </div>

            <?php 
            
                // $sql = "SELECT * FROM sa WHERE sa_Id='$saId'";
                $sql = "SELECT s.sa_Id, s.sa_Number, s.name_of_client, s.agent, s.group_name, s.particulars, s.co, s.date, s.po_No, s.or_No, s.prepared_by, s.checked_by, s.approved_by, s.sa_paymentMethod, s.sa_acr, s.sa_passengerName, s.tourcost_usd, s.tourcost_arc, s.tourcost_php, s.taxes_usd, s.taxes_arc, s.taxes_php, s.tip_fund_usd, s.tip_fund_arc, s.tip_fund_php, s.travel_insurance_usd, s.travel_insurance_arc,s.travel_insurance_php, s.parent_data_visa_fee_passengerName, s.parent_data_visa_fee_usd, s.parent_data_visa_fee_arc, s.parent_data_visa_fee_php, s.parent_data_other_passengerName, s.parent_data_other_usd, s.parent_data_other_arc, s.parent_data_other_php, s.select_sub_total_usd, s.select_sub_total_php, s.sub_total_usd, s.sub_total_php, s.total_of_sub_total, s.sa_date_deposit, s.sa_amount_deposit, s.total_amount_deposit, s.total_amount, s.archive, v.sa_Id, v.nested_data_visa_fee_passengerName, v.nested_data_visa_fee_usd, v.nested_data_visa_fee_total_usd,  v.nested_data_visa_fee_arc,  v.nested_data_visa_fee_php, v.nested_data_visa_fee_total_php, o.sa_Id, o.nested_data_other_passengerName, o.nested_data_other_usd, o.nested_data_other_total_usd,  o.nested_data_other_arc, o.nested_data_other_php, o.nested_data_other_total_php FROM sa s INNER JOIN sa_nested_table v ON s.sa_Id = v.sa_Id INNER JOIN sa_nested_other_table o ON s.sa_Id = o.sa_Id WHERE s.sa_Id='$saId'";
                $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>

            <div class="col-md-10">
                <div class="bg-success" style="width: 90%; padding: 15px 35px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light text-center">STATEMENT OF ACCOUNT EDIT FORM</h5>
                </div>
                <form action="" id="edit_sa_Form" style="width: 90%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                <input type="text" name="edit_sa_Id" id="" value="<?php echo $saId;?>" class="d-none form-control form-control-sm" required>
                <input type="text" name="edit_by" id="" value="<?php echo $userName;?>" class="d-none form-control form-control-sm" required>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Name of Client:</label>
                            <input type="text" name="edit_name_of_client" id="name_of_client" value="<?php echo $rows['name_of_client']?>" class="form-control form-control-sm " required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Agent:</label>
                            <input type="text" name="edit_agent" id="agent" value="<?php echo $rows['agent']?>" class="form-control form-control-sm" required>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Group Name:</label>
                            <textarea cols="10" rows="3" name="edit_group_name" id="group_name" value="<?php echo $rows['group_name']?>" class="form-control form-control-sm" required>
                                <?php echo $rows['group_name']?>
                            </textarea>
                            <!-- <input type="text" name="particular" id="particular" class="form-control form-control-sm" required> -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Particulars:</label>
                            <textarea cols="10" rows="4" name="edit_particulars" id="particulars" value="<?php echo $rows['particulars']?>" class="form-control form-control-sm" required>
                            <?php echo $rows['particulars']?>
                            </textarea>
                            <!-- <input type="text" name="particular" id="particular" class="form-control form-control-sm" required> -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>C/O:</label>
                            <input type="text" name="edit_co" id="co" value="<?php echo $rows['co']?>" class="form-control form-control-sm" required>
                        </div>

                        <?php
                        $timestamp = time();
                        $date = date( "Y-m-d", $timestamp );
                        ?>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Date:</label>
                            <input type="date" name="edit_date" id="date" value="<?php echo $rows['date']?>" class="form-control form-control-sm " required>
                        </div>

                        

                        
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PO No.:</label>
                            <input type="text" name="edit_po_no" id="po_no" value="<?php echo $rows['po_No']?>" class="form-control form-control-sm " required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>AR No.:</label>
                            <input type="text" name="edit_or_no" id="or_no" value="<?php echo $rows['or_No']?>" class="form-control form-control-sm" required>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Prepared By:</label>
                            <input type="text" name="edit_sa_preparedBy" id="ar_preparedBy" value="<?php echo $rows['prepared_by']?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Checked By:</label>
                            <input type="text" name="edit_sa_checkedBy" id="ar_checkedBy" value="<?php echo $rows['checked_by']?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Approved By:</label>
                            <input type="text" name="edit_sa_approvedBy" id="ar_approvedBy" value="<?php echo $rows['approved_by']?>" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-md-4 pl-4">
                            
                        </div>

                        <div class="col-md-4">

                        </div>

                        <div class="col-md-4 d-flex justify-content-end align-items-end">
                            <input type="button" class="addPassengerTab btn btn-dark mb-0 mt-3" onclick="" style="border: 0; cursor: pointer;" value="Add Fields" id="addPassengerTab">
                        </div>
                    </div>

                    <div class="row m-1 bg-primary">
                        <div class="col-md-12">
                            <div class="row p-3">
                                <div class="col-md-6 " style="border-right: 3px solid white">
                                    <div class="d-flex ">
                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1 ">*</span>USD:</label>
                                        <input type="radio" name="edit_sa_paymentMethod" onclick="selectedUsdPhpHotel()" value="USD" id="usdChosePaymentMethod" class="form-control " 
                                        
                                        <?php if($rows['sa_paymentMethod'] == "USD"){
                                            echo "checked";
                                        }?>
                                        
                                        >
                                    </div>
                                </div>

                                <div class="col-md-6" style="border-left: 3px solid white">
                                    <div class="d-flex ">
                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1">*</span>PHP:</label>
                                        <input type="radio" name="edit_sa_paymentMethod" onclick="selectedUsdPhpHotel()" value="PHP" id="phpChosePaymentMethod" class="form-control "  
                                        
                                        <?php if($rows['sa_paymentMethod'] == "PHP"){
                                            echo "checked";
                                        }?>

                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $sa_passengerNameArr = explode(",", $rows['sa_passengerName']);
                        $tourcost_usdArr = explode(",", $rows['tourcost_usd']);
                        $tourcost_arcArr = explode(",", $rows['tourcost_arc']);
                        $tourcost_phpArr = explode(",", $rows['tourcost_php']);

                        $taxes_usdArr = explode(",", $rows['taxes_usd']);
                        $taxes_arcArr = explode(",", $rows['taxes_arc']);
                        $taxes_phpArr = explode(",", $rows['taxes_php']);

                        $tip_fund_usdArr = explode(",", $rows['tip_fund_usd']);
                        $tip_fund_arcArr = explode(",", $rows['tip_fund_arc']);
                        $tip_fund_phpArr = explode(",", $rows['tip_fund_php']);

                        $travel_insurance_usdArr = explode(",", $rows['travel_insurance_usd']);
                        $travel_insurance_arcArr = explode(",", $rows['travel_insurance_arc']);
                        $travel_insurance_phpArr = explode(",", $rows['travel_insurance_php']);

                        $parent_data_visa_fee_passengerNameArr = explode(",", $rows['parent_data_visa_fee_passengerName']);
                        $parent_data_visa_fee_usdArr = explode(",", $rows['parent_data_visa_fee_usd']);
                        $parent_data_visa_fee_arcArr = explode(",", $rows['parent_data_visa_fee_arc']);
                        $parent_data_visa_fee_phpArr = explode(",", $rows['parent_data_visa_fee_php']);

                        $parent_data_other_passengerNameArr = explode(",", $rows['parent_data_other_passengerName']);
                        $parent_data_other_usdArr = explode(",", $rows['parent_data_other_usd']);
                        $parent_data_other_arcArr = explode(",", $rows['parent_data_other_arc']);
                        $parent_data_other_phpArr = explode(",", $rows['parent_data_other_php']);




                        $nested_data_visa_fee_passengerNameArr = json_decode($rows['nested_data_visa_fee_passengerName'], true);
                        $nested_data_visa_fee_usdArr = json_decode($rows['nested_data_visa_fee_usd'], true);
                        $nested_data_visa_fee_arcArr = json_decode($rows['nested_data_visa_fee_arc'], true);
                        $nested_data_visa_fee_phpArr = json_decode($rows['nested_data_visa_fee_php'], true);

                        $nested_data_visa_fee_total_usdArr = json_decode($rows['nested_data_visa_fee_total_usd']);
                        $nested_data_visa_fee_total_phpArr = json_decode($rows['nested_data_visa_fee_total_php']);
                        // print_r($nested_data_visa_fee_total_usdArr);
                        // print_r($nested_data_visa_fee_total_phpArr);

                        // print_r($nested_data_visa_fee_phpArr);
                        
                        
                        // echo '<div>';
                        // echo '</div>';
                        // echo '</br>';

                        $nested_data_other_passengerNameArr = json_decode($rows['nested_data_other_passengerName'], true);
                        $nested_data_other_usdArr = json_decode($rows['nested_data_other_usd'], true);
                        $nested_data_other_arcArr = json_decode($rows['nested_data_other_arc'], true);
                        $nested_data_other_phpArr = json_decode($rows['nested_data_other_php'], true);

                        $nested_data_other_total_usdArr = json_decode($rows['nested_data_other_total_usd']);
                        $nested_data_other_total_phpArr = json_decode($rows['nested_data_other_total_php']);

                        $select_sub_total_usdArr = explode(",", $rows['select_sub_total_usd']);
                        $select_sub_total_phpArr = explode(",", $rows['select_sub_total_php']);

                        $sa_date_depositArr = explode(",", $rows['sa_date_deposit']);
                        $sa_amount_depositArr = explode(",", $rows['sa_amount_deposit']);
                        

                        
                        // print_r($select_sub_total_usdArr);
                        // echo '<div>';
                        // echo '</div>';
                        // echo '</br>';
                        // print_r($select_sub_total_phpArr);
                        // print_r($taxes_usdArr);
                        // print_r($parent_data_visa_fee_passengerNameArr);

                        
                    ?>

                    <div class="row bg-warning p-3 m-1 " id="acr-div">
                        <div class="col-md-12 ">
                            <label for="" class="font-weight-bold text-dark"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="edit_sa_acr" id="sa_acr" class="form-control form-control-sm" required value="<?php echo $rows['sa_acr'];?>">
                        </div>
                    </div>


                    <?php 
                    
                        $defaultvalVisaFeeParent = 1;
                        $defaultvalOtherParent = 1;
                        $defaultdivSelect = 1;

                        // print_r($sa_passengerNameArr);
                        
                        foreach($sa_passengerNameArr as $sa_passengerNameArrIndex => $value){
                            // print_r($sa_passengerNameArrIndex);
                            // print_r($sa_passengerNameArr);
                            // print_r($parent_data_visa_fee_passengerNameArr[$sa_passengerNameArrIndex]);
                            // print_r($parent_data_other_passengerNameArr[$sa_passengerNameArrIndex]);
                        
                    ?>

                    
                        
                        
                    <div class="row mt-2 " >

                        <div class="col-md-12 ">
                            <div class="p-3 bg-success" style="border: 1px solid lightgray;">
                                <div class="">
                                        <!-- <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>Passenger Name 1:</label> -->
                                        <!-- <div class="d-flex align-items-center" style="justify-content: space-between">'
                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>Passenger Name:</label>
                                            <input type="button" class="btn btn-danger btn-sm" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="" value="Remove" id="removePassengerBtn">
                                        </div> -->
                                       <div class="d-flex align-items-center" style="justify-content: space-between">
                                        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>Passenger Name:</label>
                                        <input type="button" class="btn btn-danger" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removePassengerBtn">
                                        </div>
                                    <input type="text" name="edit_sa_passengerName[]" id="sa_passengerName" value="<?php echo $sa_passengerNameArr[$sa_passengerNameArrIndex];?>" class="form-control form-control-sm" >
                                </div>

                                

                                <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <select name="" id="payment_option_fare" class="select-Fee-<?php echo $defaultdivSelect;?> form-control">
                                                <option value="" class="font-weight-bold p-4" style="font-size: 16px;">SELECT OPTION</option>
                                                <option value="TOUR COST" class="font-weight-bold p-4">TOUR COST</option>
                                                <option value="TAXES" class="font-weight-bold p-4">TAXES</option>
                                                <option value="TIP FUND" class="font-weight-bold p-4">TIP FUND</option>
                                                <option value="TRAVEL INSURANCE" class="font-weight-bold p-4">TRAVEL INSURANCE</option>
                                                <option value="VISA FEE" class="font-weight-bold p-4">VISA FEE</option>
                                                <option value="OTHER" class="font-weight-bold p-4">OTHER</option>
                                            </select>
                                            <!-- <h5 class="text-center "><span class="text-danger mr-1">*</span>TOUR COST: </h5> -->
                                        </div>

                                        <div class="col-md-9">
                                            <!-- TOUR COST ROW -->
                                           
                                            <div class="select-tourCost-<?php echo $defaultdivSelect;?> row" >
                                            <!-- <div class="row" > -->
                                                <div class="col-md-12">
                                                    
                                                <h6 class="text-light">TOUR COST</h6>

                                                    <div class="row">
                                                        <div class="col-md-4" id="container-amount">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>
                                                            <input type="number" name="edit_tourcost_usd[]" oninput="select1();" id="tourcost1_usd" value="<?php echo $tourcost_usdArr[$sa_passengerNameArrIndex];?>" class="tourcost1_usd form-control form-control-sm" required>
                                                            <input type="number" name="tourcost_usdD[]" oninput="select1();" id="tourcost1_usdD" class="tourcost_usdD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4" style="visibility: hidden">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="edit_tourcost_arc[]" oninput="" id="tourcost1_arc" value="<?php echo $tourcost_arcArr[$sa_passengerNameArrIndex];?>" class="tourcost1_arc form-control form-control-sm" required>
                                                            <input type="number" name="tourcost_arcD[]" oninput="" id="tourcost1_arcD" class="tourcost1_arcD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>
                                                            <input type="number" name="edit_tourcost_php[]" oninput="selectphp1();" id="tourcost1_php" value="<?php echo $tourcost_phpArr[$sa_passengerNameArrIndex];?>" class="tourcost1_php form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <!-- TAXES ROW -->
                                            <div class="select-taxes-<?php echo $defaultdivSelect;?> row mt-2" >
                                            <!-- <div class="row mt-2" > -->
                                                <div class="col-md-12">
                                                    
                                                <h6 class="text-light">TAXES</h6>

                                                    <div class="row">
                                                        <div class="col-md-4" id="container-amount">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>
                                                            <input type="number" name="edit_taxes_usd[]" oninput="select1();" id="taxes1_usd" value="<?php echo $taxes_usdArr[$sa_passengerNameArrIndex];?>" class="taxes1_usd form-control form-control-sm" value="0" required>
                                                            <input type="number" name="taxes_usdD[]" oninput="select1();" id="taxes1_usdD" class="taxes1_usdD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4" style="visibility: hidden">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="edit_taxes_arc[]" oninput="" id="taxes1_arc" value="<?php echo $taxes_arcArr[$sa_passengerNameArrIndex];?>" class="taxes1_arc form-control form-control-sm" value="0" required>
                                                            <input type="number" name="taxes_arcD[]" oninput="" id="taxes1_arcD" class="taxes1_arcD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>
                                                            <input type="number" name="edit_taxes_php[]" oninput="selectphp1();" id="taxes1_php" value="<?php echo $taxes_phpArr[$sa_passengerNameArrIndex];?>" class="taxes1_php form-control form-control-sm" value="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- TIP FUND ROW -->
                                            <div class="select-tipFund-<?php echo $defaultdivSelect;?> row mt-2" >
                                            <!-- <div class="row mt-2" > -->
                                                <div class="col-md-12">
                                                
                                                <h6 class="text-light">TIP FUND</h6>

                                                    <div class="row">
                                                        <div class="col-md-4" id="container-amount">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>
                                                            <input type="number" name="edit_tip_fund_usd[]" oninput="select1();" id="tip_fund1_usd" value="<?php echo $tip_fund_usdArr[$sa_passengerNameArrIndex];?>" class="tip_fund1_usd form-control form-control-sm" value="0" required>
                                                            <input type="number" name="tip_fund_usdD[]" oninput="select1();" id="tip_fund1_usdD" class="tip_fund1_usdD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4" style="visibility: hidden">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="edit_tip_fund_arc[]" oninput="" id="tip_fund1_arc" value="<?php echo $tip_fund_arcArr[$sa_passengerNameArrIndex];?>" class="tip_fund1_arc form-control form-control-sm" value="0" required>
                                                            <input type="number" name="tip_fund_arcD[]" oninput="" id="tip_fund1_arcD" class="tip_fund1_arcD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>
                                                            <input type="number" name="edit_tip_fund_php[]" oninput="selectphp1();" value="<?php echo $tip_fund_phpArr[$sa_passengerNameArrIndex];?>" id="tip_fund1_php" class="tip_fund1_php form-control form-control-sm" value="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <!-- TRAVEL INSURANCE ROW -->
                                            <div class="select-travelInsurance-<?php echo $defaultdivSelect;?> row mt-2" >
                                            <!-- <div class="row mt-2" > -->
                                                <div class="col-md-12">
                                                    
                                                <h6 class="text-light">TRAVEL INSURANCE</h6>

                                                    <div class="row">
                                                        <div class="col-md-4" id="container-amount">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>
                                                            <input type="number" name="edit_travel_insurance_usd[]" oninput="select1();" id="travel_insurance1_usd" value="<?php echo $travel_insurance_usdArr[$sa_passengerNameArrIndex];?>" class="travel_insurance1_usd form-control form-control-sm" value="0" required>
                                                            <input type="number" name="travel_insurance_usdD[]" oninput="select1();" id="travel_insurance1_usdD" class="travel_insurance1_usdD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4" style="visibility: hidden">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="edit_travel_insurance_arc[]" oninput="" id="travel_insurance1_arc" value="<?php echo $travel_insurance_arcArr[$sa_passengerNameArrIndex];?>" class="travel_insurance1_arc form-control form-control-sm" value="0" required>
                                                            <input type="number" name="travel_insurance_arcD[]" oninput="" id="travel_insurance1_arcD" class="travel_insurance1_arcD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>
                                                            <input type="number" name="edit_travel_insurance_php[]" oninput="selectphp1();" id="travel_insurance1_php" value="<?php echo $travel_insurance_phpArr[$sa_passengerNameArrIndex];?>" class="travel_insurance1_php form-control form-control-sm" value="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <!-- VISA FEE ROW -->
                                            <div class="select-visaFee-<?php echo $defaultdivSelect;?> row mt-2" >
                                            <!-- <div class="row mt-2" > -->
                                                <div class="col-md-12" >
                                                

                                                <!-- <h6>VISA FEE</h6> -->
                                                <!-- Dito na tayo sa pag piprint ng data parent sa visa fee -->
                                                
                                                    <div class="row pr-3" >
                                                        <div class="col-md-9">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>
                                                            <input type="text" name="edit_visa_fee_name[]" oninput="" id="visa_fee1_name" value="<?php echo $parent_data_visa_fee_passengerNameArr[$sa_passengerNameArrIndex];?>" class="visa_fee1_name visa-fee-parent<?php echo $defaultvalVisaFeeParent;?> form-control form-control-sm pr-3" required>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger">*</span>VISA FEE:</label>
                                                            <input type="button" class="addVisaFeeTab<?php echo $defaultdivSelect;?> btn btn-dark btn-block" style="border: 0; cursor: pointer;" onclick="addVisaFee<?php echo $defaultdivSelect;?>()" value="ADD VISA FEE" id="addVisaFeeTab<?php echo $defaultdivSelect;?>">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-4" id="container-amount">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>
                                                            <input type="number" name="edit_visa_fee_usd[]" oninput="select1();" id="visa_fee1_usd" value="<?php echo $parent_data_visa_fee_usdArr[$sa_passengerNameArrIndex]?>" class="visa_fee1_usd Parent<?php echo $defaultvalVisaFeeParent;?>_visa_fee_usd  form-control form-control-sm" required>
                                                            <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4" style="visibility: hidden">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="edit_visa_fee_arc[]" oninput="" id="visa_fee1_arc" value="<?php echo $parent_data_visa_fee_arcArr[$sa_passengerNameArrIndex]?>" class="visa_fee1_arc form-control form-control-sm" value="0" required>
                                                            <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>
                                                            <input type="number" name="edit_visa_fee_php[]" oninput="selectphp1();" id="" value="<?php echo $parent_data_visa_fee_phpArr[$sa_passengerNameArrIndex]?>" class="visa_fee1_php Parent<?php echo $defaultvalVisaFeeParent;?>_visa_fee_php form-control form-control-sm" value="0" required>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="row mt-3 d-none">
                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED 1 SUBTOTAL USD:</label>
                                                            <input type="number" name="edit_nested_visa_fee_subtotal_usd[]" oninput="" id="" class="nested<?php echo $defaultvalVisaFeeParent;?>_subtotal_usd nested_visa_sub_usd form-control form-control-sm" value="<?php echo $nested_data_visa_fee_total_usdArr[$sa_passengerNameArrIndex]?>" required>
                                                            <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="" oninput="" id="" class=" form-control form-control-sm" value="0" required>
                                                            <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED 1 SUBTOTAL PHP:</label>
                                                            <input type="number" name="edit_nested_visa_fee_subtotal_php[]" oninput="" id="" class="nested<?php echo $defaultvalVisaFeeParent;?>_subtotal_php nested_visa_sub_php form-control form-control-sm" value="<?php echo $nested_data_visa_fee_total_phpArr[$sa_passengerNameArrIndex]?>" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="netxVisaFeeTab<?php echo $defaultvalVisaFeeParent;?>">

                                                    </div>

                                                    <?php 
                                                    $sa_passengerNameArrIndex++;

                                                    
                                                    
                                                    foreach ($nested_data_visa_fee_passengerNameArr as $nested_data_visa_fee_passengerNameArrkeyindex => $nested_data_visa_fee_passengerNameArrvalues) {
                                                        if($sa_passengerNameArrIndex == $nested_data_visa_fee_passengerNameArrkeyindex){
                                                        
                                                        
                                                            foreach ($nested_data_visa_fee_passengerNameArr as $index => $passenger) {
                                                                
                                                                if($sa_passengerNameArrIndex == $index){
                                                                    foreach ($passenger as $childIndex => $childName) {
                                                                        
                                                                        $printvisafefee = "";
                                                                        $printvisafefee .= '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);
                                                                        -webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);
                                                                        -moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">';
                                                                        $printvisafefee .= '<div class="row mt-3">';
                                                                        $printvisafefee .= '<div class="col-md-9">';
                                                                        $printvisafefee .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>';
                                                                        $printvisafefee .= '<input type="text" name="edit_nested_visa_fee_name['.$index.'][]" oninput="" id="nested_'.$index.'_visa_fee_name" class="nested_'.$index.'_visa_fee_name  nested_visa_fee_name_readonly form-control form-control-sm" value="'.$childName.'" >';
                                                                        $printvisafefee .= '</div>';
                                                                        $printvisafefee .= '    <div class="col-md-3">';
                                                                        $printvisafefee .= '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>';
                                                                        $printvisafefee .= '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn'.$index.'">';
                                                                        $printvisafefee .= '    </div>';
                                                                        $printvisafefee .= '</div>';

                                                                        $printvisafefee .= '<div class="row mt-3">';
                                                                        $printvisafefee .= '<div class="col-md-4" id="container-nested-remove'.$index.'">';
                                                                        $printvisafefee .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>';
                                                                        $printvisafefee .= '<input type="text" name="edit_nested_visa_fee_usd['.$index.'][]" oninput="nested'.$index.'VisaFeeCal()" id="nested_'.$index.'_visa_fee_usd " class="nested_'.$index.'_visa_fee_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="'.$nested_data_visa_fee_usdArr[$index][$childIndex].'" >';
                                                                        $printvisafefee .= '</div>';

                                                                        $printvisafefee .= '<div class="col-md-4" style="visibility: hidden">';
                                                                        $printvisafefee .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ARC:</label>';
                                                                        $printvisafefee .= '<input type="text" name="edit_nested_visa_fee_arc['.$index.'][]" oninput="" id="nested_'.$index.'_visa_fee_arc" class="nested_'.$index.'_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="'.$nested_data_visa_fee_arcArr[$index][$childIndex].'" >';
                                                                        $printvisafefee .= '</div>';

                                                                        $printvisafefee .= '<div class="col-md-4">';
                                                                        $printvisafefee .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>';
                                                                        $printvisafefee .= '<input type="text" name="edit_nested_visa_fee_php['.$index.'][]" oninput="nested'.$index.'VisaFeePhpCal()" id="nested_'.$index.'_visa_fee_php" class="nested_'.$index.'_visa_fee_php nested_visa_fee_php_readonly form-control form-control-sm" value="'.$nested_data_visa_fee_phpArr[$index][$childIndex].'" >';
                                                                        $printvisafefee .= '</div>';

                                                                        $printvisafefee .= '</div>';
                                                                        $printvisafefee .= '</div>';
                                                                        echo $printvisafefee;
                                                                        
                                                                    }
                                                                }
                                                                echo "\n";
                                                            }
                                                        
                                                        }
                                                    }
                                                    
                                                    
                                                    
                                                    ?>
                                                </div>
                                            </div>

                                            <!-- OTHER ROW -->
                                            <div class="select-other-<?php echo $defaultdivSelect;?> row mt-2" >
                                            <!-- <div class="row mt-2" > -->
                                                <div class="col-md-12">
                                         
                                                    <div class="row pr-3">
                                                        <div class="col-md-9">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER:</label>
                                                            <input type="text" name="edit_other_name[]" oninput="" id="other1_name" value="<?php echo $parent_data_other_passengerNameArr[$sa_passengerNameArrIndex - 1] ?>"  class="other1_name other-parent<?php echo $defaultvalOtherParent;?> form-control form-control-sm" value="N/A" >
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="" class="font-weight-bold" style="visibility: hidden"><span class="text-danger">*</span>OTHER:</label>
                                                            <input type="button" class="addOtherTab<?php echo $defaultdivSelect;?> btn btn-dark btn-block" onclick="addOther<?php echo $defaultdivSelect;?>()" style="border: 0; cursor: pointer;" value="ADD OTHER" id="addOtherTab<?php echo $defaultdivSelect;?>">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-4" id="container-amount">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>
                                                            <input type="number" name="edit_other_usd[]" oninput="select1();" id="other1_usd" value="<?php echo $parent_data_other_usdArr[$sa_passengerNameArrIndex - 1]?>" class="other1_usd Parent<?php echo $defaultvalOtherParent;?>_other_usd form-control form-control-sm" >
                                                            <input type="number" name="other_usdD[]" oninput="select1();" id="other1_usdD" class="other1_usdD d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4 " style="visibility: hidden">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="edit_other_arc[]" oninput="" id="" value="<?php echo $parent_data_other_arcArr[$sa_passengerNameArrIndex]?>" class="other1_arc form-control form-control-sm " value="0" required>
                                                            <input type="number" name="other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>
                                                            <input type="number" name="edit_other_php[]" oninput="selectphp1();" id="" value="<?php echo $parent_data_other_phpArr[$sa_passengerNameArrIndex - 1]?>" class="other1_php Parent<?php echo $defaultvalOtherParent;?>_other_php form-control form-control-sm" value="<?php echo $nested_data_other_total_phpArr[$sa_passengerNameArrIndex - 1]?>" >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3 d-none">
                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED 1 OTHER SUBTOTAL USD:</label>
                                                            <input type="number" name="edit_nested_other_subtotal_usd[]" oninput="" id="" class="nested<?php echo $defaultvalOtherParent;?>_other_subtotal_usd nested_other_sub_usd form-control form-control-sm" value="<?php echo $nested_data_other_total_usdArr[$sa_passengerNameArrIndex - 1]?>" required>
                                                            <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4" >
                                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                            <input type="number" name="" oninput="" id="" class=" form-control form-control-sm" value="0" required>
                                                            <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED 1 SUBTOTAL PHP:</label>
                                                            <input type="number" name="edit_nested_other_subtotal_php[]" oninput="" id="" class="nested<?php echo $defaultvalOtherParent;?>_other_subtotal_php nested_other_php form-control form-control-sm" value="<?php echo $nested_data_other_total_phpArr[$sa_passengerNameArrIndex - 1]?>" required>
                                                        </div>
                                                    </div>

                                                    <div id="netxOtherTab<?php echo $defaultvalOtherParent;?>">

                                                    </div>

                                                    <?php 
                                                    $sa_passengerNameArrIndex + 1;

                                                    
                                                    
                                                    foreach ($nested_data_other_passengerNameArr as $nested_data_other_passengerNameArrkeyindex => $nested_data_other_passengerNameArrvalues) {
                                                        if($sa_passengerNameArrIndex == $nested_data_other_passengerNameArrkeyindex){
                                                        
                                                        
                                                            foreach ($nested_data_other_passengerNameArr as $index => $passenger) {
                                                                
                                                                if($sa_passengerNameArrIndex == $index){
                                                                    foreach ($passenger as $childIndex => $childName) {
                                                                        $printother = "";
                                                                        $printother .= '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);
                                                                        -webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);
                                                                        -moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">';
                                                                        $printother .= '<div class="row mt-3">';
                                                                        $printother .= '<div class="col-md-9">';
                                                                        $printother .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER:</label>';
                                                                        $printother .= '<input type="text" name="edit_nested_other_name['.$index.'][]" oninput="" id="nested_'.$index.'_other_name" class="nested_'.$index.'_other_name nested_visa_fee_name_readonly form-control form-control-sm" value="'.$childName.'" >';
                                                                        $printother .= '</div>';
                                                                        $printother .= '    <div class="col-md-3">';
                                                                        $printother .= '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>';
                                                                        $printother .= '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn'.$index.'">';
                                                                        $printother .= '    </div>';
                                                                        $printother .= '</div>';

                                                                        $printother .= '<div class="row mt-3">';
                                                                        $printother .= '<div class="col-md-4" id="remove-container-nestedOther'.$index.'">';
                                                                        $printother .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>';
                                                                        $printother .= '<input type="text" name="edit_nested_other_usd['.$index.'][]" oninput="nested'.$index.'OtherUsdCal();" id="nested_'.$index.'_other_usd" class="nested_'.$index.'_other_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="'.$nested_data_other_usdArr[$index][$childIndex].'" >';
                                                                        $printother .= '</div>';

                                                                        $printother .= '<div class="col-md-4" style="visibility: hidden">';
                                                                        $printother .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ARC:</label>';
                                                                        $printother .= '<input type="text" name="edit_nested_other_arc['.$index.'][]" oninput="" id="nested_'.$index.'_other_arc" class="nested_'.$index.'_other_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="'.$nested_data_other_arcArr[$index][$childIndex].'" >';
                                                                        $printother .= '</div>';

                                                                        $printother .= '<div class="col-md-4">';
                                                                        $printother .= '<label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>';
                                                                        $printother .= '<input type="text" name="edit_nested_other_php['.$index.'][]" oninput="nested'.$index.'OtherPhpCal();" id="nested_'.$index.'_other_php" class="nested_'.$index.'_other_php nested_visa_fee_php_readonly form-control form-control-sm" value="'.$nested_data_other_phpArr[$index][$childIndex].'" >';
                                                                        $printother .= '</div>';

                                                                        $printother .= '</div>';
                                                                        $printother .= '</div>';
                                                                        echo $printother;
                                                                        
                                                                    }
                                                                }
                                                                echo "\n";
                                                            }
                                                        
                                                        }
                                                    }
                                                    
                                                    
                                                    
                                                    ?>

                                                    

                                                </div>
                                            </div>

                                   
                                        </div>
                                    </div>

                                    

                                    <div class="divTotal-1">
                                        <div class="row mt-3">
                                            <div class="col-md-3">

                                            </div>

                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>TOTAL USD:</label>
                                                        <input type="number" name="edit_select1_total_usd[]" oninput="" id="select1_total_usd" class="select1_total_usd form-control form-control-sm" value="<?php echo $select_sub_total_usdArr[$sa_passengerNameArrIndex - 1];?>" required>
                                                    </div>

                                                    <div class="col-md-4">
                                                        
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>TOTAL PHP:</label>
                                                        <input type="number" name="edit_select1_total_php[]" oninput="" id="select1_total_php" class="select1_total_php form-control form-control-sm" value="<?php echo $select_sub_total_phpArr[$sa_passengerNameArrIndex - 1];?>" required>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                <!-- Kapag nag lagay ako ng gantong div is nag iiba yung format -->

                            </div>
                        </div>

                    </div>
                                
                    
                    <?php 
                            $defaultvalVisaFeeParent++;
                            $defaultvalOtherParent++;
                            $defaultdivSelect++;

                            
                        } 

                        
                    ?>

                    <input type="text" class="count_divSelect d-none" value="<?php echo $defaultdivSelect;?>">

                    

                    <div id="divNextPassengerTab">
                        
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <h6><span class="text-danger mr-1">*</span>SUB TOTAL : </h6>
                        </div>

                        <div class="col-md-4" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>SUB TOTAL USD:</label>
                            <input type="number" name="edit_sub_total_usd" oninput="" id="sub_total_usd" class="sub_total_usd form-control form-control-sm" value="<?php echo $rows['sub_total_usd'];?>" readonly="true">
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>SUB TOTAL PHP:</label>
                            <input type="number" name="edit_sub_total_php" oninput="" id="sub_total_php" class="sub_total_php form-control form-control-sm" value="<?php echo $rows['sub_total_php'];?>" readonly="true">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <h6><span class="text-danger mr-1">*</span>TOTAL OF SUB TOTAL : </h6>
                        </div>

                        <div class="col-md-8" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TOTAL OF SUB TOTAL:</label>
                            <input type="number" name="edit_total_of_sub_total" oninput="" id="total_of_sub_total" class="total_of_sub_total form-control form-control-sm" value="<?php echo $rows['total_of_sub_total'];?>" readonly="true">
                        </div>
                    </div>

                    

                    



                    <div class="p-3 pb-0 mt-4" style="border: 1px solid lightgray;">
                        <div class="row">
                            <div class="col-md-12">

                                <h5 for="" class="font-weight-bold">DEPOSIT:</h5>
                                <div class="row ">
                                    <div class="col-md-4">
                                        
                                    </div>

                                    <div class="col-md-4">

                                    </div>

                                    <div class="col-md-4 d-flex justify-content-end align-items-end">
                                        <input type="button" class="addDepositTab btn btn-dark mb-0 mt-3 btn-sm" style="border: 0; cursor: pointer;" value="Add Deposit" id="addDepositTab">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        
                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>DATE:</label>
                                        <?php foreach($sa_date_depositArr as $sa_date_depositArrvalue ){?>
                                        <input type="date" name="edit_sa_date_deposit[]" oninput="" id="sa_date_deposit" class="mt-2 sa_date_deposit form-control form-control-sm" value="<?php echo $sa_date_depositArrvalue;?>" >
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>AMOUNT:</label>
                                        <?php foreach($sa_amount_depositArr as $sa_amount_depositArrvalue ){?>
                                        <input type="text" name="edit_sa_amount_deposit[]" oninput="addDeposit()" id="sa_amount_deposit" class="mt-2 sa_amount_deposit form-control form-control-sm" value="<?php echo $sa_amount_depositArrvalue;?>" >
                                        <?php } ?>
                                    </div>
                                </div>

                                <div id="divNextDeposit">

                                </div>
                            </div>
                        </div>
                        
                        <!-- Dito na tayo sa edit ng sa -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TOTAL AMOUNT DEPOSIT:</label>
                                <input type="text" name="edit_total_amount_deposit" oninput="" id="total_amount_deposit" class="total_amount_deposit form-control form-control-sm" value="<?php echo $rows['total_amount_deposit']?>" readonly="true">
                            </div>
                            <!-- <div class="col-md-2">
                                <label for="" class="font-weight-bold" style="visibility: hidden"><span class="text-danger mr-1">*</span>TOTAL AMOUNT DEPOSIT:</label>
                                <input type="text" name="total_amount_deposit" style="visibility: hidden" oninput="" id="total_amount_deposit" class="total_amount_deposit form-control form-control-sm" value="0" required>
                            </div> -->
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TOTAL AMOUNT:</label>
                                <input type="text" name="edit_total_amount" oninput="" id="total_amount" class="total_amount form-control " value="<?php echo $rows['total_amount']?>" readonly="true">
                            </div>
                            <!-- <div class="col-md-2">
                                <label for="" class="font-weight-bold" style="visibility: hidden"><span class="text-danger mr-1">*</span>TOTAL AMOUNT DEPOSIT:</label>
                                <input type="text" name="total_amount_deposit" style="visibility: hidden" oninput="" id="total_amount_deposit" class="total_amount_deposit form-control form-control-sm" value="0" required>
                            </div> -->
                        </div>
                    </div>

                    

                    <input type="submit" id="editBtn" class="btn btn-success btn-block mt-3" value="Save">
                    
                </form>
            </div>
                                
                            
                        
                <?php } ?>
            <?php } ?>
        </div>
        
        

        </div>
    </div>

<!-- Sweetalert Cdn Start -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert Cdn End -->

<!-- JS SCRIPT -->
<script src="ar.js"></script>


    

<script>

        $(".select-tourCost-2").hide();
        $(".select-taxes-2").hide();
        $(".select-tipFund-2").hide();
        $(".select-travelInsurance-2").hide();
        $(".select-visaFee-2").hide();
        $(".select-other-2").hide();
        $(".divTotal-2").show();
        
        $('.select-Fee-2').change(function () {
                
        var selectedVal2 = document.querySelector(".select-Fee-2");
        // console.log(selectedVal2.options[selectedVal2.selectedIndex].value)
        // alert("You selected " + selectedVal.options[selectedVal.selectedIndex].value);

        if(selectedVal2.options[selectedVal2.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-2").show();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();

            



        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "TAXES"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").show();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").show();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").show();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").show();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "OTHER"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").show();
            $(".divTotal-2").show();
        }
            
        else{
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
            
        }



        




    });

    


        $(".select-tourCost-3").hide();
        $(".select-taxes-3").hide();
        $(".select-tipFund-3").hide();
        $(".select-travelInsurance-3").hide();
        $(".select-visaFee-3").hide();
        $(".select-other-3").hide();
        $(".divTotal-3").show();

        $('.select-Fee-3').change(function () {
                
        var selectedVal3 = document.querySelector(".select-Fee-3");

        if(selectedVal3.options[selectedVal3.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-3").show();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "TAXES"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").show();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").show();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").show();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").show();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "OTHER"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").show();
            $(".divTotal-3").show();
        }

        else{
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

    });



        $(".select-tourCost-4").hide();
        $(".select-taxes-4").hide();
        $(".select-tipFund-4").hide();
        $(".select-travelInsurance-4").hide();
        $(".select-visaFee-4").hide();
        $(".select-other-4").hide();
        $(".divTotal-4").show();

        $('.select-Fee-4').change(function () {
                
        var selectedVal4 = document.querySelector(".select-Fee-4");

        if(selectedVal4.options[selectedVal4.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-4").show();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "TAXES"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").show();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").show();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").show();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").show();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "OTHER"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").show();
            $(".divTotal-4").show();
        }

        else{
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

    });


        $(".select-tourCost-5").hide();
        $(".select-taxes-5").hide();
        $(".select-tipFund-5").hide();
        $(".select-travelInsurance-5").hide();
        $(".select-visaFee-5").hide();
        $(".select-other-5").hide();
        $(".divTotal-5").show();

        $('.select-Fee-5').change(function () {
                
        var selectedVal5 = document.querySelector(".select-Fee-5");

        if(selectedVal5.options[selectedVal5.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-5").show();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "TAXES"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").show();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").show();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").show();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        //Dito na tayo sa kapag nilipat na category at maraming field yung other nagdidisplay sya sa ibang category hindi nawawala yung mga fields

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").show();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "OTHER"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").show();
            $(".divTotal-5").show();
        }

        else{
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

    });

        $(".select-tourCost-6").hide();
        $(".select-taxes-6").hide();
        $(".select-tipFund-6").hide();
        $(".select-travelInsurance-6").hide();
        $(".select-visaFee-6").hide();
        $(".select-other-6").hide();
        $(".divTotal-6").show();

        $('.select-Fee-6').change(function () {
                
        var selectedVal6 = document.querySelector(".select-Fee-6");

        if(selectedVal6.options[selectedVal6.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-6").show();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "TAXES"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").show();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").show();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").show();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").show();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "OTHER"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").show();
            $(".divTotal-6").show();
        }

        else{
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

    });


        $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();

        $('.select-Fee-7').change(function () {
                
        var selectedVal7 = document.querySelector(".select-Fee-7");

        if(selectedVal7.options[selectedVal7.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-7").show();
            $(".select-taxes-7").hide();
            $(".select-tipFund-7").hide();
            $(".select-travelInsurance-7").hide();
            $(".select-visaFee-7").hide();
            $(".select-other-7").hide();
            $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "TAXES"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").show();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").show();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").show();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").show();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "OTHER"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").show();
        $(".divTotal-7").show();
        }

        else{
            $(".select-tourCost-7").hide();
            $(".select-taxes-7").hide();
            $(".select-tipFund-7").hide();
            $(".select-travelInsurance-7").hide();
            $(".select-visaFee-7").hide();
            $(".select-other-7").hide();
            $(".divTotal-7").show();
        }

    });


        $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();

        $('.select-Fee-8').change(function () {
                
        var selectedVal8 = document.querySelector(".select-Fee-8");

        if(selectedVal8.options[selectedVal8.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-8").show();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "TAXES"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").show();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").show();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").show();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").show();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "OTHER"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").show();
        $(".divTotal-8").show();
        }

        else{
            $(".select-tourCost-8").hide();
            $(".select-taxes-8").hide();
            $(".select-tipFund-8").hide();
            $(".select-travelInsurance-8").hide();
            $(".select-visaFee-8").hide();
            $(".select-other-8").hide();
            $(".divTotal-8").show();
        }

    });


        $(".select-tourCost-9").hide();
        $(".select-taxes-9").hide();
        $(".select-tipFund-9").hide();
        $(".select-travelInsurance-9").hide();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();

        $('.select-Fee-9').change(function () {
                
        var selectedVal9 = document.querySelector(".select-Fee-9");

        if(selectedVal9.options[selectedVal9.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-9").show();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").hide();
            $(".select-other-9").hide();
            $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "TAXES"){
            $(".select-tourCost-9").hide();
        $(".select-taxes-9").show();
        $(".select-tipFund-9").hide();
        $(".select-travelInsurance-9").hide();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-9").hide();
        $(".select-taxes-9").hide();
        $(".select-tipFund-9").show();
        $(".select-travelInsurance-9").hide();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-9").hide();
        $(".select-taxes-9").hide();
        $(".select-tipFund-9").hide();
        $(".select-travelInsurance-9").show();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-9").hide();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").show();
            $(".select-other-9").hide();
            $(".divTotal-9").show();
            }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "OTHER"){
            $(".select-tourCost-9").hide();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").hide();
            $(".select-other-9").show();
            $(".divTotal-9").show();
            }

        else{
            $(".select-tourCost-9").hide();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").hide();
            $(".select-other-9").hide();
            $(".divTotal-9").show();
        }
   

    });



        $(".select-tourCost-10").hide();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();

        $('.select-Fee-10').change(function () {
                
        var selectedVal10 = document.querySelector(".select-Fee-10");

        if(selectedVal10.options[selectedVal10.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-10").show();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "TAXES"){
            $(".select-tourCost-10").hide();
        $(".select-taxes-10").show();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-10").hide();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").show();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-10").hide();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").show();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-10").hide();
            $(".select-taxes-10").hide();
            $(".select-tipFund-10").hide();
            $(".select-travelInsurance-10").hide();
            $(".select-visaFee-10").show();
            $(".select-other-10").hide();
            $(".divTotal-10").show();
            }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "OTHER"){
            $(".select-tourCost-10").hide();
            $(".select-taxes-10").hide();
            $(".select-tipFund-10").hide();
            $(".select-travelInsurance-10").hide();
            $(".select-visaFee-10").hide();
            $(".select-other-10").show();
            $(".divTotal-10").show();
            }

        else{
            $(".select-tourCost-10").hide();
            $(".select-taxes-10").hide();
            $(".select-tipFund-10").hide();
            $(".select-travelInsurance-10").hide();
            $(".select-visaFee-10").hide();
            $(".select-other-10").hide();
            $(".divTotal-10").show();
        }
   

    });



    zeroValue();
    function zeroValue(){

        // USD


        let tourcost1_usdInput = document.querySelectorAll('.tourcost1_usd');
        // console.log(tourcost1_usdInput)
        tourcost1_usdInput.forEach(function(tourcost1_usdInput_item, index) {
        
        
        tourcost1_usdInput_item.addEventListener("change", (event) => {
            if(tourcost1_usdInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                tourcost1_usdInput_item.value = 0;
                select1();
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let taxes1_usdInput = document.querySelectorAll('.taxes1_usd');

        taxes1_usdInput.forEach(function(taxes1_usdInput_item, index) {
        
        taxes1_usdInput_item.addEventListener("change", (event) => {
            if(taxes1_usdInput_item.value == ""){
                
                taxes1_usdInput_item.value = 0;
                select1();
            }
            else{
                
            }
            });
        });


        let tip_fund1_usdInput = document.querySelectorAll('.tip_fund1_usd');
    
        tip_fund1_usdInput.forEach(function(tip_fund1_usdInput_item, index) {
        
        
        tip_fund1_usdInput_item.addEventListener("change", (event) => {
            if(tip_fund1_usdInput_item.value == ""){
                
                tip_fund1_usdInput_item.value = 0;
                select1();
            }
            else{
                
            }
            });
        });


        let travel_insurance1_usdInput = document.querySelectorAll('.travel_insurance1_usd');

        travel_insurance1_usdInput.forEach(function(travel_insurance1_usdInput_item, index) {
       
        travel_insurance1_usdInput_item.addEventListener("change", (event) => {
            if(travel_insurance1_usdInput_item.value == ""){
                
                travel_insurance1_usdInput_item.value = 0;
                select1();
            }
            else{
                
            }
            });
        });


        let visa_fee1_usdInput = document.querySelectorAll('.visa_fee1_usd');
        // console.log(tourcost1_usdInput)
        visa_fee1_usdInput.forEach(function(visa_fee1_usdInput_item, index) {
        
        visa_fee1_usdInput_item.addEventListener("change", (event) => {
            if(visa_fee1_usdInput_item.value == ""){
                
                visa_fee1_usdInput_item.value = 0;
                select1();
            }
            else{
                
            }
            });
        });


        let other1_usdInput = document.querySelectorAll('.other1_usd');
        // console.log(tourcost1_usdInput)
        other1_usdInput.forEach(function(other1_usdInput_item, index) {
        
        
        other1_usdInput_item.addEventListener("change", (event) => {
            if(other1_usdInput_item.value == ""){
                
                other1_usdInput_item.value = 0;
                select1();
            }
            else{
                
            }
            });
        });


        // PHP


        let tourcost1_phpInput = document.querySelectorAll('.tourcost1_php');
        // console.log(tourcost1_usdInput)
        tourcost1_phpInput.forEach(function(tourcost1_phpInput_item, index) {
        
        
            tourcost1_phpInput_item.addEventListener("change", (event) => {
            if(tourcost1_phpInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                tourcost1_phpInput_item.value = 0;
                selectphp1();
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let taxes1_phpInput = document.querySelectorAll('.taxes1_php');
        // console.log(tourcost1_usdInput)
        taxes1_phpInput.forEach(function(taxes1_phpInput_item, index) {
        
        
            taxes1_phpInput_item.addEventListener("change", (event) => {
            if(taxes1_phpInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                taxes1_phpInput_item.value = 0;
                selectphp1();
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let tip_fund1_phpInput = document.querySelectorAll('.tip_fund1_php');
        // console.log(tourcost1_usdInput)
        tip_fund1_phpInput.forEach(function(tip_fund1_phpInput_item, index) {
        
        
            tip_fund1_phpInput_item.addEventListener("change", (event) => {
            if(tip_fund1_phpInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                tip_fund1_phpInput_item.value = 0;
                selectphp1();
            }
            else{
                // alert("Merong value");
            }
            });
        });

         

        let travel_insurance1_phpInput = document.querySelectorAll('.travel_insurance1_php');
        // console.log(tourcost1_usdInput)
        travel_insurance1_phpInput.forEach(function(travel_insurance1_phpInput_item, index) {
        
        
            travel_insurance1_phpInput_item.addEventListener("change", (event) => {
            if(travel_insurance1_phpInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                travel_insurance1_phpInput_item.value = 0;
                selectphp1();
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let visa_fee1_phpInput = document.querySelectorAll('.visa_fee1_php');
        // console.log(tourcost1_usdInput)
        visa_fee1_phpInput.forEach(function(visa_fee1_phpInput_item, index) {
        
        
            visa_fee1_phpInput_item.addEventListener("change", (event) => {
            if(visa_fee1_phpInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                visa_fee1_phpInput_item.value = 0;
                selectphp1();
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let other1_phpInput = document.querySelectorAll('.other1_php');
        // console.log(tourcost1_usdInput)
        other1_phpInput.forEach(function(other1_phpInput_item, index) {
        
        
            other1_phpInput_item.addEventListener("change", (event) => {
            if(other1_phpInput_item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                other1_phpInput_item.value = 0;
                selectphp1();
            }
            else{
                // alert("Merong value");
            }
            });
        });

         


        let sa_amount_depositInput = document.querySelectorAll('.sa_amount_deposit');
        // console.log(sa_amount_depositInput)
        sa_amount_depositInput.forEach(function(sa_amount_depositInput_item, index) {
        
            // alert("Item: " + (index + 1));
            // alert(sa_amount_depositInput_item.value);
            sa_amount_depositInput_item.addEventListener("change", (event) => {
            if(sa_amount_depositInput_item.value == ""){
                // alert("Walang value si " + sa_amount_depositInput_item.value);
                sa_amount_depositInput_item.value = 0;
                addDeposit()
            }
            else{
                // alert("Merong value");
                addDeposit()
            }
            });
        });

    }

    



    //Dito na tayo once na walang input yung isang element gagawin nyang zero

    

    // tourcost1_usdInput.addEventListener("change", (event) => {
    //     if(tourcost1_usdInput.value == ""){
    //         // alert("Walang value");
    //         tourcost1_usdInput.value = 0;
    //         select1();
    //     }
    //     else{
    //          alert("Merong value");
    //     }
    // });

    

    // FOR SELECT PAYMENT METHOD
                                         
    function readonlyInputs(){

        $('.tourcost1_usd').prop('readonly', true);
        $('.tourcost1_arc').prop('readonly', true);
        $('.tourcost1_php').prop('readonly', true);

        $('.taxes1_usd').prop('readonly', true);
        $('.taxes1_arc').prop('readonly', true);
        $('.taxes1_php').prop('readonly', true);

        $('.tip_fund1_usd').prop('readonly', true);
        $('.tip_fund1_arc').prop('readonly', true);
        $('.tip_fund1_php').prop('readonly', true);

        $('.travel_insurance1_usd').prop('readonly', true);
        $('.travel_insurance1_arc').prop('readonly', true);
        $('.travel_insurance1_php').prop('readonly', true);

        $('.visa_fee1_usd').prop('readonly', true);
        $('.visa_fee1_arc').prop('readonly', true);
        $('.visa_fee1_php').prop('readonly', true);

        $('.nested_visa_fee_usd_readonly').prop('readonly', true);


        $('.other1_usd').prop('readonly', true);
        $('.other1_arc').prop('readonly', true);
        $('.other1_php').prop('readonly', true); 

        $('.select1_total_usd').prop('readonly', true);
        $('.select1_total_php').prop('readonly', true);

        $('#acr-div').hide();
        // $('#sa_acr').val(0);

         
         

        // $('.select1_total_usd').val(0);
        // $('.select1_total_php').val(0);

    }

    let sa_acr = document.getElementById("sa_acr");

    sa_acr.addEventListener('input', function(e){
        console.log('Input value changed:', e.target.value);

        if(e.target.value == ""){
            e.target.value = 0;
            // select1();
        }
        else{

        }

        subtotalselectUsd();

    })

    // readonlyInputs();
    selectedUsdPhpHotel();

    function handlePaymentMethodClick(event) {
      const selectedValue = event.target.value;
      console.log(`User selected: ${selectedValue}`);

      if(selectedValue == "USD"){
        console.log("USD USD USD")
            $('.tourcost1_php').val(0);
            $('.taxes1_php').val(0);
            $('.tip_fund1_php').val(0);
            $('.travel_insurance').val(0);

            $('.visa_fee1_php').val(0); 
            $('.nested_visa_fee_php_readonly').val(0);
            $('.nested_visa_sub_php').val(0);
            $('.nested_visa_sub_usd').val(0); 
            

            $('.other1_php').val(0);
            $('.nested_other_php').val(0);
            $('.nested_other_sub_php').val(0);
            $('.nested_other_sub_usd').val(0);
            $('.nested_other_usd_readonly').val(0); 
            

            $('.select1_total_php').val(0);
            $('.select1_total_usd').val(0);

            $('.sub_total_usd').val(0);
            $('.sub_total_php').val(0); 
            $('.total_of_sub_total').val(0); 
            $('.total_amount').val(0);

            nestedChoosePaymentMethod()

      }

      else if(selectedValue == "PHP"){
        console.log("PHP PHP PHP")

            $('.tourcost1_usd').val(0);
            $('.tourcost1_arc').val(0);
            
            $('.taxes1_usd').val(0);
            $('.taxes1_arc').val(0);

            $('.tip_fund1_usd').val(0);
            $('.tip_fund1_arc').val(0);

            $('.travel_insurance_usd').val(0);
            $('.travel_insurance_arc').val(0);

            $('.visa_fee1_usd').val(0);
            $('.visa_fee1_arc').val(0);
            $('.nested_visa_fee_usd_readonly').val(0);

            $('.nested_visa_sub_php').val(0);
            $('.nested_visa_sub_usd').val(0);

            $('.other1_usd').val(0);
            $('.other1_arc').val(0);
            $('.nested_other_usd').val(0);
            $('.nested_other_usd_readonly').val(0);
            
            $('.nested_other_sub_php').val(0);
            $('.nested_other_sub_usd').val(0);
            
            $('.select1_total_php').val(0);
            $('.select1_total_usd').val(0);

            $('.sub_total_usd').val(0);
            $('.sub_total_php').val(0); 
            $('.total_of_sub_total').val(0); 
            $('.total_amount').val(0);

            nestedChoosePaymentMethod()

      }
      

    }

    function selectedUsdPhpHotel(){
        //Validate the USD OR PHP Radio Button
        if(document.getElementById('usdChosePaymentMethod').checked) {

            const usdChosePaymentMethod = document.getElementById('usdChosePaymentMethod');
            const phpChosePaymentMethod = document.getElementById('phpChosePaymentMethod');
        //USD radio button is checked
            
            console.log("naclick si usd")

            $('.tourcost1_usd').prop('readonly', false);
            $('.tourcost1_arc').prop('readonly', false);
            $('.tourcost1_php').prop('readonly', true);
            // $('.tourcost1_php').val(0);

            $('.taxes1_usd').prop('readonly', false);
            $('.taxes1_arc').prop('readonly', false);
            $('.taxes1_php').prop('readonly', true);
            // $('.taxes1_php').val(0);

            $('.tip_fund1_usd').prop('readonly', false);
            $('.tip_fund1_arc').prop('readonly', false);
            $('.tip_fund1_php').prop('readonly', true);
            // $('.tip_fund1_php').val(0);

            $('.travel_insurance1_usd').prop('readonly', false);
            $('.travel_insurance1_arc').prop('readonly', false);
            $('.travel_insurance1_php').prop('readonly', true);
            // $('.travel_insurance1_php').val(0);

            $('.visa_fee1_usd').prop('readonly', false);
            $('.visa_fee1_arc').prop('readonly', false);
            $('.visa_fee1_php').prop('readonly', true);
            // $('.visa_fee1_php').val(0);

            $('.nested_visa_fee_usd_readonly').prop('readonly', false);


            $('.other1_usd').prop('readonly', false);
            $('.other1_arc').prop('readonly', false);
            $('.other1_php').prop('readonly', true);
            // $('.other1_php').val(0);

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);

            $('#acr-div').show();
            // $('#sa_acr').val(0);
            // $('.select1_total_php').val(0);
            // selectphp1();
            usdChosePaymentMethod.addEventListener('click', handlePaymentMethodClick);
            phpChosePaymentMethod.addEventListener('click', handlePaymentMethodClick);
            

            

        }
        
        else if(document.getElementById('phpChosePaymentMethod').checked) {
        //Php radio button is checked
            console.log("naclick si php")

            const usdChosePaymentMethod = document.getElementById('usdChosePaymentMethod');
            const phpChosePaymentMethod = document.getElementById('phpChosePaymentMethod');

            $('.tourcost1_usd').prop('readonly', true);
            $('.tourcost1_arc').prop('readonly', true);
            // $('.tourcost1_usd').val(0);
            // $('.tourcost1_arc').val(0);
            $('.tourcost1_php').prop('readonly', false);

            $('.taxes1_usd').prop('readonly', true);
            $('.taxes1_arc').prop('readonly', true);
            // $('.taxes1_usd').val(0);
            // $('.taxes1_arc').val(0);
            $('.taxes1_php').prop('readonly', false);

            $('.tip_fund1_usd').prop('readonly', true);
            $('.tip_fund1_arc').prop('readonly', true);
            // $('.tip_fund1_usd').val(0);
            // $('.tip_fund1_arc').val(0);
            $('.tip_fund1_php').prop('readonly', false);

            $('.travel_insurance1_usd').prop('readonly', true);
            $('.travel_insurance1_arc').prop('readonly', true);
            // $('.travel_insurance1_usd').val(0);
            // $('.travel_insurance1_arc').val(0);
            $('.travel_insurance1_php').prop('readonly', false);

            $('.visa_fee1_usd').prop('readonly', true);
            $('.visa_fee1_arc').prop('readonly', true);
            // $('.visa_fee1_usd').val(0);
            // $('.visa_fee1_arc').val(0);
            $('.visa_fee1_php').prop('readonly', false);

            $('.nested_visa_fee_usd_readonly').prop('readonly', true);


            $('.other1_usd').prop('readonly', true);
            $('.other1_arc').prop('readonly', true);
            // $('.other1_usd').val(0);
            // $('.other1_arc').val(0);
            $('.other1_php').prop('readonly', false);

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);

            $('#acr-div').hide();
            $('#sa_acr').val(0);
            // $('.select1_total_php').val(0);
            select1();
            usdChosePaymentMethod.addEventListener('click', handlePaymentMethodClick);
            phpChosePaymentMethod.addEventListener('click', handlePaymentMethodClick);

            

        }

        else{
            $('.tourcost1_usd').prop('readonly', true);
            $('.tourcost1_arc').prop('readonly', true);
            // $('.tourcost1_usd').val(0);
            // $('.tourcost1_arc').val(0);
            $('.tourcost1_php').prop('readonly', true);

            $('.taxes1_usd').prop('readonly', true);
            $('.taxes1_arc').prop('readonly', true);
            // $('.taxes1_usd').val(0);
            // $('.taxes1_arc').val(0);
            $('.taxes1_php').prop('readonly', true);

            $('.tip_fund1_usd').prop('readonly', true);
            $('.tip_fund1_arc').prop('readonly', true);
            // $('.tip_fund1_usd').val(0);
            // $('.tip_fund1_arc').val(0);
            $('.tip_fund1_php').prop('readonly', true);

            $('.travel_insurance1_usd').prop('readonly', true);
            $('.travel_insurance1_arc').prop('readonly', true);
            // $('.travel_insurance1_usd').val(0);
            // $('.travel_insurance1_arc').val(0);
            $('.travel_insurance1_php').prop('readonly', true);

            $('.visa_fee1_usd').prop('readonly', true);
            $('.visa_fee1_arc').prop('readonly', true);
            // $('.visa_fee1_usd').val(0);
            // $('.visa_fee1_arc').val(0);
            $('.visa_fee1_php').prop('readonly', true);

            $('.nested_visa_fee_usd_readonly').prop('readonly', true);


            $('.other1_usd').prop('readonly', true);
            $('.other1_arc').prop('readonly', true);
            // $('.other1_usd').val(0);
            // $('.other1_arc').val(0);
            $('.other1_php').prop('readonly', true);

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            // $('.select1_total_php').val(0);
        }

        nestedChoosePaymentMethod()
    }

    

    function nestedChoosePaymentMethod(){
        $('.nested_visa_fee_usd_readonly').prop('readonly', true);
        $('.nested_visa_fee_arc_readonly').prop('readonly', true);
        $('.nested_visa_fee_php_readonly').prop('readonly', true);

        $('.nested_other_usd_readonly').prop('readonly', true);
        $('.nested_other_arc_readonly').prop('readonly', true);
        $('.nested_other_php_readonly').prop('readonly', true);

        if(document.getElementById('usdChosePaymentMethod').checked) {

            // $("#phpChosePaymentMethod").attr("disabled", "false");
            $('#usdChosePaymentMethod').prop('readonly', true);
            // $("#phpChosePaymentMethod").removeAttr("disabled");
 
            // FOR VISA FEE START

            $('.nested_visa_fee_usd_readonly').prop('readonly', false);
            $('.nested_visa_fee_arc_readonly').prop('readonly', false);
            $('.nested_visa_fee_php_readonly').prop('readonly', true);
            $('.nested_visa_fee_php_readonly').val(0);

            // FOR VISA FEE END

            // FOR OTHER START 

            $('.nested_other_usd_readonly').prop('readonly', false);
            $('.nested_other_arc_readonly').prop('readonly', false);
            $('.nested_other_php_readonly').prop('readonly', true);
            // $('.nested_other_php_readonly').val(0);

            // FOR OTHER END

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            // $('.select1_total_php').val(0);

            // $('.sub_total_usd').val(0);
            // $('.sub_total_php').val(0); 
            // $('.total_of_sub_total').val(0); 
            // $('.total_amount').val(0);




        }
        
        else if(document.getElementById('phpChosePaymentMethod').checked) {
            $('#phpChosePaymentMethod').prop('readonly', true);
            // $("#usdChosePaymentMethod").removeAttr("disabled");
            // $("#usdChosePaymentMethod").attr("disabled", "false");

            // FOR VISA FEE START
            $('.nested_visa_fee_usd_readonly').prop('readonly', true);
            // $('.nested_visa_fee_usd_readonly').val(0);
            
            $('.nested_visa_fee_arc_readonly').prop('readonly', true);
            // $('.nested_visa_fee_arc_readonly').val(0);

            $('.nested_visa_fee_php_readonly').prop('readonly', false);

            // FOR VISA FEE END


            // FOR OTHER START 

            $('.nested_other_usd_readonly').prop('readonly', true);
            // $('.nested_other_usd_readonly').val(0);

            $('.nested_other_arc_readonly').prop('readonly', true);
            // $('.nested_other_arc_readonly').val(0);

            $('.nested_other_php_readonly').prop('readonly', false);
            

            // FOR OTHER END

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            // $('.select1_total_php').val(0); 

            // $('.sub_total_usd').val(0);
            // $('.sub_total_php').val(0); 
            // $('.total_of_sub_total').val(0); 
            // $('.total_amount').val(0);
            
            
        }

        else{
            $('.nested_visa_fee_usd_readonly').prop('readonly', true);
            // $('.nested_visa_fee_usd_readonly').val(0);

            $('.nested_visa_fee_arc_readonly').prop('readonly', true);
            // $('.nested_visa_fee_arc_readonly').val(0);

            $('.nested_visa_fee_php_readonly').prop('readonly', true);
            // $('.nested_visa_fee_php_readonly').val(0);

            $('.nested_other_usd_readonly').prop('readonly', true);
            // $('.nested_other_usd_readonly').val(0);

            $('.nested_other_arc_readonly').prop('readonly', true);
            // $('.nested_other_arc_readonly').val(0);

            $('.nested_other_php_readonly').prop('readonly', true);
            // $('.nested_other_php_readonly').val(0);

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            // $('.select1_total_php').val(0);

            // $('.sub_total_usd').val(0);
            // $('.sub_total_php').val(0); 
            // $('.total_of_sub_total').val(0); 
            // $('.total_amount').val(0);
        }
    }
    
    
    

    // $('#airfare_airfare_php').prop('readonly', true);
    // $('#airfare_taxes_php').prop('readonly', true);
    // $('#airfare_iata_php').prop('readonly', true);



    
    //FOR SELECT OPTION

    $(".select-tourCost-1").hide();
    $(".select-taxes-1").hide();
    $(".select-tipFund-1").hide();
    $(".select-travelInsurance-1").hide();
    $(".select-visaFee-1").hide();
    $(".select-other-1").hide();
    
    $(".divTotal-1").show();
    

    $('.select-Fee-1').change(function () {
        var selectedVal = document.querySelector(".select-Fee-1");
        // alert("You selected " + selectedVal.options[selectedVal.selectedIndex].value);

        if(selectedVal.options[selectedVal.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-1").show();
            $(".select-taxes-1").hide();
            $(".select-tipFund-1").hide();
            $(".select-travelInsurance-1").hide();
            $(".select-visaFee-1").hide();
            $(".select-other-1").hide();
            $(".divTotal-1").show();

        }

        else if(selectedVal.options[selectedVal.selectedIndex].value === "TAXES"){
            $(".select-tourCost-1").hide();
            $(".select-taxes-1").show();
            $(".select-tipFund-1").hide();
            $(".select-travelInsurance-1").hide();
            $(".select-visaFee-1").hide();
            $(".select-other-1").hide();
            $(".divTotal-1").show();
        }

        else if(selectedVal.options[selectedVal.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-1").hide();
            $(".select-taxes-1").hide();
            $(".select-tipFund-1").show();
            $(".select-travelInsurance-1").hide();
            $(".select-visaFee-1").hide();
            $(".select-other-1").hide();
            $(".divTotal-1").show();
        }

        else if(selectedVal.options[selectedVal.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-1").hide();
            $(".select-taxes-1").hide();
            $(".select-tipFund-1").hide();
            $(".select-travelInsurance-1").show();
            $(".select-visaFee-1").hide();
            $(".select-other-1").hide();
            $(".divTotal-1").show();
        }

        else if(selectedVal.options[selectedVal.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-1").hide();
            $(".select-taxes-1").hide();
            $(".select-tipFund-1").hide();
            $(".select-travelInsurance-1").hide();
            $(".select-visaFee-1").show();
            $(".select-other-1").hide();
            $(".divTotal-1").show();
        }

        else if(selectedVal.options[selectedVal.selectedIndex].value === "OTHER"){
            $(".select-tourCost-1").hide();
            $(".select-taxes-1").hide();
            $(".select-tipFund-1").hide();
            $(".select-travelInsurance-1").hide();
            $(".select-visaFee-1").hide();
            $(".select-other-1").show();
            $(".divTotal-1").show();
        }

        else{
            $(".select-tourCost-1").hide();
            $(".select-taxes-1").hide();
            $(".select-tipFund-1").hide();
            $(".select-travelInsurance-1").hide();
            $(".select-visaFee-1").hide();
            $(".select-other-1").hide();
            $(".divTotal-1").show();
        }

        

       





    });


                                                    
    

    
    

    

    

    $("#addDepositTab").click(function(e){
        e.preventDefault();

        console.log("napindot si addDepositTab")

        $("#divNextDeposit").append(
            `<div class="row mt-4">
                <div class="col-md-6">
                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>DATE:</label>
                    <input type="date" name="edit_sa_date_deposit[]" oninput="" id="sa_date_deposit" class="sa_date_deposit form-control form-control-sm"  required>
                </div>

                <div class="col-md-6">
                    <div class="row pr-4">
                        <div class="col-md-10" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>AMOUNT:</label>
                        </div>

                        <div class="col-md-2 pr-3">
                            <input type="button" class="btn btn-danger btn-sm" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="" value="Remove" id="removeDepositBtn">
                        </div>
                    </div>
                    <div id="container-amount-deposit">
                        <input type="number" name="edit_sa_amount_deposit[]" oninput="addDeposit()" id="sa_amount_deposit" class="sa_amount_deposit form-control form-control-sm" value="0" required>
                    </div>
                </div>

                
            </div>`);

            zeroValue();

    })

    //Dito naman tayo kapag walang value na nilagay si user dapat mag zezero yung deposit

    


    $(document).on('click', '#removeDepositBtn', function(e){
            e.preventDefault();

           

            let conAmountDeposit = document.getElementById('container-amount-deposit');
            
            conAmountDeposit.children[0];
            console.log(conAmountDeposit.children[0]);
            let depositamountVal = conAmountDeposit.children[0].value;
            console.log(depositamountVal);

            let row_item = $(this).parent().parent().parent().parent();
            let input_item = $(this).parent();
 
            $(row_item).remove();

            addDeposit()

            

    })





    // Kulang ng passenger name field kapag nag aadd tayo ng passenger
    
    $(document).on('click', '#removePassengerBtn', function(e){
            e.preventDefault();

            // alert("qwe");
            // console.log("qqweqweqweqweqe");

            let conAmount = document.getElementById('container-amount');
            conAmount.children[1];
            console.log(conAmount.children[1]);
            let amountVal = conAmount.children[1].value;
            console.log(amountVal);

            // Dito na tayo sa removepassenger

            let row_item = $(this).parent().parent().parent();
            let input_item = $(this).parent();
            
            $(row_item).remove();
            

            if(document.getElementById('usdChosePaymentMethod').checked) {
                select1()
            }

            else if(document.getElementById('phpChosePaymentMethod').checked){
                selectphp1()
            }

            else{
                alert("Can't proceed");
            }
            

    })


    // REMOVE NESTED VISA FEE START

    // $(document).on('click', '#removeNestedVisaFeeBtn', function(e){
    //         e.preventDefault();

    //         let containerNestedRemove = document.getElementById('container-nested-remove');
    //         containerNestedRemove.children[1];
    //         console.log(containerNestedRemove.children[1]);
    //         let amountVal = containerNestedRemove.children[1].value;
    //         console.log("Amount Value Remove: " + amountVal);

            

    //         let row_item = $(this).parent().parent().parent();
    //         let input_item = $(this).parent().parent().parent();

    //         $(row_item).remove();

            
    // })
    
    // REMOVE NESTED VISA FEE END

    //Hindi maremove yung value ng nireremove
    
    function addDeposit(){
        let sa_amount_deposit = document.querySelectorAll('.sa_amount_deposit');

        var sa_amount_depositvalues = [].map.call(sa_amount_deposit, function(e) {
            
            return parseFloat(e.value);
        });

        let sa_amount_depositSum = sa_amount_depositvalues.reduce((accumulator, currentValue) => accumulator + currentValue, 0);

        // console.log(sa_amount_depositSum); 

        let total_amount_deposit = document.getElementById('total_amount_deposit');

        total_amount_deposit.value = sa_amount_depositSum;

        let total_of_sub_total = document.getElementById('total_of_sub_total').value;

        let totalAmountCalwDeposit = total_of_sub_total - sa_amount_depositSum ;

        let total_amount = document.getElementById('total_amount');
        total_amount.value = totalAmountCalwDeposit;

        // console.log(totalAmountCalwDeposit)

        // console.log(total_amount_deposit)
    }

    // function totalAmoutCalcWDeposit(){
    //     addDeposit()
        
    // }

    function subtotalselectUsd(){

            var tourcost1_phpElement = document.querySelectorAll('.tourcost1_usd');
            var taxes1_phpElement = document.querySelectorAll('.taxes1_usd');
            var tip_fund1_phpElement = document.querySelectorAll('.tip_fund1_usd');
            var travel_insurance1_phpElement = document.querySelectorAll('.travel_insurance1_usd');
            var visa_fee1_phpElement = document.querySelectorAll('.visa_fee1_usd');
            var other1_phpElement = document.querySelectorAll('.other1_usd'); 

            
            var nested_2_visa_fee_phpElement = document.querySelectorAll('.nested_2_visa_fee_usd');
            
            var select1_total_phpElement = document.querySelectorAll('.select1_total_usd');
            var sub_total_usd = document.querySelector('.sub_total_usd');
            var sub_total_php = document.querySelector('.sub_total_php').value; 
            var total_of_sub_total = document.querySelector('.total_of_sub_total'); 
            var total_amount = document.querySelector('.total_amount');
            // Create an array to store the values
            var valuesTourCostPhp = [];
            var valuesTaxesPhp = [];
            var valuesTipFundPhp = [];
            var valuesTravelInsurancePhp = [];
            var valuesVisaFeePhp = [];
            var valuesOtherPhp = [];

            var valuesNested2VisaFeePhp = [];

            

            

            // Iterate through the collection and push the values to the array
            for (var i = 0; i < tourcost1_phpElement.length; i++) {
                valuesTourCostPhp.push(tourcost1_phpElement[i].value);
            }

            for (var i = 0; i < taxes1_phpElement.length; i++) {
                valuesTaxesPhp.push(taxes1_phpElement[i].value);
            }

            for (var i = 0; i < tip_fund1_phpElement.length; i++) {
                valuesTipFundPhp.push(tip_fund1_phpElement[i].value);
            }

            for (var i = 0; i < travel_insurance1_phpElement.length; i++) {
                valuesTravelInsurancePhp.push(travel_insurance1_phpElement[i].value);
            }

            for (var i = 0; i < visa_fee1_phpElement.length; i++) {
                
                valuesVisaFeePhp.push(visa_fee1_phpElement[i].value);
                
            }

            var nested_visa_sub_usdElement = document.querySelectorAll('.nested_visa_sub_usd');

            let nestedVisaFeeUsd = [];

            for (var i = 0; i < nested_visa_sub_usdElement.length; i++) {
                nestedVisaFeeUsd.push(nested_visa_sub_usdElement[i].value);
            }
            console.log("Nested Visa Fee Usd" + nestedVisaFeeUsd);


            





            for (var i = 0; i < other1_phpElement.length; i++) {
                valuesOtherPhp.push(other1_phpElement[i].value);
            }

            var nested_other_usdElement = document.querySelectorAll('.nested_other_sub_usd');

            let nestedOtherUsd = [];

            for (var i = 0; i < nested_other_usdElement.length; i++) {
                nestedOtherUsd.push(nested_other_usdElement[i].value);
            }
            console.log("Nested Other Usd" + nestedOtherUsd);





            

            let resultAllArrayPhp = [];

            const length = valuesTourCostPhp.length;

            // Dito naman is ipag aadd nya yung bawat cost ng isang passenger
            for (let i = 0; i < length; i++) {
                let sum = parseFloat(valuesTourCostPhp[i]) + parseFloat(valuesTaxesPhp[i]) + parseFloat(valuesTipFundPhp[i]) + parseFloat(valuesTravelInsurancePhp[i]) + parseFloat(valuesVisaFeePhp[i]) + parseFloat(valuesOtherPhp[i]);
                resultAllArrayPhp.push(sum);
            }

            

            console.log("Result All Array " + resultAllArrayPhp);

            let resultAddNestedSubTotalArray = []

            for (var i = 0; i < select1_total_phpElement.length; i++) {
                let sumNestedSubTotal = parseFloat(resultAllArrayPhp[i]) + parseFloat(nestedVisaFeeUsd[i]) + parseFloat(nestedOtherUsd[i]);
                resultAddNestedSubTotalArray.push(sumNestedSubTotal)
                // select1_total_phpElement[i].value = sumNestedSubTotal[i] || ''; // Use an empty string if the array is shorter than the number of input elements
            }

            // Dito is mag aassign or display ng value dun sa total usd ng bawat passenger
            for (var i = 0; i < select1_total_phpElement.length; i++) {
                select1_total_phpElement[i].value = resultAddNestedSubTotalArray[i] || ''; 
            }

            console.log("Result All Array Nested and Sub Total" + resultAddNestedSubTotalArray);

            let sa_acr = document.getElementById('sa_acr').value;

            let sumofAllSubTotal = resultAddNestedSubTotalArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
            let subTotalUsdAcrCalc = sumofAllSubTotal * sa_acr;
            sub_total_usd.value = sumofAllSubTotal;

            total_of_sub_total.value = parseFloat(subTotalUsdAcrCalc) + parseFloat(sub_total_php);
            total_amount.value = parseFloat(sub_total_usd.value) + parseFloat(sub_total_php);
            addDeposit()
            
            
            // Yung NESTED SUB TOTAL PHP naman ang icacalculate natin 
    }

    function subtotalselectPhp(){
            var tourcost1_usdElement = document.querySelectorAll('.tourcost1_php');
            var taxes1_usdElement = document.querySelectorAll('.taxes1_php');
            var tip_fund1_usdElement = document.querySelectorAll('.tip_fund1_php');
            var travel_insurance1_usdElement = document.querySelectorAll('.travel_insurance1_php');
            var visa_fee1_usdElement = document.querySelectorAll('.visa_fee1_php');
            var other1_usdElement = document.querySelectorAll('.other1_php');

            var nested_2_visa_fee_phpElement = document.querySelectorAll('.nested_2_visa_fee_php');
            
            var select1_total_phpElement = document.querySelectorAll('.select1_total_php');
            var sub_total_usd = document.querySelector('.sub_total_usd').value;
            var sub_total_php = document.querySelector('.sub_total_php'); 
            var total_of_sub_total = document.querySelector('.total_of_sub_total'); 
            var total_amount = document.querySelector('.total_amount');

            
            
            // Create an array to store the values
            var valuesTourCostUsd = [];
            var valuesTaxesUsd = [];
            var valuesTipFundUsd = [];
            var valuesTravelInsuranceUsd = [];
            var valuesVisaFeeUsd = [];
            var valuesOtherUsd = [];

            var valuesNested2VisaFeePhp = [];

            // Iterate through the collection and push the values to the array
            for (var i = 0; i < tourcost1_usdElement.length; i++) {
                valuesTourCostUsd.push(tourcost1_usdElement[i].value);
            }

            for (var i = 0; i < taxes1_usdElement.length; i++) {
                valuesTaxesUsd.push(taxes1_usdElement[i].value);
            }

            for (var i = 0; i < tip_fund1_usdElement.length; i++) {
                valuesTipFundUsd.push(tip_fund1_usdElement[i].value);
            }

            for (var i = 0; i < travel_insurance1_usdElement.length; i++) {
                valuesTravelInsuranceUsd.push(travel_insurance1_usdElement[i].value);
            }

            for (var i = 0; i < visa_fee1_usdElement.length; i++) {
                valuesVisaFeeUsd.push(visa_fee1_usdElement[i].value);
            }

            var nested_visa_sub_phpElement = document.querySelectorAll('.nested_visa_sub_php');

            let nestedVisaFeePhp = [];

            for (var i = 0; i < nested_visa_sub_phpElement.length; i++) {
                nestedVisaFeePhp.push(nested_visa_sub_phpElement[i].value);
            }
            console.log("Nested Visa Fee Php" + nestedVisaFeePhp);


            for (var i = 0; i < other1_usdElement.length; i++) {
                valuesOtherUsd.push(other1_usdElement[i].value);
            }


            var nested_other_phpElement = document.querySelectorAll('.nested_other_php');

            let nestedOtherPhp = [];

            for (var i = 0; i < nested_other_phpElement.length; i++) {
                nestedOtherPhp.push(nested_other_phpElement[i].value);
            }
            console.log("Nested Other Php" + nestedOtherPhp);


            let resultAllArrayUsd = [];

            const length = valuesTourCostUsd.length;

            // Dito naman is ipag aadd nya yung bawat cost ng isang passenger
            for (let i = 0; i < length; i++) {
                let sum = parseFloat(valuesTourCostUsd[i]) + parseFloat(valuesTaxesUsd[i]) + parseFloat(valuesTipFundUsd[i]) + parseFloat(valuesTravelInsuranceUsd[i]) + parseFloat(valuesVisaFeeUsd[i]) + parseFloat(valuesOtherUsd[i]);
                resultAllArrayUsd.push(sum);
            }

            let resultAddNestedPhpSubTotalArray = []

            for (var i = 0; i < select1_total_phpElement.length; i++) {
                let sumNestedSubTotalPhp = parseFloat(resultAllArrayUsd[i]) + parseFloat(nestedVisaFeePhp[i]) + parseFloat(nestedOtherPhp[i]);
                resultAddNestedPhpSubTotalArray.push(sumNestedSubTotalPhp)
                // select1_total_phpElement[i].value = sumNestedSubTotal[i] || ''; // Use an empty string if the array is shorter than the number of input elements
            }

            // Dito is mag aassign or display ng value dun sa total usd ng bawat passenger
            // for (var i = 0; i < select1_total_usdElement.length; i++) {
            //     select1_total_usdElement[i].value = resultAllArrayUsd[i] || ''; // Use an empty string if the array is shorter than the number of input elements
            // }

            for (var i = 0; i < select1_total_phpElement.length; i++) {
                select1_total_phpElement[i].value = resultAddNestedPhpSubTotalArray[i] || ''; 
            }

            console.log("Result All Array Nested and Sub Total Php" + resultAddNestedPhpSubTotalArray);

            let sumofAllSubTotalPhp = resultAddNestedPhpSubTotalArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
            sub_total_php.value = sumofAllSubTotalPhp;

            total_of_sub_total.value = parseFloat(sub_total_php.value) + parseFloat(sub_total_usd);
            total_amount.value = parseFloat(sub_total_php.value) + parseFloat(sub_total_usd);

            console.log(resultAllArrayUsd);
            addDeposit()
            
    }

    function select1(){

        let tourcost1_usd = document.querySelectorAll('.tourcost1_usd');
        let taxes1_usd = document.querySelectorAll('.taxes1_usd');
        let tip_fund1_usd = document.querySelectorAll('.tip_fund1_usd');
        let travel_insurance1_usd = document.querySelectorAll('.travel_insurance1_usd');
        let visa_fee1_usd = document.querySelectorAll('.visa_fee1_usd');
        let other1_usd = document.querySelectorAll('.other1_usd');

        //TOURCOST
        var tourcost1_usd_values = [].map.call(tourcost1_usd, function(e) {
            
            return parseFloat(e.value);
        });

        var tourcost1_usdTotalValues = tourcost1_usd_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log("Tour Cost  " + tourcost1_usdTotalValues)

        //TAXES
        var taxes1_usd_values = [].map.call(taxes1_usd, function(e) {
            
            return parseFloat(e.value);
        });

        var taxes1_usdTotalValues = taxes1_usd_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log("Taxes " + taxes1_usdTotalValues)


        //TIP FUND
        var tip_fund1_usd_values = [].map.call(tip_fund1_usd, function(e) {
            
            return parseFloat(e.value);
        });

        var tip_fund1_usdTotalValues = tip_fund1_usd_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log("Tip Fund " + tip_fund1_usdTotalValues)



        //TRAVEL INSURANCE
        var travel_insurance1_usd_values = [].map.call(travel_insurance1_usd, function(e) {
            
            return parseFloat(e.value);
        });

        var travel_insurance1_usdTotalValues = travel_insurance1_usd_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log("Travel Insurance" + travel_insurance1_usdTotalValues)

        //VISA FEE
        var visa_fee1_usd_values = [].map.call(visa_fee1_usd, function(e) {
            
            return parseFloat(e.value);
        });

        var visa_fee1_usdTotalValues = visa_fee1_usd_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log("Visa Fee" + visa_fee1_usdTotalValues)

        //OTHER
        var other1_usd_values = [].map.call(other1_usd, function(e) {
            
            return parseFloat(e.value);
        });

        var other1_usdTotalValues = other1_usd_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log("Other" + other1_usdTotalValues)


        // let sub_total_usdDisplay = document.querySelector('.sub_total_usd');
        // let total_of_sub_totalUsdDisplay = document.querySelector('.total_of_sub_total');
        // let total_amountUsdDisplay = document.querySelector('.total_amount');

        // let subTotalPhpCalculate = parseFloat(tourcost1_usdTotalValues) + parseFloat(taxes1_usdTotalValues) + parseFloat(tip_fund1_usdTotalValues) + parseFloat(travel_insurance1_usdTotalValues) + parseFloat(visa_fee1_usdTotalValues) + parseFloat(other1_usdTotalValues);
        
        // sub_total_usdDisplay.value = subTotalPhpCalculate;
        // total_of_sub_totalUsdDisplay.value = subTotalPhpCalculate;
        // total_amountUsdDisplay.value = subTotalPhpCalculate;

        let sub_total_usdDisplay = document.querySelector('.sub_total_usd'); 
        let sa_acr = document.getElementById('sa_acr').value;

        let sub_total_phpDisplay = document.querySelector('.sub_total_php').value;
        let total_of_sub_totalDisplay = document.querySelector('.total_of_sub_total');
        let total_amountDisplay = document.querySelector('.total_amount');

        let subTotalUsdCalculate = parseFloat(tourcost1_usdTotalValues) + parseFloat(taxes1_usdTotalValues) + parseFloat(tip_fund1_usdTotalValues) + parseFloat(travel_insurance1_usdTotalValues) + parseFloat(visa_fee1_usdTotalValues) + parseFloat(other1_usdTotalValues);
        let subTotalUsdAcrCalc = subTotalUsdCalculate * sa_acr;
        sub_total_usdDisplay.value = subTotalUsdAcrCalc;
        
        total_of_sub_totalDisplay.value = parseFloat(subTotalUsdAcrCalc) + parseFloat(sub_total_phpDisplay);
        total_amountDisplay.value = total_of_sub_totalDisplay.value;

        console.log("Sub Total PHP2 Display: " + sub_total_phpDisplay)
        console.log("Sub Total USD2 Display: " + sub_total_usdDisplay.value)
        console.log("Total Amount Display: " + total_amountDisplay.value)

        subtotalselectUsd()
        

        // ihahide yung mga total usd and php per passenger


        
        
        
    }

    function selectphp1(){
        
        let tourcost1_php = document.querySelectorAll('.tourcost1_php');
        let taxes1_php = document.querySelectorAll('.taxes1_php');
        let tip_fund1_php = document.querySelectorAll('.tip_fund1_php');
        let travel_insurance1_php = document.querySelectorAll('.travel_insurance1_php');
        let visa_fee1_php = document.querySelectorAll('.visa_fee1_php');
        let other1_php = document.querySelectorAll('.other1_php');

        //TOURCOST
        var tourcost1_php_values = [].map.call(tourcost1_php, function(e) {
            
            return parseFloat(e.value);
        });

        var tourcost1_phpTotalValues = tourcost1_php_values.reduce((a, b) => parseFloat(a) + parseFloat(b));

        // console.log(tourcost1_phpTotalValues);

        //TAXES
        var taxes1_php_values = [].map.call(taxes1_php, function(e) {
            
            return parseFloat(e.value);
        });

        var taxes1_phpTotalValues = taxes1_php_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        // console.log(taxes1_phpTotalValues)


        //TIP FUND
        var tip_fund1_php_values = [].map.call(tip_fund1_php, function(e) {
            
            return parseFloat(e.value);
        });

        var tip_fund1_phpTotalValues = tip_fund1_php_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        // console.log(tip_fund1_phpTotalValues)



        //TRAVEL INSURANCE
        var travel_insurance1_php_values = [].map.call(travel_insurance1_php, function(e) {
            
            return parseFloat(e.value);
        });

        var travel_insurance1_phpTotalValues = travel_insurance1_php_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        // console.log(travel_insurance1_phpTotalValues)

        //VISA FEE
        var visa_fee1_php_values = [].map.call(visa_fee1_php, function(e) {
            
            return parseFloat(e.value);
        });

        var visa_fee1_phpTotalValues = visa_fee1_php_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        // console.log(visa_fee1_phpTotalValues)

        //OTHER
        var other1_php_values = [].map.call(other1_php, function(e) {
            
            return parseFloat(e.value);
        });

        var other1_phpTotalValues = other1_php_values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        // console.log(other1_phpTotalValues)


        let sub_total_phpDisplay = document.querySelector('.sub_total_php'); 
        let sub_total_usdDisplay = document.querySelector('.sub_total_usd').value;
        let total_of_sub_totalDisplay = document.querySelector('.total_of_sub_total');
        let total_amountDisplay = document.querySelector('.total_amount');

        let subTotalPhpCalculate = parseFloat(tourcost1_phpTotalValues) + parseFloat(taxes1_phpTotalValues) + parseFloat(tip_fund1_phpTotalValues) + parseFloat(travel_insurance1_phpTotalValues) + parseFloat(visa_fee1_phpTotalValues) + parseFloat(other1_phpTotalValues);
        
        sub_total_phpDisplay.value = subTotalPhpCalculate;
        
        total_of_sub_totalDisplay.value = parseFloat(subTotalPhpCalculate) + parseFloat(sub_total_usdDisplay);
        total_amountDisplay.value = subTotalPhpCalculate;

        console.log("Sub Total USD Display: " + sub_total_usdDisplay)
        console.log("Sub Total PHP Display: " + sub_total_phpDisplay.value)
        console.log("Total Amount Display: " + total_of_sub_totalDisplay.value)

        subtotalselectPhp()

        
    }

     // OTHER TAB START

    // icacalculate na natin yung other parent and other nested

    function nested1OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent1_other_usd = document.querySelector('.Parent1_other_usd').value; 
        let nested1_other_subtotal_usd = document.querySelector('.nested1_other_subtotal_usd');
        // NESTED 1
        var nested_1_other_usdElement = document.querySelectorAll('.nested_1_other_usd');
        var valuesNested1OtherPhp = [];
        let nested1OtherSum = 0 

        for (var i = 0; i < nested_1_other_usdElement.length; i++) {
            
            valuesNested1OtherPhp.push(nested_1_other_usdElement[i].value);
            nested1OtherSum += parseFloat(nested_1_other_usdElement[i].value);
            
        }

        nested_1_other_usdElement.forEach(function(nested_1_other_usdElement_item, index) {
        
            nested_1_other_usdElement_item.addEventListener("change", (event) => {
            if(nested_1_other_usdElement_item.value == ""){
                nested_1_other_usdElement_item.value = 0;
                nested1OtherUsdCal()
            }
            else{

            }
            });
        });

        valuesNested1OtherPhp = valuesNested1OtherPhp.map(item => (item == "" ? 0 : item));

        nested1_other_subtotal_usd.value = nested1OtherSum

        
        subtotalselectUsd()
        
    }

    function nested1OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent1_other_php = document.querySelector('.Parent1_other_php').value; 
        let nested1_other_subtotal_php = document.querySelector('.nested1_other_subtotal_php');
        // NESTED 1
        var nested_1_other_phpElement = document.querySelectorAll('.nested_1_other_php');
        var valuesNested1OtherPhp = [];
        let nested1OtherSum = 0 

        for (var i = 0; i < nested_1_other_phpElement.length; i++) {
            
            valuesNested1OtherPhp.push(nested_1_other_phpElement[i].value);
            nested1OtherSum += parseFloat(nested_1_other_phpElement[i].value);
            
        }

        nested_1_other_phpElement.forEach(function(nested_1_other_phpElement_item, index) {
        
            nested_1_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_1_other_phpElement_item.value == ""){
            nested_1_other_phpElement_item.value = 0;
            nested1OtherPhpCal()
        }
        else{

        }
        });
        });

        valuesNested1OtherPhp = valuesNested1OtherPhp.map(item => (item == "" ? 0 : item));

        nested1_other_subtotal_php.value = nested1OtherSum

        
        subtotalselectPhp()
        
    }

    $("#addOtherTab1").on("click", function(e) {

        e.preventDefault();

        console.log("Napindot si addothertab1")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[1][]" oninput="" id="nested_1_other_name" class="nested_1_other_name   form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn1">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther1">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[1][]" oninput="nested1OtherUsdCal()" id="nested_1_other_usd" class="nested_1_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[1][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[1][]" oninput="nested1OtherPhpCal();" id="nested_1_other_php" class="nested_1_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab1").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        })

        // REMOVE NESTED OTHER 1 START
        
        $(document).on('click', '#removeNestedOtherBtn1', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther1');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested1OtherUsdCal()
                nested1OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 1 END


        function nested2OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent2_other_usd = document.querySelector('.Parent2_other_usd').value; 
        let nested2_other_subtotal_usd = document.querySelector('.nested2_other_subtotal_usd');
        // NESTED 1
        var nested_2_other_usdElement = document.querySelectorAll('.nested_2_other_usd');
        var valuesNested2OtherPhp = [];
        let nested2OtherSum = 0 

        for (var i = 0; i < nested_2_other_usdElement.length; i++) {
            
            valuesNested2OtherPhp.push(nested_2_other_usdElement[i].value);
            nested2OtherSum += parseFloat(nested_2_other_usdElement[i].value);
            
        }

        nested_2_other_usdElement.forEach(function(nested_2_other_usdElement_item, index) {
        
            nested_2_other_usdElement_item.addEventListener("change", (event) => {
            if(nested_2_other_usdElement_item.value == ""){
                nested_2_other_usdElement_item.value = 0;
                nested2OtherUsdCal()
            }
            else{

            }
            });
        });

        valuesNested2OtherPhp = valuesNested2OtherPhp.map(item => (item == "" ? 0 : item));

        nested2_other_subtotal_usd.value = nested2OtherSum

        
        subtotalselectUsd()
        
        }

        function nested2OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent2_other_php = document.querySelector('.Parent2_other_php').value; 
        let nested2_other_subtotal_php = document.querySelector('.nested2_other_subtotal_php');
        // NESTED 1
        var nested_2_other_phpElement = document.querySelectorAll('.nested_2_other_php');
        var valuesNested2OtherPhp = [];
        let nested2OtherSum = 0 

        for (var i = 0; i < nested_2_other_phpElement.length; i++) {
            
            valuesNested2OtherPhp.push(nested_2_other_phpElement[i].value);
            nested2OtherSum += parseFloat(nested_2_other_phpElement[i].value);
            
        }

        nested_2_other_phpElement.forEach(function(nested_2_other_phpElement_item, index) {
        
            nested_2_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_2_other_phpElement_item.value == ""){
            nested_2_other_phpElement_item.value = 0;
            nested2OtherPhpCal()
        }
        else{

        }
        });
        });

        valuesNested2OtherPhp = valuesNested2OtherPhp.map(item => (item == "" ? 0 : item));

        nested2_other_subtotal_php.value = nested2OtherSum

        
        subtotalselectPhp()
        
    }


        function addOther2(){

        console.log("Napindot si addothertab2")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[2][]" oninput="" id="nested_2_other_name" class="nested_2_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn2">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther2">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[2][]" oninput="nested2OtherUsdCal()" id="nested_2_other_usd" class="nested_2_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[2][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[2][]" oninput="nested2OtherPhpCal()" id="nested_2_other_php" class="nested_2_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab2").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 2 START
        
        $(document).on('click', '#removeNestedOtherBtn2', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther2');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested2OtherUsdCal()
                nested2OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 2 END


        function nested3OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent3_other_usd = document.querySelector('.Parent3_other_usd').value; 
        let nested3_other_subtotal_usd = document.querySelector('.nested3_other_subtotal_usd');
        // NESTED 1
        var nested_3_other_usdElement = document.querySelectorAll('.nested_3_other_usd');
        var valuesNested3OtherPhp = [];
        let nested3OtherSum = 0 

        for (var i = 0; i < nested_3_other_usdElement.length; i++) {
            
            valuesNested3OtherPhp.push(nested_3_other_usdElement[i].value);
            nested3OtherSum += parseFloat(nested_3_other_usdElement[i].value);
            
        }

        nested_3_other_usdElement.forEach(function(nested_3_other_usdElement_item, index) {
        
            nested_3_other_usdElement_item.addEventListener("change", (event) => {
        if(nested_3_other_usdElement_item.value == ""){
            nested_3_other_usdElement_item.value = 0;
            nested3OtherUsdCal()
        }
        else{

        }
        });
    });

    valuesNested3OtherPhp = valuesNested3OtherPhp.map(item => (item == "" ? 0 : item));

        nested3_other_subtotal_usd.value = nested3OtherSum

        
        subtotalselectUsd()
        
        }

        function nested3OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent3_other_php = document.querySelector('.Parent3_other_php').value; 
        let nested3_other_subtotal_php = document.querySelector('.nested3_other_subtotal_php');
        // NESTED 1
        var nested_3_other_phpElement = document.querySelectorAll('.nested_3_other_php');
        var valuesNested3OtherPhp = [];
        let nested3OtherSum = 0 

        for (var i = 0; i < nested_3_other_phpElement.length; i++) {
            
            valuesNested3OtherPhp.push(nested_3_other_phpElement[i].value);
            nested3OtherSum += parseFloat(nested_3_other_phpElement[i].value);
            
        }

        nested_3_other_phpElement.forEach(function(nested_3_other_phpElement_item, index) {
        
            nested_3_other_phpElement_item.addEventListener("change", (event) => {
            if(nested_3_other_phpElement_item.value == ""){
                nested_3_other_phpElement_item.value = 0;
                nested3OtherPhpCal()
            }
            else{

            }
            });
        });

        valuesNested3OtherPhp = valuesNested3OtherPhp.map(item => (item == "" ? 0 : item));

        nested3_other_subtotal_php.value = nested3OtherSum

        
        subtotalselectPhp()
        
        }

        function addOther3(){

        console.log("Napindot si addothertab3")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-12 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[3][]" oninput="" id="nested_3_other_name" class="nested_3_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn3">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther3">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[3][]" oninput="nested3OtherUsdCal()" id="nested_3_other_usd" class="nested_3_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[3][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[3][]" oninput="nested3OtherPhpCal()" id="nested_3_other_php" class="nested_3_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab3").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 3 START
        
        $(document).on('click', '#removeNestedOtherBtn3', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther3');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested3OtherUsdCal()
                nested3OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 3 END


        function nested4OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent4_other_usd = document.querySelector('.Parent4_other_usd').value; 
        let nested4_other_subtotal_usd = document.querySelector('.nested4_other_subtotal_usd');
        // NESTED 1
        var nested_4_other_usdElement = document.querySelectorAll('.nested_4_other_usd');
        var valuesNested4OtherPhp = [];
        let nested4OtherSum = 0 

        for (var i = 0; i < nested_4_other_usdElement.length; i++) {
            
            valuesNested4OtherPhp.push(nested_4_other_usdElement[i].value);
            nested4OtherSum += parseFloat(nested_4_other_usdElement[i].value);
            
        }

        nested_4_other_usdElement.forEach(function(nested_4_other_usdElement_item, index) {
        
            nested_4_other_usdElement_item.addEventListener("change", (event) => {
            if(nested_4_other_usdElement_item.value == ""){
                nested_4_other_usdElement_item.value = 0;
                nested4OtherUsdCal()
            }
            else{

            }
            });
        });

        valuesNested4OtherPhp = valuesNested4OtherPhp.map(item => (item == "" ? 0 : item));

        nested4_other_subtotal_usd.value = nested4OtherSum

        
        subtotalselectUsd()
        
        }

        function nested4OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent4_other_php = document.querySelector('.Parent4_other_php').value; 
        let nested4_other_subtotal_php = document.querySelector('.nested4_other_subtotal_php');
        // NESTED 1
        var nested_4_other_phpElement = document.querySelectorAll('.nested_4_other_php');
        var valuesNested4OtherPhp = [];
        let nested4OtherSum = 0 

        for (var i = 0; i < nested_4_other_phpElement.length; i++) {
            
            valuesNested4OtherPhp.push(nested_4_other_phpElement[i].value);
            nested4OtherSum += parseFloat(nested_4_other_phpElement[i].value);
            
        }

        nested_4_other_phpElement.forEach(function(nested_4_other_phpElement_item, index) {
        
            nested_4_other_phpElement_item.addEventListener("change", (event) => {
            if(nested_4_other_phpElement_item.value == ""){
                nested_4_other_phpElement_item.value = 0;
                nested4OtherPhpCal()
            }
            else{

            }
            });
        });

        valuesNested4OtherPhp = valuesNested4OtherPhp.map(item => (item == "" ? 0 : item));

        nested4_other_subtotal_php.value = nested4OtherSum

        
        subtotalselectPhp()
        
        }

        function addOther4(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[4][]" oninput="" id="nested_4_other_name" class="nested_4_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn4">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[4][]" oninput="nested4OtherUsdCal()" id="nested_4_other_usd" class="nested_4_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[4][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[4][]" oninput="nested4OtherPhpCal()" id="nested_4_other_php" class="nested_4_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab4").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 4 START
        
        $(document).on('click', '#removeNestedOtherBtn4', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther4');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested4OtherUsdCal()
                nested4OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 4 END

        function nested5OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent5_other_usd = document.querySelector('.Parent5_other_usd').value; 
        let nested5_other_subtotal_usd = document.querySelector('.nested5_other_subtotal_usd');
        // NESTED 1
        var nested_5_other_usdElement = document.querySelectorAll('.nested_5_other_usd');
        var valuesNested5OtherPhp = [];
        let nested5OtherSum = 0 

        for (var i = 0; i < nested_5_other_usdElement.length; i++) {
            
            valuesNested5OtherPhp.push(nested_5_other_usdElement[i].value);
            nested5OtherSum += parseFloat(nested_5_other_usdElement[i].value);
            
        }

        nested_5_other_usdElement.forEach(function(nested_5_other_usdElement_item, index) {
        
            nested_5_other_usdElement_item.addEventListener("change", (event) => {
        if(nested_5_other_usdElement_item.value == ""){
            nested_5_other_usdElement_item.value = 0;
            nested5OtherUsdCal()
        }
        else{

        }
        });
    });

    valuesNested5OtherPhp = valuesNested5OtherPhp.map(item => (item == "" ? 0 : item));

        nested5_other_subtotal_usd.value = nested5OtherSum

        
        subtotalselectUsd()
        
        }

        function nested5OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent5_other_php = document.querySelector('.Parent5_other_php').value; 
        let nested5_other_subtotal_php = document.querySelector('.nested5_other_subtotal_php');
        // NESTED 1
        var nested_5_other_phpElement = document.querySelectorAll('.nested_5_other_php');
        var valuesNested5OtherPhp = [];
        let nested5OtherSum = 0 

        for (var i = 0; i < nested_5_other_phpElement.length; i++) {
            
            valuesNested5OtherPhp.push(nested_5_other_phpElement[i].value);
            nested5OtherSum += parseFloat(nested_5_other_phpElement[i].value);
            
        }

        nested_5_other_phpElement.forEach(function(nested_5_other_phpElement_item, index) {
        
            nested_5_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_5_other_phpElement_item.value == ""){
            nested_5_other_phpElement_item.value = 0;
            nested5OtherPhpCal()
        }
        else{

            }
            });
        });

        valuesNested5OtherPhp = valuesNested5OtherPhp.map(item => (item == "" ? 0 : item));

        nested5_other_subtotal_php.value = nested5OtherSum

        
        subtotalselectPhp()
        
        }

        function addOther5(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[5][]" oninput="" id="nested_5_other_name" class="nested_5_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn5">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther5">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[5][]" oninput="nested5OtherUsdCal()" id="nested_5_other_usd" class="nested_5_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[5][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[5][]" oninput="nested5OtherPhpCal()" id="nested_5_other_php" class="nested_5_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab5").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 5 START
        
        $(document).on('click', '#removeNestedOtherBtn5', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther5');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested5OtherUsdCal()
                nested5OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 5 END


        function nested6OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent6_other_usd = document.querySelector('.Parent6_other_usd').value; 
        let nested6_other_subtotal_usd = document.querySelector('.nested6_other_subtotal_usd');
        // NESTED 1
        var nested_6_other_usdElement = document.querySelectorAll('.nested_6_other_usd');
        var valuesNested6OtherPhp = [];
        let nested6OtherSum = 0 

        for (var i = 0; i < nested_6_other_usdElement.length; i++) {
            
            valuesNested6OtherPhp.push(nested_6_other_usdElement[i].value);
            nested6OtherSum += parseFloat(nested_6_other_usdElement[i].value);
            
        }


        nested_6_other_usdElement.forEach(function(nested_6_other_usdElement_item, index) {
        
            nested_6_other_usdElement_item.addEventListener("change", (event) => {
    if(nested_6_other_usdElement_item.value == ""){
        nested_6_other_usdElement_item.value = 0;
        nested6OtherUsdCal()
    }
    else{

    }
    });
});

valuesNested6OtherPhp = valuesNested6OtherPhp.map(item => (item == "" ? 0 : item));

        nested6_other_subtotal_usd.value = nested6OtherSum

        
        subtotalselectUsd()
        
        }

        function nested6OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent6_other_php = document.querySelector('.Parent6_other_php').value; 
        let nested6_other_subtotal_php = document.querySelector('.nested6_other_subtotal_php');
        // NESTED 1
        var nested_6_other_phpElement = document.querySelectorAll('.nested_6_other_php');
        var valuesNested6OtherPhp = [];
        let nested6OtherSum = 0 

        for (var i = 0; i < nested_6_other_phpElement.length; i++) {
            
            valuesNested6OtherPhp.push(nested_6_other_phpElement[i].value);
            nested6OtherSum += parseFloat(nested_6_other_phpElement[i].value);
            
        }

        nested_6_other_phpElement.forEach(function(nested_6_other_phpElement_item, index) {
        
            nested_6_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_6_other_phpElement_item.value == ""){
            nested_6_other_phpElement_item.value = 0;
            nested6OtherPhpCal()
        }
        else{

            }
            });
        });

        valuesNested6OtherPhp = valuesNested6OtherPhp.map(item => (item == "" ? 0 : item));

        

        nested6_other_subtotal_php.value = nested6OtherSum

        
        subtotalselectPhp()
        
        }

        function addOther6(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[6][]" oninput="" id="nested_6_other_name" class="nested_6_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn6">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther6">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[6][]" oninput="nested6OtherUsdCal()" id="nested_6_other_usd" class="nested_6_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[6][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[6][]" oninput="nested6OtherPhpCal()" id="nested_6_other_php" class="nested_6_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab6").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 6 START
        
        $(document).on('click', '#removeNestedOtherBtn6', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther6');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested6OtherUsdCal()
                nested6OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 6 END


        function nested7OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent7_other_usd = document.querySelector('.Parent7_other_usd').value; 
        let nested7_other_subtotal_usd = document.querySelector('.nested7_other_subtotal_usd');
        // NESTED 1
        var nested_7_other_usdElement = document.querySelectorAll('.nested_7_other_usd');
        var valuesNested7OtherPhp = [];
        let nested7OtherSum = 0 

        for (var i = 0; i < nested_7_other_usdElement.length; i++) {
            
            valuesNested7OtherPhp.push(nested_7_other_usdElement[i].value);
            nested7OtherSum += parseFloat(nested_7_other_usdElement[i].value);
            
        }

        nested_7_other_usdElement.forEach(function(nested_7_other_usdElement_item, index) {
        
            nested_7_other_usdElement_item.addEventListener("change", (event) => {
            if(nested_7_other_usdElement_item.value == ""){
                nested_7_other_usdElement_item.value = 0;
                nested7OtherUsdCal()
            }
            else{

            }
            });
            });

            valuesNested7OtherPhp = valuesNested7OtherPhp.map(item => (item == "" ? 0 : item));

        nested7_other_subtotal_usd.value = nested7OtherSum

        
        subtotalselectUsd()
        
        }

        function nested7OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent7_other_php = document.querySelector('.Parent7_other_php').value; 
        let nested7_other_subtotal_php = document.querySelector('.nested7_other_subtotal_php');
        // NESTED 1
        var nested_7_other_phpElement = document.querySelectorAll('.nested_7_other_php');
        var valuesNested7OtherPhp = [];
        let nested7OtherSum = 0 

        for (var i = 0; i < nested_7_other_phpElement.length; i++) {
            
            valuesNested7OtherPhp.push(nested_7_other_phpElement[i].value);
            nested7OtherSum += parseFloat(nested_7_other_phpElement[i].value);
            
        }

        nested_7_other_phpElement.forEach(function(nested_7_other_phpElement_item, index) {
        
            nested_7_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_7_other_phpElement_item.value == ""){
            nested_7_other_phpElement_item.value = 0;
            nested7OtherPhpCal()
        }
        else{

            }
            });
        });

        valuesNested7OtherPhp = valuesNested7OtherPhp.map(item => (item == "" ? 0 : item));

        nested7_other_subtotal_php.value = nested7OtherSum

        
        subtotalselectPhp()
        
        }


        function addOther7(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[7][]" oninput="" id="nested_7_other_name" class="nested_7_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn7">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther7">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[7][]" oninput="nested7OtherUsdCal()" id="nested_7_other_usd" class="nested_7_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[7][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[7][]" oninput="nested7OtherPhpCal()" id="nested_7_other_php" class="nested_7_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab7").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 7 START
        
        $(document).on('click', '#removeNestedOtherBtn7', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther7');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested7OtherUsdCal()
                nested7OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 7 END

        

        function nested8OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent8_other_usd = document.querySelector('.Parent8_other_usd').value; 
        let nested8_other_subtotal_usd = document.querySelector('.nested8_other_subtotal_usd');
        // NESTED 1
        var nested_8_other_usdElement = document.querySelectorAll('.nested_8_other_usd');
        var valuesNested8OtherPhp = [];
        let nested8OtherSum = 0 

        for (var i = 0; i < nested_8_other_usdElement.length; i++) {
            
            valuesNested8OtherPhp.push(nested_8_other_usdElement[i].value);
            nested8OtherSum += parseFloat(nested_8_other_usdElement[i].value);
            
        }

        nested_8_other_usdElement.forEach(function(nested_8_other_usdElement_item, index) {
        
            nested_8_other_usdElement_item.addEventListener("change", (event) => {
        if(nested_8_other_usdElement_item.value == ""){
            nested_8_other_usdElement_item.value = 0;
            nested8OtherUsdCal()
        }
        else{

        }
        });
        });

        valuesNested8OtherPhp = valuesNested8OtherPhp.map(item => (item == "" ? 0 : item));

        nested8_other_subtotal_usd.value = nested8OtherSum

        
        subtotalselectUsd()
        
        }

        function nested8OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent8_other_php = document.querySelector('.Parent8_other_php').value; 
        let nested8_other_subtotal_php = document.querySelector('.nested8_other_subtotal_php');
        // NESTED 1
        var nested_8_other_phpElement = document.querySelectorAll('.nested_8_other_php');
        var valuesNested8OtherPhp = [];
        let nested8OtherSum = 0 

        for (var i = 0; i < nested_8_other_phpElement.length; i++) {
            
            valuesNested8OtherPhp.push(nested_8_other_phpElement[i].value);
            nested8OtherSum += parseFloat(nested_8_other_phpElement[i].value);
            
        }

        nested_8_other_phpElement.forEach(function(nested_8_other_phpElement_item, index) {
        
            nested_8_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_8_other_phpElement_item.value == ""){
            nested_8_other_phpElement_item.value = 0;
            nested8OtherPhpCal()
        }
        else{

            }
            });
        });

        valuesNested8OtherPhp = valuesNested8OtherPhp.map(item => (item == "" ? 0 : item));

        nested8_other_subtotal_php.value = nested8OtherSum

        
        subtotalselectPhp()
        
        }

        function addOther8(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[8][]" oninput="" id="nested_8_other_name" class="nested_8_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn8">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther8">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[8][]" oninput="nested8OtherUsdCal()" id="nested_8_other_usd" class="nested_8_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[8][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[8][]" oninput="nested8OtherPhpCal()" id="nested_8_other_php" class="nested_8_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab8").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }


        // REMOVE NESTED OTHER 8 START
        
        $(document).on('click', '#removeNestedOtherBtn8', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther8');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested8OtherUsdCal()
                nested8OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 8 END


        function nested9OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent9_other_usd = document.querySelector('.Parent9_other_usd').value; 
        let nested9_other_subtotal_usd = document.querySelector('.nested9_other_subtotal_usd');
        // NESTED 1
        var nested_9_other_usdElement = document.querySelectorAll('.nested_9_other_usd');
        var valuesNested9OtherPhp = [];
        let nested9OtherSum = 0 

        for (var i = 0; i < nested_9_other_usdElement.length; i++) {
            
            valuesNested9OtherPhp.push(nested_9_other_usdElement[i].value);
            nested9OtherSum += parseFloat(nested_9_other_usdElement[i].value);
            
        }

        nested_9_other_usdElement.forEach(function(nested_9_other_usdElement_item, index) {
        
            nested_9_other_usdElement_item.addEventListener("change", (event) => {
        if(nested_9_other_usdElement_item.value == ""){
            nested_9_other_usdElement_item.value = 0;
            nested9OtherUsdCal()
        }
        else{

        }
        });
        });

        valuesNested9OtherPhp = valuesNested9OtherPhp.map(item => (item == "" ? 0 : item));

        nested9_other_subtotal_usd.value = nested9OtherSum

        
        subtotalselectUsd()
        
        }


        function nested9OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent9_other_php = document.querySelector('.Parent9_other_php').value; 
        let nested9_other_subtotal_php = document.querySelector('.nested9_other_subtotal_php');
        // NESTED 1
        var nested_9_other_phpElement = document.querySelectorAll('.nested_9_other_php');
        var valuesNested9OtherPhp = [];
        let nested9OtherSum = 0 

        for (var i = 0; i < nested_9_other_phpElement.length; i++) {
            
            valuesNested9OtherPhp.push(nested_9_other_phpElement[i].value);
            nested9OtherSum += parseFloat(nested_9_other_phpElement[i].value);
            
        }

        nested_9_other_phpElement.forEach(function(nested_9_other_phpElement_item, index) {
        
            nested_9_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_9_other_phpElement_item.value == ""){
            nested_9_other_phpElement_item.value = 0;
            nested9OtherPhpCal()
        }
        else{

            }
            });
        });

        valuesNested9OtherPhp = valuesNested9OtherPhp.map(item => (item == "" ? 0 : item));

        

        nested9_other_subtotal_php.value = nested9OtherSum

        
        subtotalselectPhp()
        
        }


        function addOther9(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[9][]" oninput="" id="nested_9_other_name" class="nested_9_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn9">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther9">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[9][]" oninput="nested9OtherUsdCal()" id="nested_9_other_usd" class="nested_9_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[9][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[9][]" oninput="nested9OtherPhpCal()" id="nested_9_other_php" class="nested_9_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab9").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 9 START
        
        $(document).on('click', '#removeNestedOtherBtn9', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther9');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested9OtherUsdCal()
                nested9OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 9 END


        function nested10OtherUsdCal(){
        // console.log("nested1VisaFeeCal")
        let Parent10_other_usd = document.querySelector('.Parent10_other_usd').value; 
        let nested10_other_subtotal_usd = document.querySelector('.nested10_other_subtotal_usd');
        // NESTED 1
        var nested_10_other_usdElement = document.querySelectorAll('.nested_10_other_usd');
        var valuesNested10OtherPhp = [];
        let nested10OtherSum = 0 

        for (var i = 0; i < nested_10_other_usdElement.length; i++) {
            
            valuesNested10OtherPhp.push(nested_10_other_usdElement[i].value);
            nested10OtherSum += parseFloat(nested_10_other_usdElement[i].value);
            
        }

        nested_10_other_usdElement.forEach(function(nested_10_other_usdElement_item, index) {
        
            nested_10_other_usdElement_item.addEventListener("change", (event) => {
        if(nested_10_other_usdElement_item.value == ""){
            nested_10_other_usdElement_item.value = 0;
            nested10OtherUsdCal()
        }
        else{

        }
        });
        });

        valuesNested10OtherPhp = valuesNested10OtherPhp.map(item => (item == "" ? 0 : item));

        nested10_other_subtotal_usd.value = nested10OtherSum

        
        subtotalselectUsd()
        
        }

        function nested10OtherPhpCal(){
        // console.log("nested1VisaFeeCal")
        let Parent10_other_php = document.querySelector('.Parent10_other_php').value; 
        let nested10_other_subtotal_php = document.querySelector('.nested10_other_subtotal_php');
        // NESTED 1
        var nested_10_other_phpElement = document.querySelectorAll('.nested_10_other_php');
        var valuesNested10OtherPhp = [];
        let nested10OtherSum = 0 

        for (var i = 0; i < nested_10_other_phpElement.length; i++) {
            
            valuesNested10OtherPhp.push(nested_10_other_phpElement[i].value);
            nested10OtherSum += parseFloat(nested_10_other_phpElement[i].value);
            
        }

        nested_10_other_phpElement.forEach(function(nested_10_other_phpElement_item, index) {
        
            nested_10_other_phpElement_item.addEventListener("change", (event) => {
        if(nested_10_other_phpElement_item.value == ""){
            nested_10_other_phpElement_item.value = 0;
            nested10OtherPhpCal()
        }
        else{

            }
            });
        });

        valuesNested10OtherPhp = valuesNested10OtherPhp.map(item => (item == "" ? 0 : item));

        

        nested10_other_subtotal_php.value = nested10OtherSum

        
        subtotalselectPhp()
        
        }


        function addOther10(){

        console.log("Napindot si addothertab4")

        Othercols = ""
        Othercols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        Othercols += '<div class="row pr-3 mt-3">'
        Othercols += '    <div class="col-md-9 ">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER NAME:</label>'
        Othercols += '        <input type="text" name="edit_nested_other_name[10][]" oninput="" id="nested_10_other_name" class="nested_10_other_name form-control form-control-sm pr-3" value="N/A" required>'
        Othercols += '    </div>'
        Othercols += '    <div class="col-md-3">'
        Othercols += '        <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger mr-1">*</span>OTHER:</label>'
        Othercols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedOtherBtn10">'
        Othercols += '    </div>'
        Othercols += '</div>'

        Othercols += '<div class="row mt-3">'
        Othercols += '    <div class="col-md-4" id="remove-container-nestedOther10">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_usd[10][]" oninput="nested10OtherUsdCal()" id="nested_10_other_usd" class="nested_10_other_usd nested_other_usd_readonly form-control form-control-sm" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_usdD[]" oninput="select1();" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4" style="visibility: hidden">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_arc[10][]" oninput="" id="" class=" form-control form-control-sm nested_other_arc_readonly" value="0" required>'
        Othercols += '        <input type="number" name="nested_other_arcD[]" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'

        Othercols += '    <div class="col-md-4">'
        Othercols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        Othercols += '        <input type="number" name="edit_nested_other_php[10][]" oninput="nested10OtherPhpCal()" id="nested_10_other_php" class="nested_10_other_php nested_other_php_readonly form-control form-control-sm" value="0" required>'
        Othercols += '    </div>'
        Othercols += '</div>'
        Othercols += '</div>'

        $("#netxOtherTab10").append(Othercols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()

        }

        // REMOVE NESTED OTHER 10 START
        
        $(document).on('click', '#removeNestedOtherBtn10', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('remove-container-nestedOther10');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested10OtherUsdCal()
                nested10OtherPhpCal()
                        

                
        })
    
        // REMOVE NESTED OTHER 10 END

        // Icacalculate na natin yung nested php

        // OTHER TAB CLOSED



        // VISA FEE TAB START

    function nested1VisaFeeCal(){
        // console.log("nested1VisaFeeCal")
        let Parent1_visa_fee_usd = document.querySelector('.Parent1_visa_fee_usd').value; 
        let nested1_subtotal_usd = document.querySelector('.nested1_subtotal_usd');
        // NESTED 1
        var nested_1_visa_fee_phpElement = document.querySelectorAll('.nested_1_visa_fee_usd');
        var valuesNested1VisaFeePhp = [];
        let nested1VisaFeeSum = 0 

        for (var i = 0; i < nested_1_visa_fee_phpElement.length; i++) {
            
            
            valuesNested1VisaFeePhp.push(nested_1_visa_fee_phpElement[i].value);
            nested1VisaFeeSum += parseFloat(nested_1_visa_fee_phpElement[i].value);
            
        }

        nested_1_visa_fee_phpElement.forEach(function(nested_1_visa_fee_phpElement_item, index) {
        
            nested_1_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_1_visa_fee_phpElement_item.value == ""){
                nested_1_visa_fee_phpElement_item.value = 0;
                nested1VisaFeeCal()
            }
            else{
    
            }
            });
        });

        valuesNested1VisaFeePhp = valuesNested1VisaFeePhp.map(item => (item == "" ? 0 : item));

        nested1_subtotal_usd.value = nested1VisaFeeSum

        
        subtotalselectUsd()

        

        
        
    }


    function nested1VisaFeePhpCal(){
        console.log("nested1VisaFeeUsdCal")
        let Parent1_visa_fee_php = document.querySelector('.Parent1_visa_fee_php').value; 
        let nested1_subtotal_php = document.querySelector('.nested1_subtotal_php');
        // NESTED 1
        var nested_1_visa_fee_phpElement = document.querySelectorAll('.nested_1_visa_fee_php');
        var valuesNested1VisaFeePhp = [];
        let nested1VisaFeeSum = 0 

        for (var i = 0; i < nested_1_visa_fee_phpElement.length; i++) {
            
            valuesNested1VisaFeePhp.push(nested_1_visa_fee_phpElement[i].value);
            nested1VisaFeeSum += parseFloat(nested_1_visa_fee_phpElement[i].value);
            
        }

        nested_1_visa_fee_phpElement.forEach(function(nested_1_visa_fee_phpElement_item, index) {
        
        nested_1_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_1_visa_fee_phpElement_item.value == ""){
                nested_1_visa_fee_phpElement_item.value = 0;
                nested1VisaFeePhpCal()
            }
            else{

            }
            });
        });

        valuesNested1VisaFeePhp = valuesNested1VisaFeePhp.map(item => (item == "" ? 0 : item));

        nested1_subtotal_php.value = nested1VisaFeeSum

        
        subtotalselectPhp()
    
    }

    

   
    

    $("#addVisaFeeTab1").on("click", function(e) {

        e.preventDefault();

        console.log("Napindot si addvisafeetab1")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[1][]" oninput="" id="nested_1_visa_fee_name" class="nested_1_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn1">'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove1">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[1][]" oninput="nested1VisaFeeCal()" id="nested_1_visa_fee_usd" class="nested_1_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[1][]" oninput="" id="nested_1_visa_fee_arc" class="nested_1_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[1][]" oninput="nested1VisaFeePhpCal();" id="nested_1_visa_fee_php" class="nested_1_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'



        $("#netxVisaFeeTab1").append(VisaFeecols)

        nestedChoosePaymentMethod()

        subtotalselectUsd()

        // console.log(Parent1_visa_fee_usd)

        // subtotalselectUsd()
       
        })

        // REMOVE NESTED VISA FEE START

        $(document).on('click', '#removeNestedVisaFeeBtn1', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove1');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested1VisaFeeCal()
                nested1VisaFeePhpCal()
                        

                
        })
    
        // REMOVE NESTED VISA FEE END


        function nested2VisaFeeCal(){
        // console.log("nested2VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested2_subtotal_usd = document.querySelector('.nested2_subtotal_usd');
        // NESTED 1
        var nested_2_visa_fee_phpElement = document.querySelectorAll('.nested_2_visa_fee_usd');
        var valuesNested2VisaFeePhp = [];
        let nested2VisaFeeSum = 0 

        for (var i = 0; i < nested_2_visa_fee_phpElement.length; i++) {
            
            valuesNested2VisaFeePhp.push(nested_2_visa_fee_phpElement[i].value);
            nested2VisaFeeSum += parseFloat(nested_2_visa_fee_phpElement[i].value);
            
        }

        nested_2_visa_fee_phpElement.forEach(function(nested_2_visa_fee_phpElement_item, index) {
        
            nested_2_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_2_visa_fee_phpElement_item.value == ""){
                nested_2_visa_fee_phpElement_item.value = 0;
                nested2VisaFeeCal()
            }
            else{

            }
            });
        });

        valuesNested2VisaFeePhp = valuesNested2VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_2_visa_fee_phpElement: " + valuesNested2VisaFeePhp)
        // console.log("Sum nested_2_visa_fee_phpElement: " + nested2VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 2 Sub Total: " + nested2VisaFeeSum)
        nested2_subtotal_usd.value = nested2VisaFeeSum

        subtotalselectUsd()
        }


        function nested2VisaFeePhpCal(){
        console.log("nested2VisaFeeUsdCal")
        let Parent2_visa_fee_php = document.querySelector('.Parent2_visa_fee_php').value; 
        let nested2_subtotal_php = document.querySelector('.nested2_subtotal_php');
        // NESTED 1
        var nested_2_visa_fee_phpElement = document.querySelectorAll('.nested_2_visa_fee_php');
        var valuesNested2VisaFeePhp = [];
        let nested2VisaFeeSum = 0 

        for (var i = 0; i < nested_2_visa_fee_phpElement.length; i++) {
            
            valuesNested2VisaFeePhp.push(nested_2_visa_fee_phpElement[i].value);
            nested2VisaFeeSum += parseFloat(nested_2_visa_fee_phpElement[i].value);
            
        }

        nested_2_visa_fee_phpElement.forEach(function(nested_2_visa_fee_phpElement_item, index) {
        
            nested_2_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_2_visa_fee_phpElement_item.value == ""){
                nested_2_visa_fee_phpElement_item.value = 0;
                nested2VisaFeePhpCal()
            }
            else{

            }
            });
        });

        valuesNested2VisaFeePhp = valuesNested2VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_2_visa_fee_phpElement: " + valuesNested2VisaFeePhp)
        // console.log("Sum nested_2_visa_fee_phpElement: " + nested2VisaFeeSum)

        // console.log("Nested 2 Sub Total: " + nested2VisaFeeSum)
        nested2_subtotal_php.value = nested2VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee2(){

        console.log("Napindot si addvisafeetab2")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[2][]" oninput="" id="nested_2_visa_fee_name" class="nested_2_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn2">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove2">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[2][]" oninput="nested2VisaFeeCal();" id="nested_2_visa_fee_usd" class="nested_2_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[2][]" oninput="" id="nested_2_visa_fee_arc" class="nested_2_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[2][]" oninput="nested2VisaFeePhpCal();" id="nested_2_visa_fee_php" class="nested_2_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'
        

        $("#netxVisaFeeTab2").append(VisaFeecols)

        nestedChoosePaymentMethod()

        
    
        

        // var nested_2_visa_fee_phpElement = document.querySelectorAll('.nested_2_visa_fee_usd');

        // var valuesNestedVisaFeePhp = [];

        // for (var i = 0; i < nested_2_visa_fee_phpElement.length; i++) {
            
        //     valuesNestedVisaFeePhp.push(nested_2_visa_fee_phpElement[i].value);
            
        // }

        // console.log("valuesNested2VisaFeePhp: " + valuesNestedVisaFeePhp)

        // let sumNested = valuesNestedVisaFeePhp.reduce(function (accumulator, currentValue) {
        //     return accumulator + parseFloat(currentValue);
        // }, 0);

        // console.log("Sum Nested 2" + sumNested)

        

        // subtotalselectUsd()

        subtotalselectUsd()

        }

        // REMOVE NESTED VISA FEE 2 START

        $(document).on('click', '#removeNestedVisaFeeBtn2', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove2');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested2VisaFeeCal()
                nested2VisaFeePhpCal()
                        

                
        })

        // REMOVE NESTED VISA FEE 2 END



        function nested3VisaFeeCal(){
        console.log("nested3VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested3_subtotal_usd = document.querySelector('.nested3_subtotal_usd');
        // NESTED 1
        var nested_3_visa_fee_phpElement = document.querySelectorAll('.nested_3_visa_fee_usd');
        var valuesNested3VisaFeePhp = [];
        let nested3VisaFeeSum = 0 

        for (var i = 0; i < nested_3_visa_fee_phpElement.length; i++) {
            
            valuesNested3VisaFeePhp.push(nested_3_visa_fee_phpElement[i].value);
            nested3VisaFeeSum += parseFloat(nested_3_visa_fee_phpElement[i].value);
            
        }

        nested_3_visa_fee_phpElement.forEach(function(nested_3_visa_fee_phpElement_item, index) {
        
        nested_3_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_3_visa_fee_phpElement_item.value == ""){
                nested_3_visa_fee_phpElement_item.value = 0;
                nested3VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested3VisaFeePhp = valuesNested3VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_3_visa_fee_phpElement: " + valuesNested3VisaFeePhp)
        // console.log("Sum nested_3_visa_fee_phpElement: " + nested3VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 3 Sub Total: " + nested3VisaFeeSum)
        nested3_subtotal_usd.value = nested3VisaFeeSum

        subtotalselectUsd()
        }

        function nested3VisaFeePhpCal(){
        console.log("nested3VisaFeeUsdCal")
        let Parent3_visa_fee_php = document.querySelector('.Parent3_visa_fee_php').value; 
        let nested3_subtotal_php = document.querySelector('.nested3_subtotal_php');
        // NESTED 1
        var nested_3_visa_fee_phpElement = document.querySelectorAll('.nested_3_visa_fee_php');
        var valuesNested3VisaFeePhp = [];
        let nested3VisaFeeSum = 0 

        for (var i = 0; i < nested_3_visa_fee_phpElement.length; i++) {
            
            valuesNested3VisaFeePhp.push(nested_3_visa_fee_phpElement[i].value);
            nested3VisaFeeSum += parseFloat(nested_3_visa_fee_phpElement[i].value);
            
        }

        nested_3_visa_fee_phpElement.forEach(function(nested_3_visa_fee_phpElement_item, index) {
        
            nested_3_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_3_visa_fee_phpElement_item.value == ""){
                nested_3_visa_fee_phpElement_item.value = 0;
                nested3VisaFeePhpCal()
            }
            else{

            }
        });
        });

        valuesNested3VisaFeePhp = valuesNested3VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_3_visa_fee_phpElement: " + valuesNested3VisaFeePhp)
        // console.log("Sum nested_3_visa_fee_phpElement: " + nested3VisaFeeSum)

        // console.log("Nested 2 Sub Total: " + nested3VisaFeeSum)
        nested3_subtotal_php.value = nested3VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee3(){

        console.log("Napindot si addvisafeetab3")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[3][]" oninput="" id="nested_3_visa_fee_name" class="nested_3_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn3">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[3][]" oninput="nested3VisaFeeCal();" id="nested_3_visa_fee_usd" class="nested_3_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[3][]" oninput="" id="nested_3_visa_fee_arc" class="nested_3_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[3][]" oninput="nested3VisaFeePhpCal();" id="nested_3_visa_fee_php" class="nested_3_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab3").append(VisaFeecols)

        nestedChoosePaymentMethod()

        subtotalselectUsd()
        
        }

        // REMOVE NESTED VISA FEE 3 START

        $(document).on('click', '#removeNestedVisaFeeBtn3', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove3');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested3VisaFeeCal()
                nested3VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 3 END


        function nested4VisaFeeCal(){
        console.log("nested4VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested4_subtotal_usd = document.querySelector('.nested4_subtotal_usd');
        // NESTED 1
        var nested_4_visa_fee_phpElement = document.querySelectorAll('.nested_4_visa_fee_usd');
        var valuesNested4VisaFeePhp = [];
        let nested4VisaFeeSum = 0 

        for (var i = 0; i < nested_4_visa_fee_phpElement.length; i++) {
            
            valuesNested4VisaFeePhp.push(nested_4_visa_fee_phpElement[i].value);
            nested4VisaFeeSum += parseFloat(nested_4_visa_fee_phpElement[i].value);
            
        }

        nested_4_visa_fee_phpElement.forEach(function(nested_4_visa_fee_phpElement_item, index) {
        
        nested_4_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_4_visa_fee_phpElement_item.value == ""){
                nested_4_visa_fee_phpElement_item.value = 0;
                nested4VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested4VisaFeePhp = valuesNested4VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_4_visa_fee_phpElement: " + valuesNested4VisaFeePhp)
        // console.log("Sum nested_4_visa_fee_phpElement: " + nested4VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 4 Sub Total: " + nested4VisaFeeSum)
        nested4_subtotal_usd.value = nested4VisaFeeSum

        subtotalselectUsd()
        }


        function nested4VisaFeePhpCal(){
        console.log("nested4VisaFeeUsdCal")
        let Parent4_visa_fee_php = document.querySelector('.Parent4_visa_fee_php').value; 
        let nested4_subtotal_php = document.querySelector('.nested4_subtotal_php');
        // NESTED 1
        var nested_4_visa_fee_phpElement = document.querySelectorAll('.nested_4_visa_fee_php');
        var valuesNested4VisaFeePhp = [];
        let nested4VisaFeeSum = 0 

        for (var i = 0; i < nested_4_visa_fee_phpElement.length; i++) {
            
            valuesNested4VisaFeePhp.push(nested_4_visa_fee_phpElement[i].value);
            nested4VisaFeeSum += parseFloat(nested_4_visa_fee_phpElement[i].value);
            
        }

        nested_4_visa_fee_phpElement.forEach(function(nested_4_visa_fee_phpElement_item, index) {
        
            nested_4_visa_fee_phpElement_item.addEventListener("change", (event) => {
        if(nested_4_visa_fee_phpElement_item.value == ""){
            nested_4_visa_fee_phpElement_item.value = 0;
            nested4VisaFeePhpCal()
        }
        else{

        }
    });
    });

    valuesNested4VisaFeePhp = valuesNested4VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_4_visa_fee_phpElement: " + valuesNested4VisaFeePhp)
        // console.log("Sum nested_4_visa_fee_phpElement: " + nested4VisaFeeSum)

        // console.log("Nested 2 Sub Total: " + nested4VisaFeeSum)
        nested4_subtotal_php.value = nested4VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee4(){

        console.log("Napindot si addvisafeetab4")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[4][]" oninput="" id="nested_4_visa_fee_name" class="nested_4_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn4">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[4][]" oninput="nested4VisaFeeCal();" id="nested_4_visa_fee_usd" class="nested_4_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[4][]" oninput="" id="nested_4_visa_fee_arc" class="nested_4_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[4][]" oninput="nested4VisaFeePhpCal();" id="nested_4_visa_fee_php" class="nested_4_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab4").append(VisaFeecols)

        nestedChoosePaymentMethod()

        subtotalselectUsd()
        }

        // REMOVE NESTED VISA FEE 4 START

        $(document).on('click', '#removeNestedVisaFeeBtn4', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove4');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested4VisaFeeCal()
                nested4VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 4 END

        function nested5VisaFeeCal(){
        console.log("nested5VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested5_subtotal_usd = document.querySelector('.nested5_subtotal_usd');
        // NESTED 1
        var nested_5_visa_fee_phpElement = document.querySelectorAll('.nested_5_visa_fee_usd');
        var valuesNested5VisaFeePhp = [];
        let nested5VisaFeeSum = 0 

        for (var i = 0; i < nested_5_visa_fee_phpElement.length; i++) {
            
            valuesNested5VisaFeePhp.push(nested_5_visa_fee_phpElement[i].value);
            nested5VisaFeeSum += parseFloat(nested_5_visa_fee_phpElement[i].value);
            
        }

        nested_5_visa_fee_phpElement.forEach(function(nested_5_visa_fee_phpElement_item, index) {
        
        nested_5_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_5_visa_fee_phpElement_item.value == ""){
                nested_5_visa_fee_phpElement_item.value = 0;
                nested5VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested5VisaFeePhp = valuesNested5VisaFeePhp.map(item => (item == "" ? 0 : item));

        

        // console.log("Element nested_5_visa_fee_phpElement: " + valuesNested5VisaFeePhp)
        // console.log("Sum nested_5_visa_fee_phpElement: " + nested5VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 5 Sub Total: " + nested5VisaFeeSum)
        nested5_subtotal_usd.value = nested5VisaFeeSum

        subtotalselectUsd()
        }

        function nested5VisaFeePhpCal(){
        console.log("nested5VisaFeeUsdCal")
        let Parent5_visa_fee_php = document.querySelector('.Parent5_visa_fee_php').value; 
        let nested5_subtotal_php = document.querySelector('.nested5_subtotal_php');
        // NESTED 1
        var nested_5_visa_fee_phpElement = document.querySelectorAll('.nested_5_visa_fee_php');
        var valuesNested5VisaFeePhp = [];
        let nested5VisaFeeSum = 0 

        for (var i = 0; i < nested_5_visa_fee_phpElement.length; i++) {
            
            valuesNested5VisaFeePhp.push(nested_5_visa_fee_phpElement[i].value);
            nested5VisaFeeSum += parseFloat(nested_5_visa_fee_phpElement[i].value);
            
        }

        nested_5_visa_fee_phpElement.forEach(function(nested_5_visa_fee_phpElement_item, index) {
        
        nested_5_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_5_visa_fee_phpElement_item.value == ""){
                nested_5_visa_fee_phpElement_item.value = 0;
                nested5VisaFeePhpCal()
            }
            else{

            }
        });
        });

        valuesNested5VisaFeePhp = valuesNested5VisaFeePhp.map(item => (item == "" ? 0 : item));


        

        

        // console.log("Element nested_5_visa_fee_phpElement: " + valuesNested5VisaFeePhp)
        // console.log("Sum nested_5_visa_fee_phpElement: " + nested5VisaFeeSum)

        // console.log("Nested 2 Sub Total: " + nested5VisaFeeSum)
        nested5_subtotal_php.value = nested5VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee5(){

        console.log("Napindot si addvisafeetab5")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[5][]" oninput="" id="nested_5_visa_fee_name" class="nested_5_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn5">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove5">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[5][]" oninput="nested5VisaFeeCal();" id="nested_5_visa_fee_usd" class="nested_5_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[5][]" oninput="" id="nested_5_visa_fee_arc" class="nested_5_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[5][]" oninput="nested5VisaFeePhpCal();" id="nested_5_visa_fee_php" class="nested_5_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab5").append(VisaFeecols)

        nestedChoosePaymentMethod()

        subtotalselectUsd()
        }

        // REMOVE NESTED VISA FEE 5 START

        $(document).on('click', '#removeNestedVisaFeeBtn5', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove5');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested5VisaFeeCal()
                nested5VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 5 END

        // Wala pang function yung 6 to 10
        //Bale iaadd natin yung nested total sa specific passenger total

        function nested6VisaFeeCal(){
        console.log("nested6VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested6_subtotal_usd = document.querySelector('.nested6_subtotal_usd');
        // NESTED 1
        var nested_6_visa_fee_phpElement = document.querySelectorAll('.nested_6_visa_fee_usd');
        var valuesNested6VisaFeePhp = [];
        let nested6VisaFeeSum = 0 

        for (var i = 0; i < nested_6_visa_fee_phpElement.length; i++) {
            
            valuesNested6VisaFeePhp.push(nested_6_visa_fee_phpElement[i].value);
            nested6VisaFeeSum += parseFloat(nested_6_visa_fee_phpElement[i].value);
            
        }

        nested_6_visa_fee_phpElement.forEach(function(nested_6_visa_fee_phpElement_item, index) {
        
        nested_6_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_6_visa_fee_phpElement_item.value == ""){
                nested_6_visa_fee_phpElement_item.value = 0;
                nested6VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested6VisaFeePhp = valuesNested6VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_6_visa_fee_phpElement: " + valuesNested6VisaFeePhp)
        // console.log("Sum nested_6_visa_fee_phpElement: " + nested6VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 6 Sub Total: " + nested6VisaFeeSum)
        nested6_subtotal_usd.value = nested6VisaFeeSum

        subtotalselectUsd()
        }

        function nested6VisaFeePhpCal(){
        console.log("nested6VisaFeeUsdCal")
        let Parent6_visa_fee_php = document.querySelector('.Parent6_visa_fee_php').value; 
        let nested6_subtotal_php = document.querySelector('.nested6_subtotal_php');
        // NESTED 1
        var nested_6_visa_fee_phpElement = document.querySelectorAll('.nested_6_visa_fee_php');
        var valuesNested6VisaFeePhp = [];
        let nested6VisaFeeSum = 0 

        for (var i = 0; i < nested_6_visa_fee_phpElement.length; i++) {
            
            valuesNested6VisaFeePhp.push(nested_6_visa_fee_phpElement[i].value);
            nested6VisaFeeSum += parseFloat(nested_6_visa_fee_phpElement[i].value);
            
        }

        nested_6_visa_fee_phpElement.forEach(function(nested_6_visa_fee_phpElement_item, index) {
        
        nested_6_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_6_visa_fee_phpElement_item.value == ""){
                nested_6_visa_fee_phpElement_item.value = 0;
                nested6VisaFeePhpCal()
            }
            else{

            }
        });
        });

        valuesNested6VisaFeePhp = valuesNested6VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_6_visa_fee_phpElement: " + valuesNested6VisaFeePhp)
        // console.log("Sum nested_6_visa_fee_phpElement: " + nested6VisaFeeSum)

        // console.log("Nested 6 Sub Total: " + nested6VisaFeeSum)
        nested6_subtotal_php.value = nested6VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee6(){

        console.log("Napindot si addvisafeetab6")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[6][]" oninput="" id="nested_6_visa_fee_name" class="nested_6_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn6">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove6">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[6][]" oninput="nested6VisaFeeCal();" id="nested_6_visa_fee_usd" class="nested_6_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[6][]" oninput="" id="nested_6_visa_fee_arc" class="nested_6_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[6][]" oninput="nested6VisaFeePhpCal();" id="nested_6_visa_fee_php" class="nested_6_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab6").append(VisaFeecols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()
        }

        // REMOVE NESTED VISA FEE 6 START

        $(document).on('click', '#removeNestedVisaFeeBtn6', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove6');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested6VisaFeeCal()
                nested6VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 6 END


        function nested7VisaFeeCal(){
        console.log("nested7VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested7_subtotal_usd = document.querySelector('.nested7_subtotal_usd');
        // NESTED 1
        var nested_7_visa_fee_usdElement = document.querySelectorAll('.nested_7_visa_fee_usd');
        var valuesNested7VisaFeePhp = [];
        let nested7VisaFeeSum = 0 

        for (var i = 0; i < nested_7_visa_fee_usdElement.length; i++) {
            
            valuesNested7VisaFeePhp.push(nested_7_visa_fee_usdElement[i].value);
            nested7VisaFeeSum += parseFloat(nested_7_visa_fee_usdElement[i].value);
            
        }

        nested_7_visa_fee_usdElement.forEach(function(nested_7_visa_fee_usdElement_item, index) {
        
        nested_7_visa_fee_usdElement_item.addEventListener("change", (event) => {
            if(nested_7_visa_fee_usdElement_item.value == ""){
                nested_7_visa_fee_usdElement_item.value = 0;
                nested7VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested7VisaFeePhp = valuesNested7VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_7_visa_fee_phpElement: " + valuesNested7VisaFeePhp)
        // console.log("Sum nested_7_visa_fee_phpElement: " + nested7VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 7 Sub Total: " + nested7VisaFeeSum)
        nested7_subtotal_usd.value = nested7VisaFeeSum

        subtotalselectUsd()
        }

        function nested7VisaFeePhpCal(){
        console.log("nested7VisaFeeUsdCal")
        let Parent7_visa_fee_php = document.querySelector('.Parent7_visa_fee_php').value; 
        let nested7_subtotal_php = document.querySelector('.nested7_subtotal_php');
        // NESTED 1
        var nested_7_visa_fee_phpElement = document.querySelectorAll('.nested_7_visa_fee_php');
        var valuesNested7VisaFeePhp = [];
        let nested7VisaFeeSum = 0 

        for (var i = 0; i < nested_7_visa_fee_phpElement.length; i++) {
            
            valuesNested7VisaFeePhp.push(nested_7_visa_fee_phpElement[i].value);
            nested7VisaFeeSum += parseFloat(nested_7_visa_fee_phpElement[i].value);
            
        }

        nested_7_visa_fee_phpElement.forEach(function(nested_7_visa_fee_phpElement_item, index) {
        
        nested_7_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_7_visa_fee_phpElement_item.value == ""){
                nested_7_visa_fee_phpElement_item.value = 0;
                nested7VisaFeePhpCal()
            }
            else{

            }
        });
        });

        valuesNested7VisaFeePhp = valuesNested7VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_7_visa_fee_phpElement: " + valuesNested7VisaFeePhp)
        // console.log("Sum nested_7_visa_fee_phpElement: " + nested7VisaFeeSum)

        // console.log("Nested 7 Sub Total: " + nested7VisaFeeSum)
        nested7_subtotal_php.value = nested7VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee7(){

        console.log("Napindot si addvisafeetab7")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[7][]" oninput="" id="nested_7_visa_fee_name" class="nested_7_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn7">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove7">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[7][]" oninput="nested7VisaFeeCal();" id="nested_7_visa_fee_usd" class="nested_7_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[7][]" oninput="" id="nested_7_visa_fee_arc" class="nested_7_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[7][]" oninput="nested7VisaFeePhpCal();" id="nested_7_visa_fee_php" class="nested_7_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab7").append(VisaFeecols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()
        }

        // REMOVE NESTED VISA FEE 7 START

        $(document).on('click', '#removeNestedVisaFeeBtn7', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove7');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested7VisaFeeCal()
                nested7VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 7 END

        function nested8VisaFeeCal(){
        console.log("nested8VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested8_subtotal_usd = document.querySelector('.nested8_subtotal_usd');
        // NESTED 1
        var nested_8_visa_fee_usdElement = document.querySelectorAll('.nested_8_visa_fee_usd');
        var valuesNested8VisaFeePhp = [];
        let nested8VisaFeeSum = 0 

        for (var i = 0; i < nested_8_visa_fee_usdElement.length; i++) {
            
            valuesNested8VisaFeePhp.push(nested_8_visa_fee_usdElement[i].value);
            nested8VisaFeeSum += parseFloat(nested_8_visa_fee_usdElement[i].value);
            
        }

        nested_8_visa_fee_usdElement.forEach(function(nested_8_visa_fee_usdElement_item, index) {
        
            nested_8_visa_fee_usdElement_item.addEventListener("change", (event) => {
            if(nested_8_visa_fee_usdElement_item.value == ""){
                nested_8_visa_fee_usdElement_item.value = 0;
                nested8VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested8VisaFeePhp = valuesNested8VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_8_visa_fee_phpElement: " + valuesNested8VisaFeePhp)
        // console.log("Sum nested_8_visa_fee_phpElement: " + nested8VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 8 Sub Total: " + nested8VisaFeeSum)
        nested8_subtotal_usd.value = nested8VisaFeeSum

        subtotalselectUsd()
        }

        function nested8VisaFeePhpCal(){
        console.log("nested8VisaFeeUsdCal")
        let Parent8_visa_fee_php = document.querySelector('.Parent8_visa_fee_php').value; 
        let nested8_subtotal_php = document.querySelector('.nested8_subtotal_php');
        // NESTED 1
        var nested_8_visa_fee_phpElement = document.querySelectorAll('.nested_8_visa_fee_php');
        var valuesNested8VisaFeePhp = [];
        let nested8VisaFeeSum = 0 

        for (var i = 0; i < nested_8_visa_fee_phpElement.length; i++) {
            
            valuesNested8VisaFeePhp.push(nested_8_visa_fee_phpElement[i].value);
            nested8VisaFeeSum += parseFloat(nested_8_visa_fee_phpElement[i].value);
            
        }

        nested_8_visa_fee_phpElement.forEach(function(nested_8_visa_fee_phpElement_item, index) {
        
        nested_8_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_8_visa_fee_phpElement_item.value == ""){
                nested_8_visa_fee_phpElement_item.value = 0;
                nested8VisaFeePhpCal()
            }
            else{

            }
        });
        });

        valuesNested8VisaFeePhp = valuesNested8VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_8_visa_fee_phpElement: " + valuesNested8VisaFeePhp)
        // console.log("Sum nested_8_visa_fee_phpElement: " + nested8VisaFeeSum)

        // console.log("Nested 8 Sub Total: " + nested8VisaFeeSum)
        nested8_subtotal_php.value = nested8VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee8(){

        console.log("Napindot si addvisafeetab8")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[8][]" oninput="" id="nested_8_visa_fee_name" class="nested_8_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn8">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove8">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[8][]" oninput="nested8VisaFeeCal();" id="nested_8_visa_fee_usd" class="nested_8_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[8][]" oninput="" id="nested_8_visa_fee_arc" class="nested_8_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[8][]" oninput="nested8VisaFeePhpCal();" id="nested_8_visa_fee_php" class="nested_8_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab8").append(VisaFeecols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()
        }

        // REMOVE NESTED VISA FEE 8 START

        $(document).on('click', '#removeNestedVisaFeeBtn8', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove8');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested8VisaFeeCal()
                nested8VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 8 END


function nested9VisaFeeCal(){
        console.log("nested9VisaFeeCal")
        // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
        let nested9_subtotal_usd = document.querySelector('.nested9_subtotal_usd');
        // NESTED 1
        var nested_9_visa_fee_usdElement = document.querySelectorAll('.nested_9_visa_fee_usd');
        var valuesNested9VisaFeePhp = [];
        let nested9VisaFeeSum = 0 

        for (var i = 0; i < nested_9_visa_fee_usdElement.length; i++) {
            
            valuesNested9VisaFeePhp.push(nested_9_visa_fee_usdElement[i].value);
            nested9VisaFeeSum += parseFloat(nested_9_visa_fee_usdElement[i].value);
            
        }

        nested_9_visa_fee_usdElement.forEach(function(nested_9_visa_fee_usdElement_item, index) {
        
            nested_9_visa_fee_usdElement_item.addEventListener("change", (event) => {
        if(nested_9_visa_fee_usdElement_item.value == ""){
            nested_9_visa_fee_usdElement_item.value = 0;
            nested9VisaFeeCal()
            }
            else{

            }
        });
        });

        valuesNested9VisaFeePhp = valuesNested9VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_9_visa_fee_phpElement: " + valuesNested9VisaFeePhp)
        // console.log("Sum nested_9_visa_fee_phpElement: " + nested9VisaFeeSum)

        // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

        // console.log("Nested 9 Sub Total: " + nested9VisaFeeSum)
        nested9_subtotal_usd.value = nested9VisaFeeSum
        subtotalselectUsd()
        }

        function nested9VisaFeePhpCal(){
        console.log("nested9VisaFeeUsdCal")
        let Parent9_visa_fee_php = document.querySelector('.Parent9_visa_fee_php').value; 
        let nested9_subtotal_php = document.querySelector('.nested9_subtotal_php');
        // NESTED 1
        var nested_9_visa_fee_phpElement = document.querySelectorAll('.nested_9_visa_fee_php');
        var valuesNested9VisaFeePhp = [];
        let nested9VisaFeeSum = 0 

        for (var i = 0; i < nested_9_visa_fee_phpElement.length; i++) {
            
            valuesNested9VisaFeePhp.push(nested_9_visa_fee_phpElement[i].value);
            nested9VisaFeeSum += parseFloat(nested_9_visa_fee_phpElement[i].value);
            
        }

        nested_9_visa_fee_phpElement.forEach(function(nested_9_visa_fee_phpElement_item, index) {
        
        nested_9_visa_fee_phpElement_item.addEventListener("change", (event) => {
            if(nested_9_visa_fee_phpElement_item.value == ""){
                nested_9_visa_fee_phpElement_item.value = 0;
                nested9VisaFeePhpCal()
            }
            else{

            }
        });
        });

        valuesNested9VisaFeePhp = valuesNested9VisaFeePhp.map(item => (item == "" ? 0 : item));

        // console.log("Element nested_9_visa_fee_phpElement: " + valuesNested9VisaFeePhp)
        // console.log("Sum nested_9_visa_fee_phpElement: " + nested9VisaFeeSum)

        // console.log("Nested 9 Sub Total: " + nested9VisaFeeSum)
        nested9_subtotal_php.value = nested9VisaFeeSum

        
        subtotalselectPhp()
        
    }

        function addVisaFee9(){

        console.log("Napindot si addvisafeetab9")

        VisaFeecols = ""
        VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
        VisaFeecols += '<div class="row pr-3 mt-3">'
        VisaFeecols += '    <div class="col-md-9 ">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[9][]" oninput="" id="nested_9_visa_fee_name" class="nested_9_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '    <div class="col-md-3">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
        VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn9">'
        VisaFeecols += '    </div>'

        VisaFeecols += '</div>'

        VisaFeecols += '<div class="row mt-3">'
        VisaFeecols += '    <div class="col-md-4" id="container-nested-remove9">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[9][]" oninput="nested9VisaFeeCal();" id="nested_9_visa_fee_usd" class="nested_9_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[9][]" oninput="" id="nested_9_visa_fee_arc" class="nested_9_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'

        VisaFeecols += '    <div class="col-md-4">'
        VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
        VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[9][]" oninput="nested9VisaFeePhpCal();" id="nested_9_visa_fee_php" class="nested_9_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
        VisaFeecols += '    </div>'
        VisaFeecols += '</div>'
        VisaFeecols += '</div>'

        $("#netxVisaFeeTab9").append(VisaFeecols)
        nestedChoosePaymentMethod()
        subtotalselectUsd()
        }

        // REMOVE NESTED VISA FEE 9 START

        $(document).on('click', '#removeNestedVisaFeeBtn9', function(e){
                e.preventDefault();

                let containerNestedRemove = document.getElementById('container-nested-remove9');
                containerNestedRemove.children[1];
                console.log(containerNestedRemove.children[1]);
                let amountVal = containerNestedRemove.children[1].value;
                console.log("Amount Value Remove: " + amountVal);

                

                let row_item = $(this).parent().parent().parent();
                let input_item = $(this).parent();

                $(row_item).remove();

                nested9VisaFeeCal()
                nested9VisaFeePhpCal()
                        
        })
        // REMOVE NESTED VISA FEE 6 END

        function nested10VisaFeeCal(){
                console.log("nested10VisaFeeCal")
                // let Parent2_visa_fee_usd = document.querySelector('.Parent2_visa_fee_usd').value; 
                let nested10_subtotal_usd = document.querySelector('.nested10_subtotal_usd');
                // NESTED 1
                var nested_10_visa_fee_usdElement = document.querySelectorAll('.nested_10_visa_fee_usd');
                var valuesNested10VisaFeePhp = [];
                let nested10VisaFeeSum = 0 

                for (var i = 0; i < nested_10_visa_fee_usdElement.length; i++) {
                    
                    valuesNested10VisaFeePhp.push(nested_10_visa_fee_usdElement[i].value);
                    nested10VisaFeeSum += parseFloat(nested_10_visa_fee_usdElement[i].value);
                    
                }

                nested_10_visa_fee_usdElement.forEach(function(nested_10_visa_fee_usdElement_item, index) {
        
                    nested_10_visa_fee_usdElement_item.addEventListener("change", (event) => {
                if(nested_10_visa_fee_usdElement_item.value == ""){
                    nested_10_visa_fee_usdElement_item.value = 0;
                    nested10VisaFeeCal()
                    }
                    else{

                    }
                });
                });

                valuesNested10VisaFeePhp = valuesNested10VisaFeePhp.map(item => (item == "" ? 0 : item));

                // console.log("Element nested_10_visa_fee_phpElement: " + valuesNested10VisaFeePhp)
                // console.log("Sum nested_10_visa_fee_phpElement: " + nested10VisaFeeSum)

                // // let nested2TotalVisaFee = parseFloat(Parent2_visa_fee_usd) + parseFloat(nested2VisaFeeSum);

                // console.log("Nested 10 Sub Total: " + nested10VisaFeeSum)
                nested10_subtotal_usd.value = nested10VisaFeeSum
                subtotalselectUsd()
                }

                function nested10VisaFeePhpCal(){
                    console.log("nested10VisaFeeUsdCal")
                    let Parent10_visa_fee_php = document.querySelector('.Parent10_visa_fee_php').value; 
                    let nested10_subtotal_php = document.querySelector('.nested10_subtotal_php');
                    // NESTED 1
                    var nested_10_visa_fee_phpElement = document.querySelectorAll('.nested_10_visa_fee_php');
                    var valuesNested10VisaFeePhp = [];
                    let nested10VisaFeeSum = 0 

                    for (var i = 0; i < nested_10_visa_fee_phpElement.length; i++) {
                        
                        valuesNested10VisaFeePhp.push(nested_10_visa_fee_phpElement[i].value);
                        nested10VisaFeeSum += parseFloat(nested_10_visa_fee_phpElement[i].value);
                        
                    }

                    nested_10_visa_fee_phpElement.forEach(function(nested_10_visa_fee_phpElement_item, index) {
        
                            nested_10_visa_fee_phpElement_item.addEventListener("change", (event) => {
                        if(nested_10_visa_fee_phpElement_item.value == ""){
                            nested_10_visa_fee_phpElement_item.value = 0;
                            nested10VisaFeePhpCal()
                        }
                        else{

                        }
                    });
                    });

                    valuesNested10VisaFeePhp = valuesNested10VisaFeePhp.map(item => (item == "" ? 0 : item));

                    // console.log("Element nested_10_visa_fee_phpElement: " + valuesNested10VisaFeePhp)
                    // console.log("Sum nested_10_visa_fee_phpElement: " + nested10VisaFeeSum)

                    // console.log("Nested 10 Sub Total: " + nested10VisaFeeSum)
                    nested10_subtotal_php.value = nested10VisaFeeSum

                    
                    subtotalselectPhp()
                    
                }

            function addVisaFee10(){

            console.log("Napindot si addvisafeetab10")

            VisaFeecols = ""
            VisaFeecols += '<div class="mt-3 p-1 p-3" style="border: 1px solid lightgray; border-radius: 5px; box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-webkit-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);-moz-box-shadow: 2px 2px 32px 6px rgba(209,209,209,0.5);">'
            VisaFeecols += '<div class="row pr-3 mt-3">'
            VisaFeecols += '    <div class="col-md-9 ">'
            VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
            VisaFeecols += '        <input type="text" name="edit_nested_visa_fee_name[10][]" oninput="" id="nested_10_visa_fee_name" class="nested_10_visa_fee_name form-control form-control-sm pr-3" value="N/A" required>'
            VisaFeecols += '    </div>'
            VisaFeecols += '    <div class="col-md-3">'
            VisaFeecols += '        <label for="" class="font-weight-bold text-light" style="visibility: hidden"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
            VisaFeecols += '        <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removeNestedVisaFeeBtn10">'
            VisaFeecols += '    </div>' 

            VisaFeecols += '</div>'

            VisaFeecols += '<div class="row mt-3">'
            VisaFeecols += '    <div class="col-md-4" id="container-nested-remove10">'
            VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_usd[10][]" oninput="nested10VisaFeeCal();" id="nested_10_visa_fee_usd" class="nested_10_visa_fee_usd nested_zero_usd nested_visa_fee_usd_readonly form-control form-control-sm" value="0" required>'
            VisaFeecols += '        <input type="number" name="visa_fee_usdD[]" oninput="select1();" id="visa_fee1_usdD" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
            VisaFeecols += '    </div>'

            VisaFeecols += '    <div class="col-md-4" style="visibility: hidden">'
            VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_arc[10][]" oninput="" id="nested_10_visa_fee_arc" class="nested_10_visa_fee_arc nested_visa_fee_arc_readonly form-control form-control-sm" value="0" required>'
            VisaFeecols += '        <input type="number" name="visa_fee_arcD[]" oninput="" id="visa_fee1_arcD" class="visa_fee1_arcD d-none form-control form-control-sm" value="0" required>'
            VisaFeecols += '    </div>'

            VisaFeecols += '    <div class="col-md-4">'
            VisaFeecols += '        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            VisaFeecols += '        <input type="number" name="edit_nested_visa_fee_php[10][]" oninput="nested10VisaFeePhpCal();" id="nested_10_visa_fee_php" class="nested_10_visa_fee_php nested_zero_php nested_visa_fee_php_readonly form-control form-control-sm" value="0" required>'
            VisaFeecols += '    </div>'
            VisaFeecols += '</div>'
            VisaFeecols += '</div>'

            $("#netxVisaFeeTab10").append(VisaFeecols)
            nestedChoosePaymentMethod()
            subtotalselectUsd()
            }

            // REMOVE NESTED VISA FEE 10 START

            $(document).on('click', '#removeNestedVisaFeeBtn10', function(e){
                    e.preventDefault();

                    let containerNestedRemove = document.getElementById('container-nested-remove10');
                    containerNestedRemove.children[1];
                    console.log(containerNestedRemove.children[1]);
                    let amountVal = containerNestedRemove.children[1].value;
                    console.log("Amount Value Remove: " + amountVal);

                    

                    let row_item = $(this).parent().parent().parent();
                    let input_item = $(this).parent();

                    $(row_item).remove();

                    nested10VisaFeeCal()
                    nested10VisaFeePhpCal()
                            
            })
            // REMOVE NESTED VISA FEE 6 END

        
    // Disable muna yung mga nested fields hanggat walang pinipindot na payment method
 
    var counter = 2
    let count_divSelect = document.querySelector('.count_divSelect').value;
    

    $("#addPassengerTab").on("click", function(e) {

            

            console.log("Count of Div " + count_divSelect);

            
            e.preventDefault();
            // var newRow  = $("<tr>")
            var cols    = ""
            cols += '<div class="mt-3 p-3 bg-success" style="border: 1px solid lightgray;">'
            cols += '<div class="">'
            cols +=     '<div class="d-flex align-items-center" style="justify-content: space-between">'
            cols +=     '    <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>Passenger Name:</label>'
            cols +=     '    <input type="button" class="btn btn-danger " style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="select1()" value="Remove" id="removePassengerBtn">'
            cols +=     '</div>'
            cols += '    <input type="text" name="edit_sa_passengerName[]" id="sa_passengerName" class="sa_passengerName form-control form-control-sm" value="N/A" required>'
            cols += '</div>'
            cols += '<div class="row mt-3">'
            cols += '   <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">'
            cols += '       <select name="" class="form-control select-Fee-'+count_divSelect+'" >'
            cols += '                <option value="" class="font-weight-bold p-4" style="font-size: 16px;">SELECT OPTION</option>'
            cols += '                <option value="TOUR COST" class="font-weight-bold p-4">TOUR COST</option>'
            cols += '                <option value="TAXES" class="font-weight-bold p-4">TAXES</option>'
            cols += '                <option value="TIP FUND" class="font-weight-bold p-4">TIP FUND</option>'
            cols += '                <option value="TRAVEL INSURANCE" class="font-weight-bold p-4">TRAVEL INSURANCE</option>'
            cols += '                <option value="VISA FEE" class="font-weight-bold p-4">VISA FEE</option>'
            cols += '                <option value="OTHER" class="font-weight-bold p-4">OTHER</option>'
            cols += '            </select>'
            cols += '            <!-- <h5 class="text-center "><span class="text-danger mr-1">*</span>TOUR COST: </h5> -->'
            cols += '        </div>'

            cols += '        <div class="col-md-9">'
            cols += '            <!-- TOUR COST ROW -->'
            cols += '            <div class="select-tourCost-'+count_divSelect+' row" >'
            cols += '                <div class="col-md-12">'
                                
            cols += '                <h6 class="text-light">TOUR COST</h6>'

            cols += '                    <div class="row">'
            cols += '                        <div class="col-md-4" id="container-amount">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            cols += '                            <input type="number" name="edit_tourcost_usd[]" oninput="select1()" id="tourcost1_usd" class="tourcost1_usd form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="tourcost_usdD[]" oninput="select1()" id="tourcost1_usdD" class="tourcost1_usdD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4" style="visibility: hidden">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                            <input type="number" name="edit_tourcost_arc[]" oninput="" id="tourcost_1arc" class="tourcost1_arc form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="tourcost_arcD[]" oninput="" id="tourcos1t_arcD" class="tourcost1_arcD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            cols += '                           <input type="number" name="edit_tourcost_php[]" oninput="selectphp1()" id="tourcost1_php" class="tourcost1_php form-control form-control-sm" value="0" required>'
            cols += '                        </div>'
            cols += '                   </div>'
            cols += '                </div>'
            cols += '           </div>'


            cols += '            <!-- TAXES ROW -->'
            cols += '           <div class="select-taxes-'+count_divSelect+' row mt-2" >'
            cols += '               <div class="col-md-12">'
                                
            cols += '                <h6 class="text-light">TAXES</h6>'

            cols += '                    <div class="row">'
            cols += '                        <div class="col-md-4" id="container-amount">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            cols += '                            <input type="number" name="edit_taxes_usd[]" oninput="select1()" id="taxes1_usd" class="taxes1_usd form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="taxes_usdD[]" oninput="select1()" id="taxes1_usdD" class="d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4" style="visibility: hidden">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                           <input type="number" name="edit_taxes_arc[]" oninput="" id="taxes1_arc" class="taxes1_arc form-control form-control-sm" value="0" required>'
            cols += '                           <input type="number" name="taxes_arcD[]" oninput="" id="taxes1_arcD" class="taxes1_arcD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            cols += '                            <input type="number" name="edit_taxes_php[]" oninput="selectphp1()" id="taxes1_php" class="taxes1_php form-control form-control-sm" value="0" required>'
            cols += '                        </div>'
            cols += '                    </div>'
            cols += '                </div>'
            cols += '            </div>'


            cols += '            <!-- TIP FUND ROW -->'
            cols += '            <div class="select-tipFund-'+count_divSelect+' row mt-2" >'
            cols += '                <div class="col-md-12">'
                                
            cols += '                <h6 class="text-light">TIP FUND</h6>'

            cols += '                    <div class="row">'
            cols += '                        <div class="col-md-4" id="container-amount">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            cols += '                            <input type="number" name="edit_tip_fund_usd[]" oninput="select1()" id="tip_fund1_usd" class="tip_fund1_usd form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="tip_fund_usdD[]" oninput="select1()" id="tip_fund1_usdD" class="tip_fund1_usdD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4" style="visibility: hidden">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                            <input type="number" name="edit_tip_fund_arc[]" oninput="" id="tip_fund1_arc" class="tip_fund1_arc form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="tip_fund_arcD[]" oninput="" id="tip_fund1_arcD" class="tip_fund1_arcD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                       <div class="col-md-4">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            cols += '                            <input type="number" name="edit_tip_fund_php[]" oninput="selectphp1()" id="tip_fund1_php" class="tip_fund1_php form-control form-control-sm" value="0" required>'
            cols += '                        </div>'
            cols += '                    </div>'
            cols += '                </div>'
            cols += '            </div>'


            cols += '            <!-- TRAVEL INSURANCE ROW -->'
            cols += '            <div class="select-travelInsurance-'+count_divSelect+' row mt-2" >'
            cols += '                <div class="col-md-12">'
                                
            cols += '                <h6 class="text-light">TRAVEL INSURANCE</h6>'

            cols += '                    <div class="row">'
            cols += '                        <div class="col-md-4" id="container-amount">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            cols += '                           <input type="number" name="edit_travel_insurance_usd[]" oninput="select1()" id="travel_insurance1_usd" class="travel_insurance1_usd form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="travel_insurance_usdD[]" oninput="select1()" id="travel_insurance1_usdD" class="travel_insurance1_usdD d-none form-control form-control-sm" value="0" required>'
            cols += '                       </div>'

            cols += '                        <div class="col-md-4" style="visibility: hidden">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                            <input type="number" name="edit_travel_insurance_arc[]" oninput="" id="travel_insurance1_arc" class="travel_insurance1_arc form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="travel_insurance_arcD[]" oninput="" id="travel_insurance1_arcD" class="travel_insurance1_arcD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            cols += '                           <input type="number" name="edit_travel_insurance_php[]" oninput="selectphp1()" id="travel_insurance1_php" class="travel_insurance1_php form-control form-control-sm" value="0" required>'
            cols += '                       </div>'
            cols += '                    </div>'
            cols += '                </div>'
            cols += '            </div>'


            cols += '            <!-- VISA FEE ROW -->'
            cols += '            <div class="select-visaFee-'+count_divSelect+' row mt-2"  >'
            cols += '                <div class="col-md-12">'
                                
            cols += '                   <div class="row pr-3">'
            cols += '                       <div class="col-md-9 ">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>VISA FEE:</label>'
            cols += '                           <input type="text" name="edit_visa_fee_name[]" oninput="" id="visa_fee1_name" class="visa-fee-parent'+count_divSelect+' form-control form-control-sm pr-3" value="N/A" required>'
            cols += '                       </div>'

            cols += '                       <div class="col-md-3">'
            cols += '                           <label for="" class="font-weight-bold" style="visibility: hidden"><span class="text-danger">*</span>VISA FEE:</label>'
            cols += '                               <input type="button" class="btn btn-dark btn-block" onclick="addVisaFee'+count_divSelect+'()" style="border: 0; cursor: pointer;" value="Add VISA FEE" id="addVisaFeeTab'+count_divSelect+'">'
            cols += '                           </div>'
            cols += '                   </div>'

            cols += '                    <div class="row mt-3">'
            cols += '                        <div class="col-md-4" id="container-amount">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            cols += '                            <input type="number" name="edit_visa_fee_usd[]" oninput="select1()" id="" class="visa_fee1_usd Parent'+count_divSelect+'_visa_fee_usd form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="visa_fee_usdD[]" oninput="select1()" id="" class="visa_fee1_usdD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4" style="visibility: hidden">'
            cols += '                            <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                            <input type="number" name="edit_visa_fee_arc[]" oninput="" id="visa_fee1_arc" class="visa_fee1_arc form-control form-control-sm" value="0" required>'
            cols += '                            <input type="number" name="visa_fee_ardD[]" oninput="" id="visa_fee1_ardD" class="visa_fee1_ardD d-none form-control form-control-sm" value="0" required>'
            cols += '                        </div>'

            cols += '                        <div class="col-md-4">'
            cols += '                           <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            cols += '                            <input type="number" name="edit_visa_fee_php[]" oninput="selectphp1()" id="" class="visa_fee1_php Parent'+count_divSelect+'_visa_fee_php form-control form-control-sm" value="0" required>'
            cols += '                        </div>'
            cols += '                    </div>'

            cols += '                   <div class="row mt-3 d-none ">'
            cols += '                       <div class="col-md-4">'
            cols += '                           <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED '+count_divSelect+' SUBTOTAL USD:</label>'
            cols += '                           <input type="number" name="edit_nested_visa_fee_subtotal_usd[]" oninput="" id="" class="nested'+count_divSelect+'_subtotal_usd nested_visa_sub_usd form-control form-control-sm" value="0" required>'
            cols += '                           <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
            cols += '                       </div>'

            cols += '                       <div class="col-md-4">'
            cols += '                           <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                           <input type="number" name="" oninput="" id="" class=" form-control form-control-sm" value="0" required>'
            cols += '                           <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
            cols += '                       </div>'

            cols += '                       <div class="col-md-4">'
            cols += '                           <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED 1 SUBTOTAL PHP:</label>'
            cols += '                           <input type="number" name="edit_nested_visa_fee_subtotal_php[]" oninput="" id="" class="nested'+count_divSelect+'_subtotal_php nested_visa_sub_php form-control form-control-sm" value="0" required>'
            cols += '                       </div>'
            cols += '                   </div>'

            cols += '                   <div id="netxVisaFeeTab'+count_divSelect+'">'

            cols += '                   </div>'
                                                    
            cols += '                </div>'
            cols += '            </div>'


            cols += '<div class="select-other-'+count_divSelect+' row mt-2" >'
            cols += '                                    <div class="col-md-12">'
                                         
            cols += '                                       <div class="row pr-3">'
            cols += '                                            <div class="col-md-9">'
            cols += '                                                <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>OTHER:</label>'
            cols += '                                                <input type="text" name="edit_other_name[]" oninput="" id="other1_name" class="other-parent'+count_divSelect+' form-control form-control-sm" value="N/A" required>'
            cols += '                                            </div>'

            cols += '                                           <div class="col-md-3">'
            cols += '                                               <label for="" class="font-weight-bold " style="visibility: hidden"><span class="text-danger">*</span>OTHER:</label>'
            cols += '                                                <input type="button" class="btn btn-dark btn-block" onclick="addOther'+count_divSelect+'()" style="border: 0; cursor: pointer;" value="Add OTHER" id="addOtherTab'+count_divSelect+'">'
            cols += '                                            </div>'
            cols += '                                       </div>'

            cols += '                                        <div class="row mt-3">'
            cols += '                                            <div class="col-md-4">'
            cols += '                                               <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>USD:</label>'
            cols += '                                                <input type="number" name="edit_other_usd[]" oninput="select1();" id="" class="other1_usd Parent'+count_divSelect+'_other_usd form-control form-control-sm" value="0" required>'
            cols += '                                                <input type="number" name="other_usdD[]" oninput="select1();" id="" class="other1_usdD d-none form-control form-control-sm" value="0" required>'
            cols += '                                            </div>'

            cols += '                                           <div class="col-md-4" style="visibility: hidden">'
            cols += '                                                <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                                                <input type="number" name="edit_other_arc[]" oninput="" id="other1_arc" class="other1_arc form-control form-control-sm" value="0" required>'
            cols += '                                                <input type="number" name="other_arcD[]" oninput="" id="other1_arcD" class="other1_arcD d-none form-control form-control-sm" value="0" required>'
            cols += '                                            </div>'

            cols += '                                           <div class="col-md-4">'
            cols += '                                                <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>PHP:</label>'
            cols += '                                                <input type="number" name="edit_other_php[]" oninput="selectphp1();" id="" class="other1_php Parent'+count_divSelect+'_other_php form-control form-control-sm" value="0" required>'
            cols += '                                            </div>'
            cols += '                                        </div>'

            cols += '                                       <div class="row mt-3 d-none">'
            cols += '                                            <div class="col-md-4">'
            cols += '                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED '+count_divSelect+' SUBTOTAL USD:</label>'
            cols += '                                                <input type="number" name="edit_nested_other_subtotal_usd[]" oninput="" id="" class="nested'+count_divSelect+'_other_subtotal_usd nested_other_sub_usd form-control form-control-sm" value="0" required>'
            cols += '                                                <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
            cols += '                                            </div>'

            cols += '                                            <div class="col-md-4">'
            cols += '                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>'
            cols += '                                                <input type="number" name="" oninput="" id="" class=" form-control form-control-sm" value="0" required>'
            cols += '                                                <input type="number" name="" oninput="" id="" class=" d-none form-control form-control-sm" value="0" required>'
            cols += '                                            </div>'

            cols += '                                            <div class="col-md-4">'
            cols += '                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>NESTED 1 SUBTOTAL PHP:</label>'
            cols += '                                                <input type="number" name="edit_nested_other_subtotal_php[]" oninput="" id="" class="nested'+count_divSelect+'_other_subtotal_php nested_other_php form-control form-control-sm" value="0" required>'
            cols += '                                            </div>'
            cols += '                                        </div>'

            cols += '                                        <div id="netxOtherTab'+count_divSelect+'">'

            cols += '                                        </div>'
            cols += '                                    </div>'
            cols += '                                </div>'


            // cols += '                </div>'
            // cols += '            </div>'

            cols += '               <div class="divTotal-1">'
            cols += '                        <div class="row mt-3">'

            cols += '                            <div class="col-md-12">'
            cols += '                                <div class="row">'
            cols += '                                   <div class="col-md-4">'
            cols += '                                        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>TOTAL USD:</label>'
            cols += '                                        <input type="number" name="edit_select1_total_usd[]" oninput="" id="select1_total_usd" class="select1_total_usd form-control form-control-sm" value="0" required>'
            cols += '                                    </div>'

            cols += '                                   <div class="col-md-4">'
            cols += '                                        <span></span>'
            cols += '                                    </div>'


            cols += '                                    <div class="col-md-4">'
            cols += '                                        <label for="" class="font-weight-bold text-light"><span class="text-danger mr-1">*</span>TOTAL PHP:</label>'
            cols += '                                        <input type="number" name="edit_select1_total_php[]" oninput="" id="select1_total_php" class="select1_total_php form-control form-control-sm" value="0" required>'
            cols += '                                    </div>'
            cols += '                                </div>'
            cols += '                            </div> '

            cols += '                        </div>'
            cols += '                    </div>'



            cols += '        </div>'
            cols += '    </div>'
                

            
            cols += '<!-- Kapag nag lagay ako ng gantong div is nag iiba yung format -->'
            cols += '</div>'
            cols += '</div>'
            
            
            // Kapag naikiclick ang remove sa USDCHOOSEPAYMENTMETHOD nag 0 lang ang total
        

            $("#divNextPassengerTab").append(cols)
            // counter++;
            counter++;
            count_divSelect++;

            // readonlyInputs()
            
            // selectedUsdPhpHotel()

            


            $('.select1_total_usd').prop('readonly', true);
            $('.select1_total_php').prop('readonly', true);


            if(document.getElementById('usdChosePaymentMethod').checked) {
        //USD radio button is checked
            console.log("naclick si usd")

            $('.tourcost1_usd').prop('readonly', false);
            $('.tourcost1_arc').prop('readonly', false);
            $('.tourcost1_php').prop('readonly', true);
            $('.tourcost1_php').val(0);

            $('.taxes1_usd').prop('readonly', false);
            $('.taxes1_arc').prop('readonly', false);
            $('.taxes1_php').prop('readonly', true);
            $('.taxes1_php').val(0);

            $('.tip_fund1_usd').prop('readonly', false);
            $('.tip_fund1_arc').prop('readonly', false);
            $('.tip_fund1_php').prop('readonly', true);
            $('.tip_fund1_php').val(0);

            $('.travel_insurance1_usd').prop('readonly', false);
            $('.travel_insurance1_arc').prop('readonly', false);
            $('.travel_insurance1_php').prop('readonly', true);
            $('.travel_insurance1_php').val(0);

            $('.visa_fee1_usd').prop('readonly', false);
            $('.visa_fee1_arc').prop('readonly', false);
            $('.visa_fee1_php').prop('readonly', true);
            $('.visa_fee1_php').val(0);

             

            $('.nested_visa_fee_usd_readonly').prop('readonly', false);

            $('.other1_usd').prop('readonly', false);
            $('.other1_arc').prop('readonly', false);
            $('.other1_php').prop('readonly', true);
            $('.other1_php').val(0);

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            // $('.select1_total_php').val(0);
            
            // selectphp1();

        }
        
        else if(document.getElementById('phpChosePaymentMethod').checked) {
        //Php radio button is checked
            console.log("naclick si php")

            $('.tourcost1_usd').prop('readonly', true);
            $('.tourcost1_arc').prop('readonly', true);
            $('.tourcost1_usd').val(0);
            $('.tourcost1_arc').val(0);
            $('.tourcost1_php').prop('readonly', false);

            $('.taxes1_usd').prop('readonly', true);
            $('.taxes1_arc').prop('readonly', true);
            $('.taxes1_usd').val(0);
            $('.taxes1_arc').val(0);
            $('.taxes1_php').prop('readonly', false);

            $('.tip_fund1_usd').prop('readonly', true);
            $('.tip_fund1_arc').prop('readonly', true);
            $('.tip_fund1_usd').val(0);
            $('.tip_fund1_arc').val(0);
            $('.tip_fund1_php').prop('readonly', false);

            $('.travel_insurance1_usd').prop('readonly', true);
            $('.travel_insurance1_arc').prop('readonly', true);
            $('.travel_insurance1_usd').val(0);
            $('.travel_insurance1_arc').val(0);
            $('.travel_insurance1_php').prop('readonly', false);

            $('.visa_fee1_usd').prop('readonly', true);
            $('.visa_fee1_arc').prop('readonly', true);
            $('.visa_fee1_usd').val(0);
            $('.visa_fee1_arc').val(0);
            $('.visa_fee1_php').prop('readonly', false);

            $('.nested_visa_fee_usd_readonly').prop('readonly', true);


            $('.other1_usd').prop('readonly', true);
            $('.other1_arc').prop('readonly', true);
            $('.other1_usd').val(0);
            $('.other1_arc').val(0);
            $('.other1_php').prop('readonly', false);

            $('.select1_total_usd').prop('readonly', true);
            // $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            // $('.select1_total_php').val(0);

            // select1();

        }

        else{
            $('.tourcost1_usd').prop('readonly', true);
            $('.tourcost1_arc').prop('readonly', true);
            $('.tourcost1_usd').val(0);
            $('.tourcost1_arc').val(0);
            $('.tourcost1_php').prop('readonly', true);

            $('.taxes1_usd').prop('readonly', true);
            $('.taxes1_arc').prop('readonly', true);
            $('.taxes1_usd').val(0);
            $('.taxes1_arc').val(0);
            $('.taxes1_php').prop('readonly', true);

            $('.tip_fund1_usd').prop('readonly', true);
            $('.tip_fund1_arc').prop('readonly', true);
            $('.tip_fund1_usd').val(0);
            $('.tip_fund1_arc').val(0);
            $('.tip_fund1_php').prop('readonly', true);

            $('.travel_insurance1_usd').prop('readonly', true);
            $('.travel_insurance1_arc').prop('readonly', true);
            $('.travel_insurance1_usd').val(0);
            $('.travel_insurance1_arc').val(0);
            $('.travel_insurance1_php').prop('readonly', true);

            $('.visa_fee1_usd').prop('readonly', true);
            $('.visa_fee1_arc').prop('readonly', true);
            $('.visa_fee1_usd').val(0);
            $('.visa_fee1_arc').val(0);
            $('.visa_fee1_php').prop('readonly', true);

            $('.other1_usd').prop('readonly', true);
            $('.other1_arc').prop('readonly', true);
            $('.other1_usd').val(0);
            $('.other1_arc').val(0);
            $('.other1_php').prop('readonly', true);

            $('.select1_total_usd').prop('readonly', true);
            $('.select1_total_usd').val(0);

            $('.select1_total_php').prop('readonly', true);
            $('.select1_total_php').val(0);
        }
            

            zeroValue();

            
            // let count = counter ++;
            // console.log(count)

        $(".select-tourCost-2").hide();
        $(".select-taxes-2").hide();
        $(".select-tipFund-2").hide();
        $(".select-travelInsurance-2").hide();
        $(".select-visaFee-2").hide();
        $(".select-other-2").hide();
        $(".divTotal-2").show();
        
        $('.select-Fee-2').change(function () {
                
        var selectedVal2 = document.querySelector(".select-Fee-2");
        // console.log(selectedVal2.options[selectedVal2.selectedIndex].value)
        // alert("You selected " + selectedVal.options[selectedVal.selectedIndex].value);

        if(selectedVal2.options[selectedVal2.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-2").show();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();

            



        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "TAXES"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").show();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").show();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").show();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").show();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
        }

        else if(selectedVal2.options[selectedVal2.selectedIndex].value === "OTHER"){
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").show();
            $(".divTotal-2").show();
        }

        else{
            $(".select-tourCost-2").hide();
            $(".select-taxes-2").hide();
            $(".select-tipFund-2").hide();
            $(".select-travelInsurance-2").hide();
            $(".select-visaFee-2").hide();
            $(".select-other-2").hide();
            $(".divTotal-2").show();
            
        }



        




    });

    


        $(".select-tourCost-3").hide();
        $(".select-taxes-3").hide();
        $(".select-tipFund-3").hide();
        $(".select-travelInsurance-3").hide();
        $(".select-visaFee-3").hide();
        $(".select-other-3").hide();
        $(".divTotal-3").show();

        $('.select-Fee-3').change(function () {
                
        var selectedVal3 = document.querySelector(".select-Fee-3");

        if(selectedVal3.options[selectedVal3.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-3").show();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "TAXES"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").show();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").show();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").show();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").show();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

        else if(selectedVal3.options[selectedVal3.selectedIndex].value === "OTHER"){
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").show();
            $(".divTotal-3").show();
        }

        else{
            $(".select-tourCost-3").hide();
            $(".select-taxes-3").hide();
            $(".select-tipFund-3").hide();
            $(".select-travelInsurance-3").hide();
            $(".select-visaFee-3").hide();
            $(".select-other-3").hide();
            $(".divTotal-3").show();
        }

    });



        $(".select-tourCost-4").hide();
        $(".select-taxes-4").hide();
        $(".select-tipFund-4").hide();
        $(".select-travelInsurance-4").hide();
        $(".select-visaFee-4").hide();
        $(".select-other-4").hide();
        $(".divTotal-4").show();

        $('.select-Fee-4').change(function () {
                
        var selectedVal4 = document.querySelector(".select-Fee-4");

        if(selectedVal4.options[selectedVal4.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-4").show();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "TAXES"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").show();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").show();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").show();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").show();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

        else if(selectedVal4.options[selectedVal4.selectedIndex].value === "OTHER"){
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").show();
            $(".divTotal-4").show();
        }

        else{
            $(".select-tourCost-4").hide();
            $(".select-taxes-4").hide();
            $(".select-tipFund-4").hide();
            $(".select-travelInsurance-4").hide();
            $(".select-visaFee-4").hide();
            $(".select-other-4").hide();
            $(".divTotal-4").show();
        }

    });


        $(".select-tourCost-5").hide();
        $(".select-taxes-5").hide();
        $(".select-tipFund-5").hide();
        $(".select-travelInsurance-5").hide();
        $(".select-visaFee-5").hide();
        $(".select-other-5").hide();
        $(".divTotal-5").show();

        $('.select-Fee-5').change(function () {
                
        var selectedVal5 = document.querySelector(".select-Fee-5");

        if(selectedVal5.options[selectedVal5.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-5").show();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "TAXES"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").show();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").show();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").show();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        //Dito na tayo sa kapag nilipat na category at maraming field yung other nagdidisplay sya sa ibang category hindi nawawala yung mga fields

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").show();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

        else if(selectedVal5.options[selectedVal5.selectedIndex].value === "OTHER"){
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").show();
            $(".divTotal-5").show();
        }

        else{
            $(".select-tourCost-5").hide();
            $(".select-taxes-5").hide();
            $(".select-tipFund-5").hide();
            $(".select-travelInsurance-5").hide();
            $(".select-visaFee-5").hide();
            $(".select-other-5").hide();
            $(".divTotal-5").show();
        }

    });

        $(".select-tourCost-6").hide();
        $(".select-taxes-6").hide();
        $(".select-tipFund-6").hide();
        $(".select-travelInsurance-6").hide();
        $(".select-visaFee-6").hide();
        $(".select-other-6").hide();
        $(".divTotal-6").show();

        $('.select-Fee-6').change(function () {
                
        var selectedVal6 = document.querySelector(".select-Fee-6");

        if(selectedVal6.options[selectedVal6.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-6").show();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "TAXES"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").show();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").show();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").show();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").show();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

        else if(selectedVal6.options[selectedVal6.selectedIndex].value === "OTHER"){
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").show();
            $(".divTotal-6").show();
        }

        else{
            $(".select-tourCost-6").hide();
            $(".select-taxes-6").hide();
            $(".select-tipFund-6").hide();
            $(".select-travelInsurance-6").hide();
            $(".select-visaFee-6").hide();
            $(".select-other-6").hide();
            $(".divTotal-6").show();
        }

    });


        $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();

        $('.select-Fee-7').change(function () {
                
        var selectedVal7 = document.querySelector(".select-Fee-7");

        if(selectedVal7.options[selectedVal7.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-7").show();
            $(".select-taxes-7").hide();
            $(".select-tipFund-7").hide();
            $(".select-travelInsurance-7").hide();
            $(".select-visaFee-7").hide();
            $(".select-other-7").hide();
            $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "TAXES"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").show();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").show();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").show();
        $(".select-visaFee-7").hide();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").show();
        $(".select-other-7").hide();
        $(".divTotal-7").show();
        }

        else if(selectedVal7.options[selectedVal7.selectedIndex].value === "OTHER"){
            $(".select-tourCost-7").hide();
        $(".select-taxes-7").hide();
        $(".select-tipFund-7").hide();
        $(".select-travelInsurance-7").hide();
        $(".select-visaFee-7").hide();
        $(".select-other-7").show();
        $(".divTotal-7").show();
        }

        else{
            $(".select-tourCost-7").hide();
            $(".select-taxes-7").hide();
            $(".select-tipFund-7").hide();
            $(".select-travelInsurance-7").hide();
            $(".select-visaFee-7").hide();
            $(".select-other-7").hide();
            $(".divTotal-7").show();
        }

    });


        $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();

        $('.select-Fee-8').change(function () {
                
        var selectedVal8 = document.querySelector(".select-Fee-8");

        if(selectedVal8.options[selectedVal8.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-8").show();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "TAXES"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").show();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").show();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").show();
        $(".select-visaFee-8").hide();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").show();
        $(".select-other-8").hide();
        $(".divTotal-8").show();
        }

        else if(selectedVal8.options[selectedVal8.selectedIndex].value === "OTHER"){
            $(".select-tourCost-8").hide();
        $(".select-taxes-8").hide();
        $(".select-tipFund-8").hide();
        $(".select-travelInsurance-8").hide();
        $(".select-visaFee-8").hide();
        $(".select-other-8").show();
        $(".divTotal-8").show();
        }

        else{
            $(".select-tourCost-8").hide();
            $(".select-taxes-8").hide();
            $(".select-tipFund-8").hide();
            $(".select-travelInsurance-8").hide();
            $(".select-visaFee-8").hide();
            $(".select-other-8").hide();
            $(".divTotal-8").show();
        }

    });


        $(".select-tourCost-9").hide();
        $(".select-taxes-9").hide();
        $(".select-tipFund-9").hide();
        $(".select-travelInsurance-9").hide();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();

        $('.select-Fee-9').change(function () {
                
        var selectedVal9 = document.querySelector(".select-Fee-9");

        if(selectedVal9.options[selectedVal9.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-9").show();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").hide();
            $(".select-other-9").hide();
            $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "TAXES"){
            $(".select-tourCost-9").hide();
        $(".select-taxes-9").show();
        $(".select-tipFund-9").hide();
        $(".select-travelInsurance-9").hide();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-9").hide();
        $(".select-taxes-9").hide();
        $(".select-tipFund-9").show();
        $(".select-travelInsurance-9").hide();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-9").hide();
        $(".select-taxes-9").hide();
        $(".select-tipFund-9").hide();
        $(".select-travelInsurance-9").show();
        $(".select-visaFee-9").hide();
        $(".select-other-9").hide();
        $(".divTotal-9").show();
        }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-9").hide();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").show();
            $(".select-other-9").hide();
            $(".divTotal-9").show();
            }

        else if(selectedVal9.options[selectedVal9.selectedIndex].value === "OTHER"){
            $(".select-tourCost-9").hide();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").hide();
            $(".select-other-9").show();
            $(".divTotal-9").show();
            }

        else{
            $(".select-tourCost-9").hide();
            $(".select-taxes-9").hide();
            $(".select-tipFund-9").hide();
            $(".select-travelInsurance-9").hide();
            $(".select-visaFee-9").hide();
            $(".select-other-9").hide();
            $(".divTotal-9").show();
        }
   

    });



        $(".select-tourCost-10").hide();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();

        $('.select-Fee-10').change(function () {
                
        var selectedVal10 = document.querySelector(".select-Fee-10");

        if(selectedVal10.options[selectedVal10.selectedIndex].value === "TOUR COST"){
            $(".select-tourCost-10").show();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "TAXES"){
            $(".select-tourCost-10").hide();
        $(".select-taxes-10").show();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "TIP FUND"){
            $(".select-tourCost-10").hide();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").show();
        $(".select-travelInsurance-10").hide();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "TRAVEL INSURANCE"){
            $(".select-tourCost-10").hide();
        $(".select-taxes-10").hide();
        $(".select-tipFund-10").hide();
        $(".select-travelInsurance-10").show();
        $(".select-visaFee-10").hide();
        $(".select-other-10").hide();
        $(".divTotal-10").show();
        }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "VISA FEE"){
            $(".select-tourCost-10").hide();
            $(".select-taxes-10").hide();
            $(".select-tipFund-10").hide();
            $(".select-travelInsurance-10").hide();
            $(".select-visaFee-10").show();
            $(".select-other-10").hide();
            $(".divTotal-10").show();
            }

        else if(selectedVal10.options[selectedVal10.selectedIndex].value === "OTHER"){
            $(".select-tourCost-10").hide();
            $(".select-taxes-10").hide();
            $(".select-tipFund-10").hide();
            $(".select-travelInsurance-10").hide();
            $(".select-visaFee-10").hide();
            $(".select-other-10").show();
            $(".divTotal-10").show();
            }

        else{
            $(".select-tourCost-10").hide();
            $(".select-taxes-10").hide();
            $(".select-tipFund-10").hide();
            $(".select-travelInsurance-10").hide();
            $(".select-visaFee-10").hide();
            $(".select-other-10").hide();
            $(".divTotal-10").show();
        }
        

    });

    
           

    

    
    


            
        })

        

        

        


        

        

        

    



    $(document).ready(function(){

        console.log("start");

            // var sa_acr = $("#sa_acr").val();
            // var sa_paymentMethod = document.getElementsByName('edit_sa_paymentMethod');
            // var sa_paymentMethod_selectedValue = null;

            // // Loop through each radio button to find the selected one
            // for (var i = 0; i < sa_paymentMethod.length; i++) {
            //     if (sa_paymentMethod[i].checked) {
            //         sa_paymentMethod_selectedValue = sa_paymentMethod[i].value;
            //     break; // Exit the loop if a radio button is checked
            //     }
            // }

            // // Check if a radio button is selected
            // if (sa_paymentMethod_selectedValue !== null) {
            //     // Alert the selected value
            //     // alert('Selected value: ' + sa_paymentMethod_selectedValue);

            //     if(sa_paymentMethod_selectedValue == "USD"){
            //         alert("Correct USD")

            //         if(sa_acr == 0){
            //             Swal.fire({
            //                 position: 'center',
            //                 icon: 'error',
            //                 title: 'Make sure the ACR is not empty when the Payment Method is USD, Please try again Thankyou!',
            //                 showConfirmButton: false,
            //                 timer: 3000
            //             })
            //             return;
            //         }

            //         else if(sa_acr != 0)[
            //             // console.log("Merong value ang Acr")
            //         ]
            //     }

            //     else{
            //         // alert("No USD")
            //     }
            // } else {
            //     // Alert if no radio button is selected
            //     // alert('Please select a radio button');
            // }

        

        // console.log("Hello World")
            $("#editBtn").click(function(e){
                
                    console.log("napindot");
                    e.preventDefault();

                    $.ajax({
                        url: "edit_process.php",
                        method: "POST",
                        data: $("#edit_sa_Form").serialize() + "&action=editSA",
                        success : function (response){
                            if(response == "Success"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Edited SA!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "sa_list.php";
                                })
                            }

                            else if(response == "Error"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'There is an error Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                })
                            }

                            else if(response == "EmptyError"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the input fields are not empty. Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 2000  
                                })
                            }
                        }
                    })
            })
        
        

        
        
        
    });

    


</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>